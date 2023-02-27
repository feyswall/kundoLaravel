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
        Schema::create('sials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('letter_url')->nullable();
            $table->longText('note')->nullable();
            $table->string('area_name');
            
            $table->integer('receiver_id');
            $table->integer('receiver_post_id');
            $table->integer('area_id');

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
        Schema::dropIfExists('sials');
    }
};
