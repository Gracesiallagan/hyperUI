<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'stock')) {
                $table->unsignedInteger('stock')->default(1)->after('price');
            }
        });

        DB::table('products')->where('is_sold', true)->update(['stock' => 0]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'stock')) {
                $table->dropColumn('stock');
            }
        });
    }
};
