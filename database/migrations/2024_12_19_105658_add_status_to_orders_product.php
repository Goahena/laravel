<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('promotion_id'); // 1 cho "active"
        });
    }

    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
