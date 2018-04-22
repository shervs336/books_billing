@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sale
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::model($user, ['route' => ['settings.update', 1], 'method' => 'put']) !!}

                    <!-- Author Name Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('firstname', 'First Name:') !!}
                        {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('middlename', 'Middle Name:') !!}
                        {!! Form::text('middlename', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('lastname', 'Last Name:') !!}
                        {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('username', 'Username:') !!}
                        {!! Form::text('username', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('username', 'Confirm Password:') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('books.index') !!}" class="btn btn-default">Cancel</a>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
