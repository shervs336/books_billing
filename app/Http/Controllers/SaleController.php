<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Repositories\SaleRepository;
use App\Repositories\BookRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Models\Book;
use PDF;

class SaleController extends AppBaseController
{
    /** @var  SaleRepository */
    private $saleRepository;

    public function __construct(SaleRepository $saleRepo, BookRepository $bookRepo)
    {
        $this->saleRepository = $saleRepo;
    }

    /**
     * Display a listing of the Sale.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->saleRepository->pushCriteria(new RequestCriteria($request));
        $sales = $this->saleRepository->all();

        return view('sales.index')
            ->with('sales', $sales);
    }

    /**
     * Show the form for creating a new Sale.
     *
     * @return Response
     */
    public function create(BookRepository $books)
    {

        $booksJson = $books->all();

        $books = $books->all()->map(function($item){
          return $item['title'] . ' (' . $item['stocks'] .')';
        })->toArray();

        return view('sales.create')
            ->with('books', $books)
            ->with('booksJson', $booksJson);
    }

    /**
     * Store a newly created Sale in storage.
     *
     * @param CreateSaleRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if(!isset($input["book_id"])){
          Flash::error('No items selected.');
          return redirect(route('sales.create'));
        }

        DB::transaction(function() use ($input){
          $sale = $this->saleRepository->create(['code' => str_random(6)]);
          for($i = 0; $i < count($input["book_id"]); $i++) {

            $book = Book::find($input["book_id"][$i]);
            // Reduce Stock Number
            $book->stocks = $book->stocks - $input["quantity"][$i];
            $book->save();

            $sale->books()->attach($input["book_id"][$i], [
              'quantity' => $input["quantity"][$i],
              'price' => $input["price"][$i],
              'total_price' => $input["price"][$i] * $input["quantity"][$i]
            ]);

          }
        });

        Flash::success('Sale saved successfully.');

        return redirect(route('sales.index'));
    }

    /**
     * Display the specified Sale.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sale = $this->saleRepository->findWithoutFail($id);

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        return view('sales.show')->with('sale', $sale);
    }

    /**
     * Show the form for editing the specified Sale.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, BookRepository $books)
    {
        $sale = $this->saleRepository->findWithoutFail($id);

        $booksJson = $books->all();

        $books = $books->all()->map(function($item){
          return $item['title'] . ' (' . $item['stocks'] .')';
        })->toArray();

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        return view('sales.edit')->with('sale', $sale)
            ->with('books', $books)
            ->with('booksJson', $booksJson);
    }

    /**
     * Update the specified Sale in storage.
     *
     * @param  int              $id
     * @param UpdateSaleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSaleRequest $request)
    {
        $sale = $this->saleRepository->findWithoutFail($id);

        $input = $request->all();

        if(!isset($input["book_id"])){
          Flash::error('No items selected.');
          return redirect(route('sales.create'));
        }

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        DB::transaction(function() use ($input, $sale){
          // Restore Old Values
          foreach ($sale->books as $book) {

            $bookOriginal = Book::find($book->id);

            // Return Stock Number
            $bookOriginal->stocks = $bookOriginal->stocks + $book->getOriginal('pivot_quantity');
            $bookOriginal->save();

            $sale->books()->detach($bookOriginal->id);
          }

          for($i = 0; $i < count($input["book_id"]); $i++) {

            $book = Book::find($input["book_id"][$i]);
            // Reduce Stock Number
            $book->stocks = $book->stocks - $input["quantity"][$i];
            $book->save();

            $sale->books()->attach($input["book_id"][$i], [
              'quantity' => $input["quantity"][$i],
              'price' => $input["price"][$i],
              'total_price' => $input["price"][$i] * $input["quantity"][$i]
            ]);

          }


        });

        //$sale = $this->saleRepository->update($request->all(), $id);

        Flash::success('Sale updated successfully.');

        return redirect(route('sales.index'));
    }

    /**
     * Remove the specified Sale from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sale = $this->saleRepository->findWithoutFail($id);

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        DB::transaction(function() use ($id, $sale){
          foreach ($sale->books as $book) {

            $bookOriginal = Book::find($book->id);

            // Return Stock Number
            $bookOriginal->stocks = $bookOriginal->stocks + $book->getOriginal('pivot_quantity');
            $bookOriginal->save();
          }

          $this->saleRepository->delete($id);
        });



        Flash::success('Sale deleted successfully.');

        return redirect(route('sales.index'));
    }

    public function print($id)
    {
      $sale = $this->saleRepository->findWithoutFail($id);

      $pdf = PDF::loadView('sales.print', compact('sale'));
      return $pdf->stream('Receipt-No-'.str_pad($sale->id, 8, 0, STR_PAD_LEFT).'.pdf');
    }
}
