<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\{Order,Wholesaler,WD};

class OrderOptionUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $wholesalerData = Wholesaler::with('wd:id,state')->get()->keyBy('id');

        Order::whereNull('option_name')->chunk(100, function ($orders) use ($wholesalerData) {
            foreach ($orders as $order) {
                $wholesaler = $wholesalerData->get($order->wholesaler_id);

                if ($wholesaler && $wholesaler->wd) {
                    $state = $wholesaler->wd->state;
                    $option = $state === "Madhya Pradesh" ? "Option 1" : ($state === "Chhattisgarh" ? "Option 2" : null);

                    if ($option) {
                        $order->update(['option_name' => $option, 'batch' => 1]);
                    }
                }
            }
        });
    }
}
