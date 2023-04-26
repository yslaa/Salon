<?php

namespace App;

class Trans
{
    /**
     * Class constructor.
     *
     * @return void
     */

     public $services = null;
     public $totalPrice = 0;
     public $count = 0 ;

    public function __construct($oldTrans) {
       
        if($oldTrans) {
            $this->services = $oldTrans->services;
            $this->totalPrice = $oldTrans->totalPrice;
            $this->count = 1;
        }

    }

    public function add($service, $id){
        //dd($this->items);
        $storedItem = ['price'=>$service->sell_price, 'service'=> $service];
        if ($this->services){
            if (array_key_exists($id, $this->services)){
                $storedItem = $this->services[$id];
            }
        }
       //$storedItem['qty'] += $item->qty;
    //    $storedItem['qty']++;
       
        $storedItem['price'] = $service->cost;
        $this->services[$id] = $storedItem;
        $this->totalPrice += $service->cost;
    }

    public function removeService($id){

        $this->totalPrice -= $this->services[$id]['price'];
        unset($this->services[$id]);
    }

}
