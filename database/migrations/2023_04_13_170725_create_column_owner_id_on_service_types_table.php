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
        Schema::table('service_types', function (Blueprint $table) {

            $foreignKeys = $this->listTableForeignKeys('service_types');
            if(in_array('service_types_owner_id_foreign', $foreignKeys)) {
                $table->dropForeign(['owner_id']) ;
            }

            if (Schema::hasColumn('service_types', 'owner_id')) {
                $table->dropColumn('owner_id');
            }

            $table->foreignId('owner_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_types', function (Blueprint $table) {
            $foreignKeys = $this->listTableForeignKeys('service_types');
            if(in_array('service_types_owner_id_foreign', $foreignKeys)) { $table->dropForeign(['owner_id']) ;}

            if (Schema::hasColumn('service_types', 'owner_id')) {
                $table->dropColumn('owner_id');
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
