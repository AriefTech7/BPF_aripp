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
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' sebagai primary key standar
            $table->string('title');
            $table->text('description'); // text lebih baik untuk deskripsi panjang daripada string
            $table->string('technology');
            $table->string('image')->nullable();
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
