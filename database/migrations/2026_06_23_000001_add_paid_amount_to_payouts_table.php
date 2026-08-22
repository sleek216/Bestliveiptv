<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('payouts', 'paid_amount')) {
            Schema::table('payouts', function (Blueprint $table) {
                $table->decimal('paid_amount', 10, 2)->nullable()->after('amount');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('payouts', 'paid_amount')) {
            Schema::table('payouts', function (Blueprint $table) {
                $table->dropColumn('paid_amount');
            });
        }
    }
};
