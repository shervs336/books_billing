<!-- Author Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('author_name', 'Author Name:') !!}
    {!! Form::text('author_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Published By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('published_by', 'Published By:') !!}
    {!! Form::text('published_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Published Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('published_date', 'Published Date:') !!}
    {!! Form::text('published_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Stocks Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stocks', 'Stocks:') !!}
    {!! Form::text('stocks', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('books.index') !!}" class="btn btn-default">Cancel</a>
</div>
