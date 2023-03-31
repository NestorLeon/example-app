<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('todos', function (Blueprint $table) {
            
            // CREAR COLUMNA DE FK EN PRIMER LUGAR
            // YA LA CREAMOS EN LA MIGRACION ANTERIOR: 2023_03_30_181429_create_todos_table
            // $table->bigInteger('category_id')->unsigned();

            $table
                    ->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            //
        });
    }
};
