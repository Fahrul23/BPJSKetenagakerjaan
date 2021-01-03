<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPinjamDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pinjam_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id', 16)->unique();
            $table->bigInteger('item_pinjam_id')->index();
            $table->string('name', 255);
            $table->string('image', 255);
            $table->enum('status', [0, 1]);
            $table->enum('condition', ['bagus', 'rusak', 'hilang']);
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
        Schema::dropIfExists('item_pinjam_detail');
    }
}
