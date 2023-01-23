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
        ->selectRaw('id, customer_id, customer_name, SUM(subtotal) as totalPerPurchase');

        $subQuery = DB::table($subQuery)
        ->groupBy('customer_id')
        ->selectRaw('customer_id, customer_name, sum(totalPerPurchase) as total')
        ->orderBy('total', 'desc');

        DB::statement('set @row_num = 0;');
        $subQuery = DB::table($subQuery) ->selectRaw('
        @row_num:= @row_num+1 as row_num, customer_id,
        customer_name, total');

        $count = DB::table($subQuery)->count();
        $total = DB::table($subQuery)
        ->selectRaw('sum(total) as total')->get(); $total = $total[0]->total; // 構成比用
        $decile = ceil($count / 10); // 10分の1の件数を変数に入れる
        $bindValues = []; $tempValue = 0;

        for($i = 1; $i <= 10; $i++) {
            array_push($bindValues, 1 + $tempValue);
            $tempValue += $decile;
            array_push($bindValues, 1 + $tempValue);
        }

        dd($count,$decile,$bindValues);

        return Inertia::render('Analysis');
    }
}
