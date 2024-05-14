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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('name');
            $table->string('department');
            $table->string('email');
            $table->string('subject');
            $table->text('description');
            $table->string('image');
            $table->string('prio')->nullable();
            $table->string('handler')->nullable();
            $table->string('status')->nunllable();
            $table->text('remarks')->nullable();
            $table->text('solution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
