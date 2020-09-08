<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id', false, true)->nullable();
            $table->text('order_data');
            $table->string('phone', 20);
            $table->string('email', 320);
            $table->integer('price')->comment('Total order price');
            $table->tinyInteger('status')->default(0)->comment('Order status in system');
            $table->string('order_number')->comment('Unique order number');
            $table->string('order_num_tunn')->comment('Unique order number');
            $table->string('order_id_tunn')->comment('Unique order number');
            $table->string('billnumber')->comment('Bill number from pay system');
            $table->string('pay_type')->default('')->comment('Credit card type');
            $table->string('promocode')->default('')->comment('Used promocode');
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
        Schema::dropIfExists('orders');
    }
}
