<?php

namespace App\Observers;

use App\Models\Product;
use Carbon\Carbon;

class ProductObServer
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        if($product->sale_price != null){
            $product->is_sale = true;
            $product->save();
        }
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        if($product->sale_price != null){
            $product->is_sale = true;
            $product->save();
        } else {
            $product->is_sale = false;
            $product->save();
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "retrieved" event
     * @param \App\Models\Product $product
     * @return void
     */
    public function retrieved(Product $product)
    {
        if ($product->created_at < Carbon::now()->subDays(14) && $product->is_new = true) {
            $product->is_new = false;
            $product->save();
        }
    }
}
