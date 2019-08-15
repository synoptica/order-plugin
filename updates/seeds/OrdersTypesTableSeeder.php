<?php

use October\Rain\Database\Updates\Seeder;

class OrdersTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders_types')->delete();
        
        \DB::table('orders_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ACTIVATION',
                'code' => 'ACTIVATION',
                'descr' => 'ACQUISTO SERVIZI',
                'sign' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'RENEW',
                'code' => 'RENEW',
                'descr' => 'RINNOVO SERVIZI',
                'sign' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'RETRY',
                'code' => 'RETRY',
                'descr' => 'ACQUISTO SERVIZI',
                'sign' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'RECOVER',
                'code' => 'RECOVER',
                'descr' => 'ACQUISTO SERVIZI',
                'sign' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'UPGRADE',
                'code' => 'UPGRADE',
                'descr' => 'UPGRADE SERVIZI',
                'sign' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'REACTIVATION',
                'code' => 'REACTIVATION',
                'descr' => 'RIATTIVAZIONE - RINNOVO SERVIZI',
                'sign' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'UPSELL',
                'code' => 'UPSELL',
                'descr' => 'ATTIVAZIONE SERVIZI',
                'sign' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'REFUND',
                'code' => 'REFUND',
                'descr' => 'RIMBORSO PRODOTTI O SERVIZI NON FRUITI',
                'sign' => -1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'DEVELOPMENT',
                'code' => 'DEVELOPMENT',
                'descr' => 'CONSULENZA - SVILUPPO',
                'sign' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'MAINTENANCE',
                'code' => 'MAINTENANCE',
                'descr' => 'SUPPORTO - MANUTENZIONE',
                'sign' => 1,
            ),
        ));
        
        
    }
}