<?php namespace Synoptica\Order\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Methods extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Synoptica.Order', 'main-menu-item', 'side-menu-item4');
    }
}
