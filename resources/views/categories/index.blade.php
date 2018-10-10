@extends('layouts.app')
@section('content')

<div class="container">
   

        <div class="row">
        <h3>Book Categories </h3>
        Page {{ $categories->currentPage() }} of {{$categories->lastPage() }}
        <ul class="list-group">
        
            @foreach ($categories as $category)
            <div class="col-md-7 col-md-offset-2"> 
                    <li class="list-group-item">
                    <a href="{{ route('books.show', $category->id ) }}" class="btn btn-link">
                    <!-- Showing Categories --><!-- Checking if the category has books, if it has, show how many  -->
                        <b>{{$category->category}}  
                        
                        
                        </b>
                    </a>  
                    <span class="badge">{{$category->hasBooks()->count()}}</span>
                                             
                        <!-- <span class="badge badge-primary">
                        <a href="{{-- route('categories.edit', $category->id) --}}" class="btn btn-info" role="button">Edit</a>
                        </span>  -->

                    </li></div>
                    
    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}

    @can('Edit Category')
    <div class="col-md-2"><li class="list-group-item">
    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Category')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    </li></div> 
    @endcan
    {!! Form::close() !!}
    
                    
            @endforeach
        </ul>
                    
              </div>      
        <div class="text-center">
            {!! $categories->links() !!}
        </div>
    <!-- </div> -->

<!-- </div>     -->
</div>
@endsection