@extends('layouts.app')

@section('title', '| Edit Category')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Category</h1>
        <hr>
            {{ Form::model($category, array('route' => array('categories.update', $category->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('category', 'Category Name') }}
            {{ Form::text('category', null, array('class' => 'form-control')) }}
            <br>
            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection