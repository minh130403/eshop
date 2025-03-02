<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Double;

class Cart
{
    public $items = [];
    public $totalPrice;
    public $totalQuantity;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items ?? [];
            $this->totalPrice = $oldCart->totalPrice ?? 0;
            $this->totalQuantity = $oldCart->totalQuantity ?? 0;
        }
        
    }

    public function addItem($item){
        if(array_key_exists($item->id, $this->items)){
            $this->items[$item->id]['quantity'] ++ ;
         
        } else {
            $newItem = [
                'item' => $item,
                'quantity' => 1,
                'totalPrice' => 0
            ]; 
            
            $this->items[$item->id] = $newItem;
           
        }
        
        $this->items[$item->id]['totalPrice'] += $item->price;
        $this->totalPrice = $this->totalPrice + $item->price;
        $this->totalQuantity = $this->totalQuantity + 1;
    }


    public function removeItem($item){
        if(array_key_exists($item->id, $this->items)){

            $removedItem = $this->items[$item->id];
            unset($this->items[$item->id]);
            $this->totalPrice = $this->totalPrice - $removedItem['totalPrice'];
            $this->totalQuantity = $this->totalQuantity - $removedItem['quantity'];
        } 
    }




}
