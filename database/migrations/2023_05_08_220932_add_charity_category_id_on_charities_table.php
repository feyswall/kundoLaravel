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
        Schema::table('charities', function (Blueprint $table) {
                // checking if the foreign key still exists
                $foreignKeys = $this->listTableForeignKeys('charities');
                if(in_array('charities_charity_categories_id_foreign', $foreignKeys)) {
                    $table->dropForeign(['charity_categories_id']) ;
                }
                // checking if the column still exists
                if ( !( Schema::hasColumn('charities', 'charity_categories_id') ) ){
                    $table->foreignId('charity_categories_id')->constrained();
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
        Schema::table('charities', function (Blueprint $table) {
            $foreignKeys = $this->listTableForeignKeys('charities');
            if(in_array('charities_charity_categories_id_foreign', $foreignKeys)) { $table->dropForeign(['charity_categories_id']) ;}

            if (Schema::hasColumn('charities', 'charity_categories_id')) {
                $table->dropColumn('charity_categories_id');
            }
        });
    }


        /**
     * @param  $table
     * @return array
     */
    private function listTableForeignKeys($table):Array
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        return array_map(function($key) {
            return $key->getName();
        }, $conn->listTableForeignKeys($table));
    }
};
