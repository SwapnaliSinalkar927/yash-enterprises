<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\OrderOptionUpdate;

class RunOrderOptionUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order-option:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the OrderOptionUpdate job';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        OrderOptionUpdate::dispatch(); // Dispatch the job
        $this->info('OrderOptionUpdate job has been dispatched!');
    }
}
