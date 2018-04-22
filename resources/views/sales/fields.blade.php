<!-- Code Field -->
<div class="form-group col-sm-12">
    <div class="form-inline">
      <div class="form-group">
        {!! Form::select('books', $books, null, ['class' => 'form-control selectpicker', 'id' => 'books']) !!}
      </div>
      {!! Form::button('Add Book', ['class' => 'btn btn-success', 'id' => 'addBook']) !!}
      {!! Form::button('Remove Book', ['class' => 'btn btn-danger', 'id' => 'removeBook']) !!}
    </div>
    <br />
    <table class="table table-responsive table-bordered" id="saleFieldTable">
      <thead>
        <th>Book Title</th>
        <th>Quantity</th>
        <th>Price</th>
      </thead>
      <tbody>
        <tr>
          <td>{!! Form::hidden('book_id[]', null) !!}</td>
          <td>{!! Form::text('quantity[]', null, ['class' => 'form-control']) !!}</td>
          <td>
            ₱ {!! Form::hidden('price[]', null, ['class' => 'form-control']) !!}
          </td>
        </tr>
        @if(isset($sale))
          @foreach($sale->books as $book)
            <tr>
              <td>{!! Form::hidden('book_id[]', $book->id) !!}{{ $book->title }}</td>
              <td>{!! Form::text('quantity[]', $book->getOriginal('pivot_quantity'), ['class' => 'form-control']) !!}</td>
              <td>
                ₱ {!! Form::hidden('price[]', $book->getOriginal('price'), ['class' => 'form-control']) !!}{{ $book->price }}
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sales.index') !!}" class="btn btn-default">Cancel</a>
</div>


@section('scripts')
  <script>
    var saleRow = '';
    var bookData = {!! json_encode($booksJson->toArray()) !!};
    $(function(){
      $('.selectpicker').select2();

      saleRow = $('#saleFieldTable tbody tr').first().wrap('<p/>').parent().html();
      $('#saleFieldTable tbody tr:first-child').unwrap();

      @if(Request::is('sales/*/edit'))
        $('#saleFieldTable tbody tr:first-child').remove();
      @endif

      @if(Request::is('sales/create'))
        $('#saleFieldTable tbody').empty();
      @endif

      $('#addBook').click(function(){
        var selection = $('#books').val();
        console.log(bookData[selection]);
        $('#saleFieldTable tbody').append(saleRow);
        $('#saleFieldTable tbody tr:last-child input').val();
        fillColumn(1, bookData[selection]['title']);
        fillValue('[name="book_id[]"]', bookData[selection]['id']);
        fillColumn(2, '<i class="text-danger">'+bookData[selection]['stocks'] + ' books remaining</i>');
        fillValue('[name="price[]"]', bookData[selection]['price']);
        fillColumn(3, bookData[selection]['price']);
      });

      $('#removeBook').click(function(){
        if($('#saleFieldTable tbody tr').length > 0)
          $('#saleFieldTable tbody tr:last-child').remove();
      });

      function fillColumn(nth, param)
      {
        $('#saleFieldTable tbody tr:last-child td:nth-child('+nth+')').append(param);
      }

      function fillValue(target, value)
      {
        $('#saleFieldTable tbody tr:last-child '+target).val(value);
      }

    });
  </script>
@endsection
