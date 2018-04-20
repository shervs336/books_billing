<!-- Code Field -->
<div class="form-group col-sm-12">
    <table class="table table-responsive table-bordered" id="saleFieldTable">
      <thead>
        <th>Book Title</th>
        <th>Quantity</th>
        <th>Price</th>
      </thead>
      @if(isset($sales))

      @else
      <tbody>
        <tr>
          <td>{!! Form::select('book_id[]', $books, null, ['class' => 'form-control']) !!}</td>
          <td>{!! Form::text('quantity[]', null, ['class' => 'form-control']) !!}</td>
          <td>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">₱</span>
              {!! Form::text('price[]', null, ['class' => 'form-control']) !!}
            </div>
          </td>
        </td>
      </tbody>
      @endif
    </table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('Add Book', ['class' => 'btn btn-success', 'id' => 'addBook']) !!}
    {!! Form::button('Remove Book', ['class' => 'btn btn-danger', 'id' => 'removeBook']) !!}
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sales.index') !!}" class="btn btn-default">Cancel</a>
</div>


@section('scripts')
  <script>
    var saleRow = '';
    $(function(){

      saleRow = $('#saleFieldTable tbody tr').last().wrap('<p/>').parent().html();
      $('#saleFieldTable tbody tr:last-child').unwrap();

      $('#addBook').click(function(){
        $('#saleFieldTable tbody').append(saleRow);
        $('#saleFieldTable tbody tr:last-child input').val();
      });

      $('#removeBook').click(function(){
        if($('#saleFieldTable tbody tr').length > 1)
          $('#saleFieldTable tbody tr:last-child').remove();
      });

    });
  </script>
@endsection
