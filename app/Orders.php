<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $fillable = [
        "customer_name",
        "customer_address",
        "customer_email",
        "phone",
        "customer_address_google_map",
        "customer_remarks",
        "customer_login_email",
        "customer_password",
        "product_name",
        "product_details",
        "product_price",
        "product_image",
        "order_qty",
        "order_delivery_time",
        "order_frequency",
        "order_payment_type",
        "order_paid",
        "admin_remarks",
        "delivery_boy_remarks",
        "staff_remarks",
        "delivery_time",
        "device_ip_address",
        "device_cookie_session",
    ];
}
