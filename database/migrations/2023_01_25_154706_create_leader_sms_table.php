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
        Schema::create('leader_sms', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sms_id")->constrained();
            $table->foreignId("leader_id")->constrained();

            $table->index("sms_id");
            $table->index("leader_id");
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
        Schema::dropIfExists('sms_user');
    }
};
