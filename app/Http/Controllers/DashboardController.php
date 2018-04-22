<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Sale;
use DB;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $sales = Sale::all();

        $totalSales = 0;

        foreach($sales as $sale)
        {
          foreach($sale->books as $book)
          {
            $totalSales += $book->getOriginal('pivot_total_price');
          }
        }

        $salesYears = DB::table('sales')->select(DB::raw("DISTINCT(YEAR(created_at)) as `year`"))
          ->whereNotNull('deleted_at')
          ->groupBy(DB::raw('YEAR(created_at)'))
          ->orderBy('year')->get();

        $salesYears = $salesYears->map(function($item){
          return $item->year;
        });

        $salesData = DB::table('sales')
        ->select(DB::raw("YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_price) as `total_price`"))
          ->join('book_sale', 'sales.id', '=', 'book_sale.sale_id')
          ->whereNotNull('deleted_at')
          ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
          ->orderBy(DB::raw('year, month'))
          ->get();

          $salesData = $salesData->mapToGroups(function ($item, $key) {
              return [$item->year => $item];
          });

        

        return view('dashboard', compact('books', 'sales', 'totalSales', 'salesData', 'salesYears'));
    }
}
