<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('artists', function (Blueprint $table) {
            if (! Schema::hasColumn('artists', 'skill')) {
                $table->string('skill')->nullable()->after('bio');
            }
            if (! Schema::hasColumn('artists', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('skill');
            }
        });
    }

    public function down(): void
    {
        Schema::table('artists', function (Blueprint $table) {
            foreach (['is_active', 'skill'] as $column) {
                if (Schema::hasColumn('artists', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
