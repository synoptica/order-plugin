<?php namespace Synoptica\Order\Models;

use Model;
use Synoptica\Order\Models\Order;

/**
 * Model
 */
class Invoice extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    public $belongsTo = [
        'order' => 'Synoptica\Order\Models\Order',
        'profile' => 'Synoptica\Order\Models\Profile',
        'mode' => 'Synoptica\Profile\Models\Mode',
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'orders_invoices';

    protected $legacy = 
    [
        'invoice_code' => 'code',
        'invoice_external_code' => 'external_code',
        'invoice_order_id' => 'order_id',
        'invoice_customer_id' => 'customer_id',
        'invoice_number' => 'number',
        'invoice_type' => 'type',
        'invoice_format' => 'format',
        'invoice_date' => 'date',
        'invoice_status' => 'status',
        'invoice_result' => 'result',
        'invoice_error' => 'error',
        'invoice_received_at' => 'received_at',
        'invoice_delivered_at' => 'delivered_at',
        'invoice_created_at' => 'created_at',
        
    ];


    public function ingest($object){

        foreach ($this->legacy as $old => $new){
            if ($new && isset($object->$old) && $object->$old != '0000-00-00 00:00:00') {
                $this->$new = $object->$old;
            }
        }
    }

    public function initExternalCode(){
        $this->external_code = 'DH_'.
            env('VAT_COUNTRY_CODE').
            env('VAT_ID').
            $this->type.
            date("Ymd", strtotime($this->date)).
            $this->number();
    }

    public function initCode(){
        $this->code = strtoupper(str_pad(base_convert($this->id(), 10, 36), 5, '0', STR_PAD_LEFT));
    }
/*
    public function setByOrder(Order $order){
        $this->order = $order;

        if (!$this->number()){
			$year = date("Y", strtotime($this->getBilledAt()));
			$last_invoice_id = OrderPeer::fetchLastInvoiceId($year);

			if (!$last_invoice_id){
				// New Year initialize
				$last_invoice_id = "S0-".$year;
			}
			list($id, $year) = explode("-", $last_invoice_id);
			$number = intval(str_replace("S", "", $id));

			$next = sprintf('S%06d-%s', ++$number, $year);
			$this->setInvoiceId($next);
		}

        $this->getByField('invoice_order_id', $order->getId());
        $this->setOrderId($order->getId());
        $this->setNumber($order->getInvoiceId());
        $this->setDate(date("Y-m-d", strtotime($order->getBilledAt())));
        $this->setType($this->getOrder()->getInvoiceType() == 'FATTURA' ? 'TD01' : 'TD04');

        if ($order->getCustomer()->getPiva() == '00000000000' && 
            ($order->getCustomer()->getCodfis() == '00000000000' || !$order->getCustomer()->getCodfis()) &&
            $order->getCustomer()->getCeoId()
        ){
            $this->customer = $order->getCustomer()->getCeo();
            $this->setCustomerId($order->getCustomer()->getCeoId());
		} else {
            $this->setCustomerId($order->getCustomer()->getId());
            $this->customer = $order->getCustomer();
        }

        $this->save();
        $this->load();
        $this->initCode();
        $this->initExternalCode();
        $this->save();
    }

    */
}
