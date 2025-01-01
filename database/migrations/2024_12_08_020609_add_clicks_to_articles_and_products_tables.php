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
    Schema::table('articles', function (Blueprint $table) {
        $table->unsignedBigInteger('clicks')->default(0);
    });

    Schema::table('products', function (Blueprint $table) {
        $table->unsignedBigInteger('clicks')->default(0);
    });
}

public function down()
{
    Schema::table('articles', function (Blueprint $table) {
        $table->dropColumn('clicks');
    });

    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('clicks');
    });
}
};
