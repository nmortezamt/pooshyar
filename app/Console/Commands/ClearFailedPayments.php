<?php

namespace App\Console\Commands;

use App\Models\payment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ClearFailedPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:clear-failed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear failed payments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $two_hours_ago = Carbon::now()->subHours(2);
        payment::where('created_at', '<', $two_hours_ago)->where('status', 0)->delete();
        $this->info('Failed payment clear successfully');
    }
}
