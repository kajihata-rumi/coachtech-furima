<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemIdAndCategoryIdToItemCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_category', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->after('id');
            $table->unsignedBigInteger('category_id')->after('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_category', function (Blueprint $table) {
            $table->dropColumn(['item_id', 'category_id']);
        });
    }
}
