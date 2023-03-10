<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description', 250);
            $table->enum('type', ['Reading', 'Listening', 'Studying', 'Speaking']);
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('goal_id')->constrained()->onDelete('restrict');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        // Schema::table('tasks', function (Blueprint $table) {
        //     $table->dropForeign('tasks_user_id_foreign');
        // });

        Schema::dropIfExists('tasks');
    }
};
