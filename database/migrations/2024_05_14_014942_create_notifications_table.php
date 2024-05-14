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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Unique ID for each notification
            $table->string('type'); // The type of notification
            $table->morphs('notifiable'); // Polymorphic relationship fields (notifiable_type and notifiable_id)
            $table->text('data'); // JSON data for the notification
            $table->timestamp('read_at')->nullable(); // Timestamp for when the notification was read
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
