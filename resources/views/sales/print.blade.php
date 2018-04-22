<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <h1 style="text-align:center">Sales Reciept</h1>
    <p style="text-align:left">Reference: <u>{!! str_pad($sale->id, 8, 0, STR_PAD_LEFT) !!}</u></p>
    <p style="text-align:left">Date: <u>{{ $sale->updated_at->format('F d, Y') }}</u></p>
    <br>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
      <thead>
        <tr>
          <th>Book</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($sale->books as $book)
          <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->getOriginal('pivot_quantity') }}</td>
            <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($book->getOriginal('pivot_price'),2) }}</td>
            <td><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($book->getOriginal('pivot_total_price'),2) }}</td>
          </tr>
          @php $grandTotal += $book->getOriginal('pivot_total_price'); @endphp
        @endforeach
          <tr>
            <td colspan="3" style="background-color: black; color: white; text-align: right"><b>Grand Total: </b></td>
            <td style="background-color: #eee"><b><span style="font-family:DejaVu Sans; sans-serif">₱</span> {{ number_format($grandTotal,2) }}</b></td>
          </tr>
      </tbody>
    </table>
  </body>
</html>
