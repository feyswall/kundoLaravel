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
        Schema::create('leader_region', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_id');
            $table->unsignedBigInteger('region_id');
            $table->boolean('isActive')->default(false);
            $table->string('post_id');

            $table->foreign('leader_id')->references('id')->on('leaders')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
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
        Schema::dropIfExists('leader_region');
    }
};
