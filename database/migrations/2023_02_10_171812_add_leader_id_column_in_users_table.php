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
         Schema::table('users', function (Blueprint $table) {
             // checking if the foreign key still exists
             $foreignKeys = $this->listTableForeignKeys('users');
             if(in_array('users_leader_id_foreign', $foreignKeys)) {
                 $table->dropForeign(['leader_id']) ;
             }
             // checking if the column still exists
             if ( !( Schema::hasColumn('users', 'leader_id') ) ){
                 $table->foreignId('leader_id')->constrained();
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
        Schema::table('Users', function (Blueprint $table) {
            $foreignKeys = $this->listTableForeignKeys('users');
            if(in_array('users_leader_id_foreign', $foreignKeys)) { $table->dropForeign(['leader_id']) ;}

            if (Schema::hasColumn('users', 'leader_id')) {
                $table->dropColumn('user_id');
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
