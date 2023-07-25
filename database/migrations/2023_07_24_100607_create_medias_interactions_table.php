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
        Schema::disableForeignKeyConstraints();

        Schema::create('medias_interactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('users_id')->constrained('users');
            $table->boolean('like')->comment('Trigger');
            $table->uuid('medias_id');
            $table->boolean('is_paid');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE medias_interactions ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias_interactions');
    }
};
