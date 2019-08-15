<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOrdersInvoices extends Migration
{
    public function up()
    {
        Schema::create('orders_invoices', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('code', 5)->nullable();
            $table->string('external_code', 50)->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('series', 1)->default('S');
            $table->string('number', 45)->nullable();
            $table->string('type', 4)->default('TD01');
            $table->string('format', 15)->default('FPR12');
            $table->date('date');
            $table->string('status', 45)->nullable();
            $table->string('result', 15)->nullable();
            $table->string('error', 1024)->nullable();
            $table->integer('method_id')->unsigned()->default(1);
            $table->date('expiring_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders_invoices');
    }
}
