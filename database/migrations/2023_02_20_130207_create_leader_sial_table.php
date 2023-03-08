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
        Schema::create('leader_sial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sial_id')->constrained();
            $table->foreignId('leader_id')->constrained();
            $table->integer('receiver_post_id');

            $table->string("titled")->default('copyTo');
            $table->boolean('seen')->default(0);
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
        Schema::dropIfExists('leader_sial');
    }
};
