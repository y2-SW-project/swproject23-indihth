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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();

            // The shorter syntax for foreign keys is not being used because the column names do not match the Laravel naming convention
            // $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->unsignedBigInteger('user1_id');     // creating the column for the foreign key
            $table->unsignedBigInteger('user2_id');
            $table->foreign('user1_id')->references('id')->on('users');     // creating the foreign key link to the users id
            $table->foreign('user2_id')->references('id')->on('users');

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
        Schema::dropIfExists('partnerships');
    }
};
