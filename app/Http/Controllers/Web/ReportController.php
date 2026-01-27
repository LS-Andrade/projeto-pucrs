<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Models\Report;
use App\Models\ReportAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        // Log inicial
        \Log::info('Iniciando processamento do report', [
            'has_files' => $request->hasFile('attachments'),
            'files_count' => $request->hasFile('attachments') ? count($request->file('attachments')) : 0,
            'input_files' => $request->input('attachments'),
            'all_files' => $request->allFiles()
        ]);

        // Validação básica dos campos obrigatórios
        $validated = $request->validate([
            'animal_description' => 'required|string|max:1000',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'nullable|file|mimes:jpeg,png,gif|max:5120',
        ]);

        // Criar a denúncia
        $report = Report::create([
            'animal_description' => $request->animal_description,
            'location' => $request->location,
            'city' => $request->city,
            'state' => $request->state,
            'reporter_id' => auth()->id(), // Pode ser null se não logado
            'status' => 'open',
            'assigned_to' => null,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        \Log::info('Report criado', ['report_id' => $report->id]);

        // Processar anexos
        $files = collect($request->file('attachments', []))->filter();

        if ($files->isNotEmpty()) {
            \Log::info('Iniciando processamento de anexos', ['count' => $files->count()]);

            // Garantir que o diretório existe
            Storage::disk('public')->makeDirectory('reports');

            $uploadedCount = 0;
            foreach ($files as $index => $file) {
                \Log::info('Processando arquivo', ['index' => $index, 'file' => $file ? 'exists' : 'null']);

                // Pular arquivos null ou inválidos
                if (!$file || !$file->isValid()) {
                    \Log::warning('Arquivo inválido ou null', ['index' => $index, 'isValid' => $file ? $file->isValid() : 'null']);
                    continue;
                }

                // Limitar a 5 arquivos por denúncia
                if ($uploadedCount >= 5) {
                    \Log::info('Limite de 5 arquivos atingido');
                    break;
                }

                try {
                    // Verificar tipo MIME
                    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
                    $mimeType = $file->getMimeType();
                    \Log::info('Verificando MIME', ['mime' => $mimeType, 'allowed' => $allowedMimes]);

                    if (!in_array($mimeType, $allowedMimes)) {
                        \Log::warning('MIME type não permitido', ['mime' => $mimeType]);
                        continue;
                    }

                    // Verificar tamanho (5MB max)
                    $fileSize = $file->getSize();
                    \Log::info('Verificando tamanho', ['size' => $fileSize, 'max' => 5120 * 1024]);

                    if ($fileSize > 5120 * 1024) {
                        \Log::warning('Arquivo muito grande', ['size' => $fileSize]);
                        continue;
                    }

                    // Gerar nome único para o arquivo
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    \Log::info('Nome do arquivo gerado', ['filename' => $filename]);

                    // Salvar arquivo no storage
                    $path = $file->storeAs('reports', $filename, 'public');
                    \Log::info('Arquivo salvo', ['path' => $path]);

                    // Verificar se o arquivo foi salvo com sucesso
                    if (Storage::disk('public')->exists('reports/' . $filename)) {
                        \Log::info('Criando registro do anexo', ['report_id' => $report->id, 'filename' => $filename]);

                        // Criar registro do anexo
                        $attachment = ReportAttachment::create([
                            'report_id' => $report->id,
                            'file_path' => $filename,
                            'created_by' => auth()->id(),
                            'updated_by' => auth()->id(),
                        ]);

                        \Log::info('Anexo criado', ['attachment_id' => $attachment->id]);
                        $uploadedCount++;
                    } else {
                        \Log::error('Arquivo não foi salvo no storage');
                    }
                } catch (\Exception $e) {
                    // Log do erro mas continua processando outros arquivos
                    \Log::error('Erro ao salvar anexo', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                    continue;
                }
            }

            \Log::info('Processamento de anexos finalizado', ['uploaded' => $uploadedCount]);
        } else {
            \Log::info('Nenhum arquivo encontrado no request');
        }

        return redirect()->route('reports.create')->with('success', 'Denúncia enviada com sucesso! Protocolo: #' . $report->id);
    }
}
