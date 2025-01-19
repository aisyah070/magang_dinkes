<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->index(); // Added index for faster searches
            $table->text('deskripsi');
            $table->foreignId('kategori_id')->constrained('kategori_foto')->onDelete('cascade');
            $table->string('file_foto', 255); // Added length limit for path
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
