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
        Schema::table('motors', function (Blueprint $table) {
             $table->unsignedBigInteger('motor_category_id');

             $table->foreign('motor_category_id')
                 ->references('id')
                 ->on('motor_categories')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->dropForeign(['motor_category_id']);
            $table->dropColumn('motor_category_id');
        });
    }
};
