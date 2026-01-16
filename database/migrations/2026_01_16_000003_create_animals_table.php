<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('species', ['dog', 'cat', 'other']);
            $table->string('breed', 100)->nullable();
            $table->enum('gender', ['male', 'female', 'unknown']);
            $table->date('birth_date')->nullable();
            $table->enum('size', ['small', 'medium', 'large'])->nullable();
            $table->string('color', 50)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_castrated')->default(false);
            $table->boolean('is_vaccinated')->default(false);
            $table->text('health_status')->nullable();
            $table->enum('status', ['available', 'adopted', 'in_treatment', 'lost'])->default('available');
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};