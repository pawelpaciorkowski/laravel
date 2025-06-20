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
        Schema::create('InternalEvents', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Title', 64);
            $table->string('Link', 64);
            $table->boolean('IsPublic');
            $table->boolean('IsCancelled');
            $table->dateTime('EventDateTime');
            $table->dateTime('CreationDateTime');
            $table->dateTime('EditDateTime');
            $table->dateTime('PublishDateTime');
            $table->string('ShortDescription', 128);
            $table->text('ContentHTML');
            $table->text('MetaDescription')->nullable();
            $table->text('MetaTags')->nullable();
            $table->text('Notes')->nullable();
            $table->boolean('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_events');
    }
};
