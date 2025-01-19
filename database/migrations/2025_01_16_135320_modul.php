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
        Schema::create('moduls', function (Blueprint $table) {
            $table->id(); // id BIGINT AUTO_INCREMENT
            $table->string('judul', 255); // judul VARCHAR(255)
            $table->string('file_modul', 255)->nullable(); // file_modul VARCHAR(255) NULL
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->timestamps(); // created_at & updated_at TIMESTAMP NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
