<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOrdersTranslines extends Migration
{
    public function up()
    {
        Schema::create('orders_translines', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('product_price')->nullable();
            $table->integer('product_cost')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('cost')->nullable();
            $table->string('descr', 255)->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders_translines');
    }
}
