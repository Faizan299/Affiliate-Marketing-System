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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('venue');
            $table->unsignedBigInteger('club_id');
            $table->string('color');
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->text('description');
            $table->string('image');
            $table->string('status');
            $table->text('coordinator_id')->nullable();
            $table->text('visible_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
