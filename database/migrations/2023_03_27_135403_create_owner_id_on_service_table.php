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
        Schema::table('services', function (Blueprint $table) {
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
        Schema::table('services', function (Blueprint $table) {

            $foreignKeys = $this->listTableForeignKeys('services');
            if(in_array('services_owner_id_foreign', $foreignKeys)) { $table->dropForeign(['owner_id']) ;}

            if (Schema::hasColumn('services', 'owner_id')) {
                $table->dropColumn('owner_id');
            }
        });
    }

    /**
     * @param  string $table
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
