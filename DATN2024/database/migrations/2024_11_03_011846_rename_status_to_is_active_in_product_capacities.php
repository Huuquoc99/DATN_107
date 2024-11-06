<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStatusToIsActiveInProductCapacities extends Migration
{
    public function up()
    {
        Schema::table('product_capacities', function (Blueprint $table) {
            $table->boolean('is_active')->default(0)->after('status'); 
            $table->dropColumn('status'); 
        });
    }

    public function down()
    {
        Schema::table('product_capacities', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('is_active'); 
            $table->dropColumn('is_active'); 
        });
    }
}

