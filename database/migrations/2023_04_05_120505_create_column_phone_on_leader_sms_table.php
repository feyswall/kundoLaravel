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
        Schema::table('leader_sms', function (Blueprint $table) {
            if ( !( Schema::hasColumn('leader_sms', 'phone') ) ){
                $table->string('phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leader_sms', function (Blueprint $table) {

            if (Schema::hasColumn('leader_sms', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
