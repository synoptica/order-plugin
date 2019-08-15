<?php namespace Synoptica\Order\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Input;
use ApplicationException;

use Synoptica\Order\Models\Order;
use Synoptica\Order\Models\Payment;
use Synoptica\Order\Models\Status;

class Orders extends Controller
{
    public $implement = [        
        'Backend\Behaviors\ListController',        
        'Backend\Behaviors\FormController'    
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $layout = 'default';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Synoptica.Order', 'main-menu-item', 'side-menu-item');
        $this->addCss('/plugins/synoptica/order/assets/css/fontawesome.css', '5.8.1');
        $this->addCss('/plugins/synoptica/order/assets/css/brands.css', '5.8.1');
        $this->addCss('/plugins/synoptica/order/assets/css/solid.css', '5.8.1');
    }

    public function setbilled() {
        $this->setConfig('config_form_setbilled.yaml');
        $this->layout = 'modal';

        $id = $this->params[0];
        $order = Order::find($id);
        $order->billed_at = date("Y-m-d");
        $order->payment()->add(Payment::where('code', 'BONIFICO')->first());
        $order->status()->add(Status::where('code', 'BILLED_PENDING_NOTIFY')->first());

        $this->initForm($order, 'config_form_setbilled.yaml');


        return $this-> makePartial('setbilled', [
            'order' => $order
        ]);
    }

    public function onSetBilled()
    {

        if (!Input::get('order_id')) {
            throw new ApplicationException("Missing Order ID!");
        }
        
        $data = Input::get('Order');
        $order = Order::find(Input::get('order_id'));

        foreach ($data as $key => $value){
            $order->$key = $value;
        }
        
        if ($order->save()){        
            Flash::success('Saved!');
        } else {
            throw new ApplicationException("Save Error!");
        }
        /*
        return [
            'partialContents' => $this->makePartial('some-partial')
        ];
        */
    }
}
