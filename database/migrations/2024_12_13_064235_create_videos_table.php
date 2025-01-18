<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('url_video')->nullable();
            $table->string('file_video')->nullable();
            $table->string('nama_file'); // Menambahkan kolom nama_file setelah file_video
            $table->text('iframe_video')->nullable(); // Menambahkan kolom iframe_video
            $table->integer('tahun')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
