<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.index');
        }

        return view('dashboard.my-adoptions');
    }

    public function categorias()
    {
        return view('dashboard.categorias.index');
    }

    public function categoriasCreate()
    {
        return view('dashboard.categorias.create');
    }

    public function categoriasEdit($id)
    {
        return view('dashboard.categorias.edit', ['id' => $id]);
    }
    
    public function animais()
    {
        return view('dashboard.animais.index');
    }

    public function animaisCreate()
    {
        return view('dashboard.animais.create');
    }

    public function animaisEdit($id)
    {
        return view('dashboard.animais.edit', ['id' => $id]);
    }

    public function conteudos()
    {
        return view('dashboard.conteudos.index');
    }

    public function conteudosCreate()
    {
        return view('dashboard.conteudos.create');
    }

    public function conteudosEdit($id)
    {
        return view('dashboard.conteudos.edit', ['id' => $id]);
    }

    public function denuncias()
    {
        return view('dashboard.placeholder', ['titulo' => 'Denúncias', 'rota' => 'dashboard.denuncias']);
    }

    public function adocoes()
    {
        return view('dashboard.adocoes.index');
    }

    public function usuarios()
    {
        return view('dashboard.usuarios.index');
    }

    public function usuariosCreate()
    {
        return view('dashboard.usuarios.create');
    }

    public function usuariosEdit($id)
    {
        return view('dashboard.usuarios.edit', ['id' => $id]);
    }

    public function organizacoes()
    {
        return view('dashboard.organizacoes.index');
    }

    public function organizacoesCreate()
    {
        return view('dashboard.organizacoes.create');
    }

    public function organizacoesEdit($id)
    {
        return view('dashboard.organizacoes.edit', ['id' => $id]);
    }
}
