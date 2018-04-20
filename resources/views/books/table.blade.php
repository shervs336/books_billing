<table class="table table-responsive" id="books-table">
    <thead>
        <tr>
            <th>Author Name</th>
            <th>Title</th>
            <th>Published By</th>
            <th>Published Date</th>
            <th>Stocks</th>
            <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{!! $book->author_name !!}</td>
            <td>{!! $book->title !!}</td>
            <td>{!! $book->published_by !!}</td>
            <td>{!! $book->published_date !!}</td>
            <td>{!! $book->stocks !!}</td>
            <td>{!! $book->price !!}</td>
            <td>
                {!! Form::open(['route' => ['books.destroy', $book->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('books.show', [$book->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('books.edit', [$book->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $books->render() }}
