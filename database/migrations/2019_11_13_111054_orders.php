<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table) {
        $table->string('customer_name');
        $table->string('customer_address');
        $table->string('customer_email');
        $table->string('phone');
        $table->text('customer_address_google_map');
        $table->text('customer_remarks');
        $table->string('customer_login_email');
        $table->string('customer_password');
        $table->string('product_name');
        $table->string('product_details');
        $table->integer('product_price');
        $table->string('product_image');
        $table->string('order_qty');
        $table->string('order_delivery_time');
        $table->string('order_frequency');
        $table->string('order_payment_type');
        $table->string('order_paid');
        $table->text('admin_remarks');
        $table->text('delivery_boy_remarks');
        $table->text('staff_remarks');
        $table->date('delivery_time');
        $table->string('device_ip_address');
        $table->string('device_cookie_session');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
