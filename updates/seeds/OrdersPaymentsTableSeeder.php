<?php

use October\Rain\Database\Updates\Seeder;

class OrdersPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders_payments')->delete();
        
        \DB::table('orders_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'POS',
                'descr' => 'POS Payment',
                'code' => 'POS',
                'mp' => 'MP08',
                'is_enabled' => 0,
                'icon' => 'icon-credit-card',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'PayPal',
                'descr' => 'PayPal Payment',
                'code' => 'PAYPAL',
                'mp' => 'MP08',
                'is_enabled' => 1,
                'icon' => 'icon-cc-paypal',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bonifico Bancario',
                'descr' => 'Bonifico Bancario / Bank Transfer',
                'code' => 'BONIFICO',
                'mp' => 'MP05',
                'is_enabled' => 1,
                'icon' => 'fas fa-piggy-bank',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Bollettino',
                'descr' => 'Bollettino Postale',
                'code' => 'BOLLETTINO',
                'mp' => 'MP18',
                'is_enabled' => 0,
                'icon' => 'fas fa-envelope-square ',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Stripe',
                'descr' => 'Pagamento Stripe',
                'code' => 'STRIPE',
                'mp' => 'MP08',
                'is_enabled' => 1,
                'icon' => 'icon-cc-stripe',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Contanti',
                'descr' => 'Contanti',
                'code' => 'CONTANTI',
                'mp' => 'MP01',
                'is_enabled' => 1,
                'icon' => 'fas fa-money-bill',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Satispay',
                'descr' => 'Satispay',
                'code' => 'SATISPAY',
                'mp' => 'MP08',
                'is_enabled' => 1,
                'icon' => 'icon-cc-paypal',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Assegno',
                'descr' => 'Assegno',
                'code' => 'ASSEGNO',
                'mp' => 'MP02',
                'is_enabled' => 1,
                'icon' => 'fas fa-money-check-alt',
            ),
        ));
        
        
    }
}