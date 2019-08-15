<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOrdersTransactions extends Migration
{
    public function up()
    {
        Schema::create('orders_transactions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('total')->nullable();
            $table->string('cro', 255)->nullable();
            $table->string('card_id', 255)->nullable();
            $table->string('card_country', 45)->nullable();
            $table->string('brand', 45)->nullable();
            $table->string('pan', 16)->nullable();
            $table->string('pan_last4', 4)->nullable();
            $table->string('pan_exp', 6)->nullable();
            $table->string('payer_name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('date', 8)->nullable();
            $table->string('time', 6)->nullable();
            $table->string('code_trans', 255)->nullable();
            $table->string('code_aut', 15)->nullable();
            $table->string('payer_id', 255)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('result', 2)->nullable();
            $table->string('mac', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders_transactions');
    }
}
