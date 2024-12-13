<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE vouchers MODIFY COLUMN discount_type ENUM('percent', 'amount', 'percent_max') DEFAULT 'amount';");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE vouchers MODIFY COLUMN discount_type ENUM('percent', 'amount') DEFAULT 'amount';");
    }
};
