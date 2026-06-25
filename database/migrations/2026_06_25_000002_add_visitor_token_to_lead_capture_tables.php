<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_messages', function (Blueprint $table) {
            $table->string('visitor_token')->nullable()->after('lead_id')->index();
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('visitor_token')->nullable()->after('business_id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('ai_messages', function (Blueprint $table) {
            $table->dropIndex(['visitor_token']);
            $table->dropColumn('visitor_token');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropIndex(['visitor_token']);
            $table->dropColumn('visitor_token');
        });
    }
};
