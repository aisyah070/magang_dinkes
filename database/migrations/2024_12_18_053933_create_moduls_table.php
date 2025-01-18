<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modul', function (Blueprint $table) {
            $table->id(); // id BIGINT AUTO_INCREMENT
            $table->string('judul', 255); // judul VARCHAR(255)
            $table->text('deskripsi')->nullable(); // deskripsi TEXT NULL
            $table->year('tahun')->nullable(); // tahun YEAR NULL
            $table->string('file_modul', 255)->nullable(); // file_modul VARCHAR(255) NULL
            $table->timestamps(); // created_at & updated_at TIMESTAMP NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modul');
    }
}
