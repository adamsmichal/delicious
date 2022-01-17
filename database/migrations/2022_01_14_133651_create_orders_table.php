<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OrderPaymentStatusEnum;

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
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('address_id')->constrained();
            $table->text('notes')->nullable();
            $table->enum('payment_status', OrderPaymentStatusEnum::TYPES)->default(OrderPaymentStatusEnum::NOT_PAID);
            $table->dateTime('payment_date');
            $table->integer('products_price')->unsigned();
            $table->integer('shipment_price')->unsigned();
            $table->integer('total_price')->unsigned();
            $table->string('currency', 3);
//            $table->foreignId('payment_method_id')->constrained();
            $table->string('transaction_number');
//            $table->foreignId('discount_id')->constrained();
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
        Schema::dropIfExists('orders');
    }
}
