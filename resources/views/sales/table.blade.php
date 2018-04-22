<table class="table table-responsive" id="sales-table">
    <thead>
        <tr>
            <th>Code</th>
            <th>Total Amount</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sales as $sale)
        <tr>
            <td>{!! str_pad($sale->id, 8, 0, STR_PAD_LEFT) !!}</td>
            @php
              $total_price = 0;
              foreach($sale->books as $book)
              {
                $total_price += $book->getOriginal('pivot_total_price');
              }
            @endphp
            <td>₱ {!! number_format($total_price, 2) !!}</td>
            <td>
                {!! Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sales.edit', [$sale->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="{!! route('sales.print', [$sale->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
