<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->enum('role', ['admin', 'protector', 'adopter', 'volunteer'])->default('adopter');
            $table->boolean('is_active')->default(true);
            $table->integer('created_by')->nullable();
            $table->timestamp('created_at', precision: 0)->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at', precision: 0)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};