<?php namespace Synoptica\Order;

use System\Classes\PluginBase;

use App;

//use Synoptica\Order\Components\InvoicesList;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function register()
    {
    }
  
    public function boot(){
        if (getenv('LC_MONETARY')) {
            setlocale(LC_MONETARY, getenv('LC_MONETARY'));
        }
    }

}
