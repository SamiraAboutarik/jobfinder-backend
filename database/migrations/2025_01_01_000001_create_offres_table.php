<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // On utilise "offres" et non "jobs"
        // car Laravel utilise déjà "jobs" pour les queues
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company');
            $table->string('logo', 5)->nullable();
            $table->string('color', 10)->default('#6366f1');
            $table->string('city');
            $table->unsignedInteger('salary');
            $table->enum('type', ['CDI', 'CDD', 'Freelance', 'Stage']);
            $table->text('description');
            $table->json('tags');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
