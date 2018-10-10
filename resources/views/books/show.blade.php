@extends('layouts.app')
@section('title', '| View Books')
@section('content')
<div class="container">


<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
              
        <strong>@if($books->first())
                Category: {{$books->first()->category->category}}
                @endif  </strong></a>
      </h2>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">
      
      <input class="form-control" id="myInput" type="text" placeholder="Search..">
      <br>
      
      <table class="table table-bordered">
      <thead>

        <tr>
          
          <th>Book Name</th>
          <th>Book Edition</th>
          <th>Book Author</th>
          <th>Book Publisher</th>
          <th>Status</th>
          <th>Operation</th>
        </tr>
      </thead>
      <tbody id="myTable">
      @foreach ($books as $book) 
            
        {{-- $book->category->category --}}
        <tr>
          <td>{{$book->name}} </td>
          <td>{{$book->edition}} </td>
          <td>{{$book->author}} </td>
          <td>{{$book->publisher}} </td>
          <td>{{$book->available}} </td>
<td>{!! Form::open(['method' => 'DELETE', 'route' => ['books.destroy', $book->id] ]) !!}
    
    @can('Edit Book')
    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Book')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
  </div>
    </div>
  </div>
   
  </div>
  <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
</div> 
@endsection

