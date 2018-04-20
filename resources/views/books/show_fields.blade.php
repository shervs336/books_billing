<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $book->id !!}</p>
</div>

<!-- Author Name Field -->
<div class="form-group">
    {!! Form::label('author_name', 'Author Name:') !!}
    <p>{!! $book->author_name !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $book->title !!}</p>
</div>

<!-- Published By Field -->
<div class="form-group">
    {!! Form::label('published_by', 'Published By:') !!}
    <p>{!! $book->published_by !!}</p>
</div>

<!-- Published Date Field -->
<div class="form-group">
    {!! Form::label('published_date', 'Published Date:') !!}
    <p>{!! $book->published_date !!}</p>
</div>

<!-- Stocks Field -->
<div class="form-group">
    {!! Form::label('stocks', 'Stocks:') !!}
    <p>{!! $book->stocks !!}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $book->price !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $book->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $book->updated_at !!}</p>
</div>

