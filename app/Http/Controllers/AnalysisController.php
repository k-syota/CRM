<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
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

        $startDate = '2023-01-17';
        $endDate = '2023-01-31';

        $period = Order::betweenDate($startDate, $endDate)->groupBy('id')
        ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at') ->orderBy('created_at')
        ->paginate(50);

        // dd($period);

        return Inertia::render('Analysis');
    }
}
