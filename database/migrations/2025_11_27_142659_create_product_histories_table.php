<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('edited_by')->nullable()->constrained('users')->nullOnDelete();;
            $table->string('action');
            $table->string('old_name');
            $table->string('new_name');
            $table->string('old_quantity');
            $table->integer('quantity');
            $table->string('old_price');
            $table->string('price');
            $table->string('old_total_price');
            $table->string('total_price');
            $table->timestamps();

            $table->foreign('product_id')->nullOnDelete()->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_histories');
    }
}
