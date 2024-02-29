@extends('Admin.layout') 
@section('content')  
<div class="d-flex justify-content-between mb-3"> 
    <h6>courses</h6>  
    <a class="btn btn-sm btn-primary" href="{{ route('admin.courses.create') }}">Add New </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">price</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody> 
        @foreach ($courses as $course )      
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img src="{{ asset('upload/courses/' .$course->img ) }}" height="70px" alt=""></td>
                <td>{{ $course->name }}</td>
                <td>
                   @if( $course->phone  !==null)
                   
                    {{ $course->phone }} 
                    
                   @else 
                   "Not Data Exist" 
                   @endif
                </td> 

                <td>  
                    @include('Admin.inc.errors') 
                    <div>

                    <form action="{{ route('admin.courses.edit', ['id' => $course->id]) }}" method="POST" class="d-inline-block"> 
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-sm btn-info">Edit</button> 
                    </form>
                    <form action="{{ route('admin.courses.destroy', ['id' => $course->id]) }}" method="POST" class="d-inline-block"> 
                        @method('delete')
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button> 
                    </form>
                
                    <form action="{{ route('admin.courses.show', ['id' => $course->id]) }}" method="POST" class="d-inline-block"> 
                        @csrf 
                        @method('GET')

                        <button class="btn btn-sm btn-primary">show</button> 
                    </form> 
                </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection 
