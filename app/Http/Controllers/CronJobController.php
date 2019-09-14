<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Subscription;
class CronJobController extends Controller {

    //    Cron Function
    public function statusCron() {

        //Get All subscriptions whose ends date expired 
        
        $subscriptions = Subscription::whereDate('ends_at', '<', Carbon::now())->get();
//        dd($subscriptions);
        foreach ($subscriptions as $subscription) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $subscription_id = $subscription->stripe_id; 
            $id = $subscription->user_id;
            $stripe_details = \Stripe\Subscription::retrieve($subscription_id);
//            dd($stripe_details);
           
            $status = $stripe_details->status;

            if ($status == 'active') {

                $timestamp = $stripe_details->current_period_end;
                $periods_end = date('Y-m-d H:i:s', $timestamp);
//                dd($periods_end);
                $subscription = Subscription::where('user_id', $id)->where('stripe_id', $subscription_id)->first();

                $subscription->ends_at = $periods_end;
//                $subscription->status = 1;
                $subscription->count = $subscription->count + 1;
                $subscription->save();

            } else {
                  Subscription::where('user_id', $id)->where('stripe_id', $subscription_id)->delete();
//                $subscription = Subscription::where('user_id', $id)->where('stripe_id', $subscription_id)->first();
//                $subscription->status = 0;
//                $subscription->save();
            }
        }
        
    }

}
