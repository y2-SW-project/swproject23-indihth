<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content', 250);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // $table->dropForeign('comments_task_post_id_foreign');
            // $table->dropForeign('comments_user_id_foreign');
            // $table->dropForeign(['user_id']);
            // $table->dropForeign(['task_post_id']);
        });

        
        
        Schema::dropIfExists('comments');
    }
};
