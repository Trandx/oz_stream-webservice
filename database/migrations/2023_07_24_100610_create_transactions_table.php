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

        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ["recharge", "retrait"])->comment('check(recharge, retrait)');
            $table->string('card');
            $table->string('source');
            $table->string('channel');
            $table->string('status');
            $table->decimal('amount');
            $table->string('order_id');
            $table->string('currency');
            $table->string('reference');
            $table->string('date')->nullable();
            $table->string('country_code');
            $table->string('state')->nullable();
            $table->string('intTransaction_id')->nullable();
            $table->string('extTransaction_id')->nullable();
            $table->string('payement_url');
            $table->foreignUuid('users_id')->constrained('users');
            $table->string('user_misdn');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE transactions ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
