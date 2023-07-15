<?php

namespace App\Console\Commands;

use App\Models\order;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ClearFailedOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:clear-payment-failed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear orders payment failed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $two_hours_ago = Carbon::now()->subHours(1);
        order::where('created_at', '<', $two_hours_ago)->where('payment',0)->delete();
        $this->info('Failed payment order clear successfully');
    }
}
