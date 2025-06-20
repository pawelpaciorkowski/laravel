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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Title', 64);
            $table->boolean('IsDone');
            $table->dateTime('StartDateTime');
            $table->text('Description');
            $table->dateTime('Deadline');
            $table->unsignedBigInteger('InternalEventId');
            $table->dateTime('CreationDateTime');
            $table->dateTime('EditDateTime');
            $table->text('Notes')->nullable();
            $table->boolean('IsActive');

            $table->foreign('InternalEventId')->references('Id')->on('InternalEvents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
