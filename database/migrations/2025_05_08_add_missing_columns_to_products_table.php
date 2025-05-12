<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('status')->default('draft')->after('stock_status');
            #$table->string('type')->default('simple')->after('status');
            $table->text('additional_links')->nullable()->after('type');
            $table->json('specifications')->nullable()->after('additional_links');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['status','additional_links', 'specifications']);
        });
    } 
};