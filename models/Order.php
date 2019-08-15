<?php namespace Synoptica\Order\Models;

use Model;

/**
 * Model
 */
class Order extends Model
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
    public $table = 'orders';

    protected $appends = [
        'total_money',
        'subtotal_money',
        'tax_money'
    ];

    public $belongsTo = [
        'customer' => [
            'Synoptica\Order\Models\Profile', 
            'key'                           => 'customer_id', 
            'otherKey'                      => 'id', 
            'scope'                         => 'customer'
        ],
        'type' => 'Synoptica\Order\Models\Type',
        'status' => 'Synoptica\Order\Models\Status',
        'payment' => 'Synoptica\Order\Models\Payment',
        'method' => 'Synoptica\Order\Models\Method',
    ];

    public $hasMany = [
        'translines' => 'Synoptica\Order\Models\Transline',
    ];

    protected $legacy = 
    [
        'order_code' => 'code',
        'order_sid' => 'sid',
        'order_customer_id' => 'customer_id',
        'order_subtotal' => 'subtotal',
        'order_tax' => 'tax',
        'order_total' =>  'total',
        'order_cost' => 'cost',
        'order_utm_source' => 'utm_source',
        'order_utm_term' => 'utm_term',
        'order_utm_content' => 'utm_content',
        'order_utm_campaign' => 'utm_campaign',
        'order_billed_at' => 'billed_at',
        'order_created_at' => 'created_at',
        'order_updated_at' => 'updated_at'
    ];

    public function ingest($object){

        foreach ($this->legacy as $old => $new){
            if ($new && isset($object->$old) && $object->$old != '0000-00-00 00:00:00') {
                $this->$new = $object->$old;
            }
        }
    }

    public function getTotalMoneyAttribute(){
        return money_format('%.2n', $this->total/100);
    }
    public function getSubtotalMoneyAttribute(){
        return money_format('%.2n', $this->subtotal/100);
    }
    public function getTaxMoneyAttribute(){
        return money_format('%.2n', $this->tax/100);
    }

}
