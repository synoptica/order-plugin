<?php

use October\Rain\Database\Updates\Seeder;

class OrderStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders_statuses')->delete();
        
        \DB::table('orders_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'CREATED',
                'descr' => 'CREATED',
                'code' => 'CREATED',
                'document_type' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'WAITING',
                'descr' => 'WAITING',
                'code' => 'WAITING',
                'document_type' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'PENDING_RENEWAL',
                'descr' => 'PENDING_RENEWAL',
                'code' => 'PENDING_RENEWAL',
                'document_type' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'WAITING_PAYPAL_PAYMENT',
                'descr' => 'WAITING_PAYPAL_PAYMENT',
                'code' => 'WAITING_PAYPAL_PAYMENT',
                'document_type' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'WAITING_STRIPE_PAYMENT',
                'descr' => 'WAITING_STRIPE_PAYMENT',
                'code' => 'WAITING_STRIPE_PAYMENT',
                'document_type' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'PENDING_UPSELL',
                'descr' => 'PENDING_UPSELL',
                'code' => 'PENDING_UPSELL',
                'document_type' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'BILLED',
                'descr' => 'BILLED',
                'code' => 'BILLED',
                'document_type' => 'TD01',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'DONE',
                'descr' => 'DONE',
                'code' => 'DONE',
                'document_type' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'REFUNDED',
                'descr' => 'REFUNDED',
                'code' => 'REFUNDED',
                'document_type' => 'TD04',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'UNDEFINED',
                'descr' => 'UNDEFINED',
                'code' => 'UNDEFINED',
                'document_type' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'BILLED_PENDING_NOTIFY',
                'descr' => 'BILLED_PENDING_NOTIFY',
                'code' => 'BILLED_PENDING_NOTIFY',
                'document_type' => 'TD01',
            ),
        ));
        
        
    }
}