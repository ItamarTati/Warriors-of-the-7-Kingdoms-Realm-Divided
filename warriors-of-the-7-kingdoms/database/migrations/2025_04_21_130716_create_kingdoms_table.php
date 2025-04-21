<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kingdoms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ruler');
            $table->string('capital');
            $table->integer('gold')->default(1000);
            $table->integer('influence')->default(0);
            $table->integer('food')->default(100);
            $table->integer('population')->default(1000);
            $table->float('tax_rate')->default(10);
            $table->integer('stability')->default(50);
            $table->string('religion')->nullable();
            $table->string('government_type')->default('monarchy');
            $table->string('banner_color')->default('blue');
            $table->string('banner_symbol')->default('lion');
            $table->timestamp('founded_at')->useCurrent();
            $table->boolean('is_playable')->default(true);
            $table->string('ai_personality')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kingdoms');
    }
};