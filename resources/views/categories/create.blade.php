@extends('layouts.app')

@section('title', '| Create New Category')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New Category</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'categories.store')) }}

        <div class="form-group">
            {{ Form::label('category', 'Category Name') }}
            {{ Form::text('category', null, array('class' => 'form-control')) }}
            <br>

            {{-- Form::label('body', 'Post Body') --}}
            {{-- Form::textarea('body', null, array('class' => 'form-control')) --}}
            <!-- <br> -->

            {{ Form::submit('Create Category', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection
<!--  -->