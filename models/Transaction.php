<?php namespace Synoptica\Order\Models;

use Model;

/**
 * Model
 */
class Transaction extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'orders_transactions';

    public $belongsTo = [
        'order' => 'Synoptica\Order\Models\Order',
        'payment' => 'Synoptica\Order\Models\Payment',
    ];

    protected $legacy = 
    [
        'transaction_order_id' => 'order_id',
        'transaction_total' => 'total',
        'transaction_cro' => 'cro',
        'transaction_card_id' =>  'card_id',
        'transaction_card_country' => 'card_country',
        'transaction_brand' => 'brand',
        'transaction_pan' => 'pan',
        'transaction_pan_last4' => 'pan_last4',
        'transaction_pan_exp' => 'pan_exp',
        'transaction_payer_name' => 'payer_name',
        'transaction_email' => 'email',
        'transaction_date' => 'date',
        'transaction_time' => 'time',
        'transaction_code_trans' => 'code_trans',
        'transaction_code_aut' => 'code_aut',
        'transaction_payer_id' => 'payer_id',
        'transaction_status' => 'status',
        'transaction_result' => 'result',
        'transaction_mac' => 'mac',
        'transaction_created_at' => 'created_at'
    ];

    public function ingest($object){

        foreach ($this->legacy as $old => $new){
            if ($new && isset($object->$old) && $object->$old != '0000-00-00 00:00:00') {
                $this->$new = $object->$old;
            }
        }
    }
}
