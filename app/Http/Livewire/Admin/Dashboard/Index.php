<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

class Index extends Component
{

    public function render()
    {
        $payments = payment::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->where('status', 1)
            ->groupBy(DB::raw('MONTHNAME(created_at)'))
            ->pluck('count');

        $months = payment::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->where('status', 1)
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');

        $datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        $persian_months = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند'
        ];
        foreach ($months as $index => $month) {
            $date = Carbon::createFromDate(null, $month, 1)->startOfMonth();
            $jDate = Jalalian::fromCarbon($date);
            $month_index = $jDate->getMonth() - 1;
            $datas[$month_index] = $payments[$index];
            $month_name = $persian_months[$month_index];
        }

        $monthNames = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند'
        ];

        $yesterday = Carbon::yesterday();
        $yesterdayPayment = payment::whereDate('created_at', $yesterday)->where('status', 1)->sum('total_price');

        $today = Carbon::today();
        $todayPayment = payment::whereDate('created_at', $today)->where('status', 1)->sum('total_price');

        $date = Carbon::now()->subMonths(1);
        $datePayment_30 = payment::whereDate('created_at', $date)->where('status', 1)->sum('total_price');

        $transactions = payment::take(20)->latest()->get();
        return view('livewire.admin.dashboard.index', compact('yesterdayPayment', 'todayPayment', 'datePayment_30', 'transactions', 'datas', 'monthNames'));
    }
}
