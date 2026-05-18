<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('category')->nullable();
            $table->string('area')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact_channel')->nullable();
            $table->text('public_signal')->nullable();
            $table->text('pain_hypothesis')->nullable();
            $table->text('proposed_solution')->nullable();
            $table->string('budget_fit')->default('medium');
            $table->unsignedTinyInteger('priority_score')->default(50);
            $table->string('status')->default('research');
            $table->timestamp('last_contacted_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};
