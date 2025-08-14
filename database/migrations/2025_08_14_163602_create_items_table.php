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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->unique();
            $table->string('name');
            $table->string('type');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->string('job')->nullable();
            $table->string('slot')->nullable();
            $table->text('script')->nullable();
            $table->boolean('dropped_by_monster')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
