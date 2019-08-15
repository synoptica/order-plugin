<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOrdersMethods extends Migration
{
    public function up()
    {
        Schema::create('orders_methods', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('descr', 1024)->nullable();
            $table->string('code', 45);
            $table->integer('days')->default(0);
            $table->boolean('is_endmonth')->default(0);
            $table->boolean('is_enabled')->default(1);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders_methods');
    }
}
