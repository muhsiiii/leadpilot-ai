<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        DB::table('businesses')
            ->select(['id', 'name'])
            ->orderBy('id')
            ->get()
            ->each(function ($business) {
                DB::table('businesses')
                    ->where('id', $business->id)
                    ->update(['slug' => Str::slug($business->name) . '-' . $business->id]);
            });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
