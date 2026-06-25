<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('website')->nullable()->after('email');
            $table->string('plan')->default('starter')->after('description');
            $table->string('subscription_status')->default('trial')->after('plan');
            $table->unsignedInteger('monthly_conversation_limit')->default(100)->after('subscription_status');
            $table->boolean('lead_email_notifications')->default(true)->after('monthly_conversation_limit');
            $table->text('ai_instructions')->nullable()->after('lead_email_notifications');
        });

        $firstUserId = DB::table('users')->orderBy('id')->value('id');

        if ($firstUserId) {
            DB::table('businesses')
                ->whereNull('user_id')
                ->update(['user_id' => $firstUserId]);
        }
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'website',
                'plan',
                'subscription_status',
                'monthly_conversation_limit',
                'lead_email_notifications',
                'ai_instructions',
            ]);
        });
    }
};
