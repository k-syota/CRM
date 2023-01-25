<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AnalysisController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {

        $startDate = '2023-01-01';
        $endDate = '2023-01-31';

        $subQuery = Order::betweenDate($startDate, $endDate)
        ->groupBy('id')
        ->selectRaw('id, customer_id, customer_name, SUM(subtotal) as totalPerPurchase, created_at');

        $subQuery = DB::table($subQuery)
        ->groupBy('customer_id')
        ->selectRaw('customer_id, customer_name, max(created_at) as recentDate,
        datediff(now(), max(created_at)) as recency, count(customer_id) as frequency,
        sum(totalPerPurchase) as monetary');

        $subQuery = DB::table($subQuery)
        ->selectRaw('customer_id, customer_name, recentDate, recency, frequency, monetary,
        case
            when recency < 14 then 5
            when recency < 28 then 4
            when recency < 60 then 3
            when recency < 60 then 2
            else 1 end as r,
        case
            when 7 <= frequency then 5
            when 5 <= frequency then 4
            when 3 <= frequency then 3
            when 2 <= frequency then 2
            else 1 end as f,
        case
            when 300000 <= monetary then 5
            when 200000 <= monetary then 4
            when 100000 <= monetary then 3
            when 3000 <= monetary then 2
            else 1 end as m');

        $total = DB::table($subQuery)->count();
        $rCount = DB::table($subQuery)->groupBy('r')
        ->selectRaw('r, count(r)')->orderBy('r', 'desc')
        ->get();
        $fCount = DB::table($subQuery)->groupBy('f')
        ->selectRaw('f, count(f)')->orderBy('f', 'desc')
        ->get();
        $mCount = DB::table($subQuery)->groupBy('m')
        ->selectRaw('m, count(m)')->orderBy('m', 'desc')
        ->get();

        // dd($subQuery);
        dd($total,$rCount,$fCount,$mCount);

        return Inertia::render('Analysis');
    }
}
