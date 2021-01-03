<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('activity', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->integer('user_id');
        //     $table->integer('item_id');
        //     $table->integer('quantity');
        //     $table->string('alasan')->nullable();
        //     $table->timestamp('date_start')->nullable();
        //     $table->timestamp('date_end')->nullable();
        //     $table->timestamp('confirmed_at')->nullable();
        //     $table->timestamp('returned_at')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
