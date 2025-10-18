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
        Schema::create('breach_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('identity_id')->constrained()->onDelete('cascade');
            $table->string('source');
            $table->date('date');
            $table->enum('severity', ['Critical', 'High', 'Medium', 'Low']);
            $table->enum('status', ['Resolved', 'Unresolved']);
            $table->string('endpoint');
            $table->json('data_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breach_events');
    }
};
