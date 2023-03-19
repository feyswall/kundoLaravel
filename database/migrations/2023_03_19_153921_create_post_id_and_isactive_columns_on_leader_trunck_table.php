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
        Schema::table('leader_trunk', function (Blueprint $table) {
            if ( !( Schema::hasColumn('leader_trunk', 'post_id') ) ){
                $table->unsignedBigInteger('post_id');
            }
            if ( !( Schema::hasColumn('leader_trunk', 'isActive') ) ){
                $table->boolean('isActive')->default(false);
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
        Schema::table('leader_trunk', function (Blueprint $table) {
            $table->dropColumn('post_id');
            $table->dropColumn('isActive')->default(false);
        });
    }
};
