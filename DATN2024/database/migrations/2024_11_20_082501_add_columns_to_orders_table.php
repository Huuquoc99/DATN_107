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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_province', 255)->nullable()->after('ship_user_address');
            $table->string('shipping_district', 255)->nullable()->after('shipping_province');
            $table->string('shipping_ward', 255)->nullable()->after('shipping_district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_province', 'shipping_district', 'shipping_ward']);
        });
    }
};
