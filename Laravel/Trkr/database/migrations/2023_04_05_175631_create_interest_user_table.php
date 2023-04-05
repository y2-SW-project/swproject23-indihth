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
        Schema::create('interest_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interest_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('interest_users', function (Blueprint $table) {
            // $table->dropForeign('comments_task_post_id_foreign');
            // $table->dropForeign('comments_user_id_foreign');
            $table->dropForeign(['interest_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('interest_users');
    }
};
