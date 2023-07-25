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

        Schema::create('medias', function (Blueprint $table) {
            $table->uuid('id')->primary()->foreign('medias_interactions.medias_id');
            $table->foreignUuid('users_id')->constrained('users');
            $table->foreignUuid('medias_types_id')->constrained('medias_types');
            $table->bigInteger('id_on_sprout_video');
            $table->jsonb('urls');
            $table->integer('price');
            $table->integer('likes')->comment('will write trigger');
            $table->integer('dislikes')->comment('will write trigger');
            $table->boolean('is_free');
            $table->foreignUuid('saisons_id')->nullable()->constrained('saisons');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE medias ALTER COLUMN id SET DEFAULT uuid_generate_v4();');


        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
