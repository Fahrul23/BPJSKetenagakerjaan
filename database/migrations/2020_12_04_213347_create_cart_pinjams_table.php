<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartPinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_pinjam', function (Blueprint $table) {
            $table->bigInteger('user_id')->index();
            $table->bigInteger('to');
            $table->bigInteger('item_id');
            $table->text('keterangan');
            $table->timestamp('date_start');
            $table->timestamp('date_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_pinjam');
    }
}
