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
        if (!(Schema::hasColumn('owners', 'user_id'))) {
            Schema::table('owners', function (Blueprint $table) {
                $table->foreignId('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {

                $foreignKeys = $this->listTableForeignKeys('owners');
                if(in_array('owners_user_id_foreign', $foreignKeys)) {
                    $table->dropForeign(['user_id']) ;
                }

                if (Schema::hasColumn('owners', 'user_id')) {
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
