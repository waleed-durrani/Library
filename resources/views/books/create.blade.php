
@extends('layouts.app')

@section('title', '| Add New Book')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Add New Book</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'books.store')) }}

        <div class="form-group">
            
            {{ Form::label('categories', 'Select category') }}
            {!!Form::select('categories',$categories,null, ['class' => 'form-control'])!!}
            <br>
            
            
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
            
           <br>

            {{ Form::label('edition', 'Edition') }}
            {{ Form::text('edition', null, array('class' => 'form-control')) }}
            
           <br>
            {{ Form::label('author', 'Author') }}
            {{ Form::text('author', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('publisher', 'Publisher') }}
            {{ Form::text('publisher', null, array('class' => 'form-control')) }}
            <br>

            {{Form::radio('available',1,true)}}    
            {{Form::label('available','Available')}}
            <br>
            {{Form::radio('available',0)}}    
            {{Form::label('available','Not Available')}}
            <br>

            {{ Form::submit('Create Book', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection

<!--  -->