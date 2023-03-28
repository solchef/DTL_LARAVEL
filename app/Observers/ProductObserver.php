<?php

namespace App\Observers;
use Notification;
use App\Models\Product;
use App\Models\User;
use App\Observers\ProductObserver;
use \App\Notifications\NewProductNotification;

class ProductObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    
    public $afterCommit = true;

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        \Log::info("Product Added" . $product);
         $user = User::find($product->added_by_user_id);

         try {
            Notification::route('mail', [
                $user->email => $user->name,
            ])->notify(new NewProductNotification($product));
         } catch (\Throwable $th) {
             //just ignoring the mail sending if mailer not configured
         }
        
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        // $product->isDirty();
        \Log::info("Product was updated" . $product);
    }

}
