<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medias_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('name', ["annonce", "movie"])->index()->comment('annonce/movie');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE medias_types ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias_types');
    }
};
