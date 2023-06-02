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
        Schema::create('mms', function (Blueprint $table) {
            $table->id();
            $table->string('request_id');
            $table->string("message");
            $table->string('sms_amount');
            $table->string('about')->nullable();

            $table->morphs('mmsable');
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
        Schema::dropIfExists('mms');
    }
};
