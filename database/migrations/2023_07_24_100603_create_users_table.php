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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary()->foreign('medias.users_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('first_name')->index()->nullable();
            $table->string('last_name')->index();
            $table->jsonb('phones')->index();
            $table->uuid('roles_id');
            $table->integer('credit')->default(0);
            $table->integer('emailCodeVerify')->nullable()->comment("code de vérification par e-mail");
            $table->timestamp('emailCodeValidity')->nullable()->comment("validité du code");
            $table->enum('accountStatus',["actived", "deleted", "disabled"])->default("actived")->comment("le status du compte: actived, deleted, disabled");
            $table->timestamps();
        });

        DB::statement('ALTER TABLE users ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
