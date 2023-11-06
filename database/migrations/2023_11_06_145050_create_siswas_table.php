<?php

use App\Models\Kelas;
use App\Models\Angkatan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Angkatan::class)->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignIdFor(Kelas::class)->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->text('foto')->nullable();
            $table->string('kelahiran');
            $table->string('link');
            $table->timestamps();

            $table->index('angkatan_id');
            $table->index('kelas_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
