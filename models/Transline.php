<?php namespace Synoptica\Order\Models;

use Model;

/**
 * Model
 */
class Transline extends Model
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
    public $table = 'orders_translines';

    public $belongsTo = [
        'order' => 'Synoptica\Order\Models\Order',
        'product' => 'Synoptica\Product\Models\Product',
    ];

    protected $legacy = 
    [
        'transline_order_id' => 'order_id',
        'transline_product_id' => 'product_id',
        'transline_product_price' => 'product_price',
        'transline_product_cost' => 'product_cost',
        'transline_quantity' => 'quantity',
        'transline_subtotal' => 'subtotal',
        'transline_cost' => 'cost',
        'transline_descr' => 'descr',
        'transline_created_at' => 'created_at',
    ];

    public function ingest($object){

        foreach ($this->legacy as $old => $new){
            if ($new && isset($object->$old) && $object->$old != '0000-00-00 00:00:00') {
                $this->$new = $object->$old;
            }
        }

        if (!$object->transline_product_id){
            if ($object->transline_product_price == 1000){
                $this->product_id = 1;
            } elseif ($object->transline_product_price == 3500){
                $this->product_id = 5;
            }
        }
    }
}
