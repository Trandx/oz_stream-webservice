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

        Schema::create('series', function (Blueprint $table) {
            $table->uuid('id')->primary()->foreign('saisons.series_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('cover')->nullable();
            $table->foreignUuid('users_id')->constrained('users');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE series ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
