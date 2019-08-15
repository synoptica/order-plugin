<?php namespace Synoptica\Order\Models;

use Model;

/**
 * Model
 */
class Method extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'orders_methods';

    public $hasMany = [
        'invoices' => 'Synoptica\Order\Models\Invoice',
    ];
}
