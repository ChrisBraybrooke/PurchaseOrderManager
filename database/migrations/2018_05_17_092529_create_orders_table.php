<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable()->default(null);
            $table->string('customer_name')->nullable()->default(null);
            $table->string('customer_order_ref')->nullable()->default(null);
            $table->string('own_order_ref')->nullable()->default(null);

            $table->string('billing_address_line1')->nullable()->default(null);
            $table->string('billing_address_line2')->nullable()->default(null);
            $table->string('billing_address_town')->nullable()->default(null);
            $table->string('billing_address_county')->nullable()->default(null);
            $table->string('billing_address_postcode')->nullable()->default(null);
            $table->string('billing_address_country')->nullable()->default(null);
            $table->boolean('use_billing_for_shipping')->default(true);

            $table->string('shipping_address_line1')->nullable()->default(null);
            $table->string('shipping_address_line2')->nullable()->default(null);
            $table->string('shipping_address_town')->nullable()->default(null);
            $table->string('shipping_address_county')->nullable()->default(null);
            $table->string('shipping_address_postcode')->nullable()->default(null);
            $table->string('shipping_address_country')->nullable()->default(null);

            $table->date('ship_date')->nullable()->default(null);
            $table->date('arrive_date')->nullable()->default(null);

            $table->longText('order_info')->nullable()->default(null);

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
