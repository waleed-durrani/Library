@extends('layouts.app')

@section('title', '| Edit Book')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Book</h1>
        <hr>
            {{ Form::model($book, array('route' => array('books.update', $book->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('categories', 'Select category') }}
<!-- first argument is name, then list of the names to show, then the id which is to be selected -->
            {!!Form::select('categories',$categories,$category_id, ['class' => 'form-control'])!!}
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

            {{Form::radio('available',1)}}    
            {{Form::label('available','Available')}}
            <br>
            {{Form::radio('available',0)}}    
            {{Form::label('available','Not Available')}}
            <br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection