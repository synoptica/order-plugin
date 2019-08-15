<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOrdersTypes extends Migration
{
    public function up()
    {
        Schema::create('orders_types', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('descr', 1024);
            $table->string('code', 255);
            $table->integer('sign')->default(1);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders_types');
    }
}
