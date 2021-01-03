<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemAmbilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_ambil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->index();
            $table->string('unique_id', 16)->unique();
            $table->string('name', 255);
            $table->string('image', 255);
            $table->string('unit', 255);
            $table->integer('stock');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_ambil');
    }
}
