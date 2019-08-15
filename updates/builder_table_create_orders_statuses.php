<?php namespace Synoptica\Order\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOrdersStatuses extends Migration
{
    public function up()
    {
        Schema::create('orders_statuses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 45);
            $table->string('code', 45);
            $table->string('descr', 1024);
            $table->string('document_type', 4)->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders_statuses');
    }
}
