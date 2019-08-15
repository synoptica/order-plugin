<?php

use October\Rain\Database\Updates\Seeder;

class SynopticaOrderMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders_methods')->delete();
        
        \DB::table('orders_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Rimessa Diretta',
                'descr' => 'Rimessa Diretta',
                'code' => 'RD',
                'days' => 0,
                'is_endmonth' => 0,
                'is_enabled' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Bonifico 30GG',
                'descr' => 'Bonifico 30GG',
                'code' => 'BB30G',
                'days' => 30,
                'is_endmonth' => 1,
                'is_enabled' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bonifico 60GG',
                'descr' => 'Bonifico 60GG',
                'code' => 'BB60G',
                'days' => 60,
                'is_endmonth' => 1,
                'is_enabled' => 1,
            )
        ));
        
        
    }
}