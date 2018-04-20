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

        $books = $books->all()->mapWithKeys(function($item){
          return [$item['id'] => $item['title'] . ' (' . $item['stocks'] .')'];
        })->toArray();

        return view('sales.create')
            ->with('books', $books);
    }

    /**
     * Store a newly created Sale in storage.
     *
     * @param CreateSaleRequest $request
     *
     * @return Response
     */
    public function store(CreateSaleRequest $request)
    {
        $input = $request->all();

        $sale = $this->saleRepository->create($input);

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
    public function edit($id)
    {
        $sale = $this->saleRepository->findWithoutFail($id);

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        return view('sales.edit')->with('sale', $sale);
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

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        $sale = $this->saleRepository->update($request->all(), $id);

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

        $this->saleRepository->delete($id);

        Flash::success('Sale deleted successfully.');

        return redirect(route('sales.index'));
    }
}
