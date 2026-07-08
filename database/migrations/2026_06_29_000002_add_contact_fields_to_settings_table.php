<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (! Schema::hasColumn('settings', 'contact_email')) {
                $table->string('contact_email')->nullable()->after('site_name');
            }
            if (! Schema::hasColumn('settings', 'address')) {
                $table->string('address')->nullable()->after('contact_email');
            }
            if (! Schema::hasColumn('settings', 'short_description')) {
                $table->text('short_description')->nullable()->after('address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            foreach (['short_description', 'address', 'contact_email'] as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
