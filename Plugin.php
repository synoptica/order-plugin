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
        $this->registerConsoleCommand('Synoptica.Order:Sync', 'Synoptica\Order\Console\Sync');
        $this->registerConsoleCommand('Synoptica.Order:Invoicing', 'Synoptica\Order\Console\Invoicing');
    }
  
    public function boot(){
        if (getenv('LC_MONETARY')) {
            setlocale(LC_MONETARY, getenv('LC_MONETARY'));
        }
    }

}
