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
        Schema::create('division_leader', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_id');
            $table->unsignedBigInteger('division_id');
            $table->boolean('isActive')->default(false);
            $table->string('post_id');

            $table->foreign('leader_id')->references('id')->on('leaders')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
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
        Schema::dropIfExists('division_leader');
    }
};
