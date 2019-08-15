<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSynopticaOrdersPayments extends Migration
{
    public function up()
    {
        Schema::create('orders_payments', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('descr', 1024)->nullable();
            $table->string('code', 45);
            $table->string('mp', 4);
            $table->string('icon', 45)->nullable();
            $table->boolean('is_enabled')->default(1);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders_payments');
    }
}
