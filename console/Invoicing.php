<?php namespace Synoptica\Order\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Synoptica\Order\Models\Order;
use Synoptica\Order\Models\Type;
use Synoptica\Order\Models\Payment;
use Synoptica\Order\Models\Status;
use Synoptica\Order\Models\Transaction;
use Synoptica\Order\Models\Transline;
use Synoptica\Order\Models\Invoice;

use Carbon\Carbon;
use System\Models\File;
use Db;

class Invoicing extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'Synoptica.Order:Invoicing';

    /**
     * @var string The console command description.
     */
    protected $description = 'Invoicing Flow';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        if (method_exists($this, 'invoicing_'.$this->argument('type'))){
            $this->{'invoicing_'.$this->argument('type')}();
        } else {
            $this->output->writeln('INVOICING TYPE not found');
        }

        $this->output->writeln('**********************************');
    }

    protected function invoicing_init(){

        $orders = Order::orderBy('billed_at', 'ASC')
            ->where('status.invoiceable', true)
            ->where('billed_at', '>=', '2019-01-01')
            ->where('total', '>', 0)
            ->whereNotNull('customer')
            ->whereNull('invoice');

        foreach ($orders as $order){
            print "ciao";
        }

    }

    protected function invoicing_none(){}


    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['type', InputArgument::OPTIONAL, 'Invoicing Type type', 'none'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['all', null, InputOption::VALUE_OPTIONAL, 'invoicing all (optional)', null],
        ];
    }

}
