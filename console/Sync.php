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

class Sync extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'Synoptica.Order:Sync';

    /**
     * @var string The console command description.
     */
    protected $description = 'Sync Orders Synapsi';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        if (method_exists($this, 'sync_'.$this->argument('type'))){
            $this->{'sync_'.$this->argument('type')}();
        } else {
            $this->output->writeln('SYNC TYPE not found');
        }

        $this->output->writeln('**********************************');
    }

    
    protected function sync_orders(){

        foreach(Db::select('SELECT * from synapsi.orders where order_total > 0 and order_deleted=0') as $o){

            if (!$o->order_deleted){
                $o_id = (int)$o->order_id;
                $order = Order::find($o_id);

                if (!$order){
                    $order = new Order;
                    $order->id = $o_id;
                } elseif (!$this->option('all')) {
                    // content exists
                    continue;
                }

                if (($o->order_subtotal + $o->order_tax) != $o->order_total)
                {
                    if ($o->order_total * 100 == $o->order_tax*100 + $o->order_subtotal){
                        $o->order_total= $o->order_total*100;
                        $o->order_tax = $o->order_tax*100;
                    }                    
                }

                $order->ingest($o);

                if (!$o->order_status){
                    if (!empty($o->order_invoice_id)){
                        $o->order_status = 'DONE';
                    } else {
                        $o->order_status = 'UNDEFINED';
                    }
                }


                if ($o->order_payment){
                    $order->payment()->add(Payment::where('code', $o->order_payment)->first());
                }
                if ($o->order_status){
                    $order->status()->add(Status::where('code', $o->order_status)->first());
                }

                if(substr($o->order_code, 0, 8) == 'quivi.it'){
                    $order->type_id = 9;
                }  elseif ($o->order_reactivation){
                    $order->type_id = 6;
                } elseif ($o->order_upsell){
                    $order->type_id = 7;
                } elseif ($o->order_upgrade){
                    $order->type_id = 5;
                } elseif ($o->order_recover){
                    $order->type_id = 4;
                } elseif ($o->order_retry){
                    $order->type_id = 3;
                } elseif ($o->order_renew){
                    $order->type_id = 2;
                } elseif ($o->order_invoice_type=='NOTA DI CREDITO'){
                    $order->type_id = 8;
                }

                $order->save();
                $this->output->writeln('Order inserted/updated: '.$order->id.' / '.$order->code);

                foreach(Db::select('SELECT * from synapsi.transactions where transaction_deleted=0 and transaction_order_id='.$o->order_id) as $tx){
                    
                    $tx_id = (int)$tx->transaction_id;
                    $transaction = Transaction::find($tx_id);

                    if (!$transaction){
                        $transaction = new Transaction;
                        $transaction->id = $tx_id;
                    } elseif (!$this->option('all')) {
                        // content exists
                        continue;
                    }
                    
                    if ($tx->transaction_type){
                        $transaction->payment()->add(Payment::where('code', $tx->transaction_type)->first());
                    }

                    $transaction->ingest($tx);
                    $transaction->updated_at = $transaction->created_at;
                    $transaction->save();
                    $this->output->writeln('Transaction inserted/updated: '.$transaction->id.' / '.$order->code);
                }

                foreach(Db::select('SELECT * from synapsi.translines where transline_deleted=0 and transline_order_id='.$o->order_id) as $tl){
                    
                    $tl_id = (int)$tl->transline_id;
                    $transline = Transline::find($tl_id);

                    if (!$transline){
                        $transline = new Transline;
                        $transline->id = $tl_id;
                    } elseif (!$this->option('all')) {
                        // content exists
                        continue;
                    }
                    
                    $transline->ingest($tl);
                    $transline->updated_at = $transline->created_at;
                    $transline->save();
                    $this->output->writeln('Transline inserted/updated: '.$transline->id.' / '.$order->code);
                }

            }          
        }
    }

    protected function sync_invoices(){

        foreach(Db::select('SELECT * from synapsi.invoices') as $o){

            if (!$o->invoice_deleted){
                $o_id = (int)$o->invoice_id;
                $invoice = Invoice::find($o_id);

                if (!$invoice){
                    $invoice = new Invoice;
                    $invoice->id = $o_id;
                } elseif (!$this->option('all')) {
                    // content exists
                    continue;
                }

                $invoice->ingest($o);

                $invoice->save();
                $this->output->writeln('Invoice inserted/updated: '.$invoice->id.' / '.$invoice->number);

            }          
        }
    }

    protected function sync_none(){}


    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['type', InputArgument::OPTIONAL, 'Sync type', 'none'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['all', null, InputOption::VALUE_OPTIONAL, 'sync all (optional)', null],
            ['articles', null, InputOption::VALUE_OPTIONAL, 'get articles (optional)', null],
            ['attachments', null, InputOption::VALUE_OPTIONAL, 'get attachments (optional)', null],
            ['old', null, InputOption::VALUE_OPTIONAL, 'sync obsolete contents (optional)', null],
        ];
    }

}
