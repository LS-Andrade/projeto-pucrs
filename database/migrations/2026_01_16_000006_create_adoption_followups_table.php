<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('adoptions_followups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adoption_id')->constrained()->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->date('visit_date')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions_followups');
    }
};