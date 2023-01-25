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
        sum(totalPerPurchase) as monetary')
        ->get();

        dd($subQuery);

        return Inertia::render('Analysis');
    }
}
