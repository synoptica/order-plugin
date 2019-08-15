<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOrders extends Migration
{
    public function up()
    {
        Schema::create('orders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('code', 45)->nullable();
            $table->string('sid', 32)->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('type_id')->default(1);
            $table->integer('subtotal')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('total')->nullable();
            $table->integer('cost')->nullable();
            $table->string('utm_source', 255)->nullable();
            $table->string('utm_term', 255)->nullable();
            $table->string('utm_content', 255)->nullable();
            $table->string('utm_campaign', 255)->nullable();
            $table->timestamp('billed_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
