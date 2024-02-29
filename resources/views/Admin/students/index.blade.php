@extends('admin.layout')
@section('content')  
<div class="d-flex justify-content-between mb-3"> 
    <h6>Students</h6>  
    <a class="btn btn-sm btn-primary" href="{{ route('admin.students.create') }}">Add New </a>
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
            <th scope="col">Email</th> 
            <th scope="col">Phone</th>
            <th scope="col">Specialization</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody> 
        @foreach ($students as $student )      
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img src="{{ asset('upload/students/' .$student->img ) }}" height="70px" alt=""></td>
                <td>{{ $student->name }}</td> 

                <td>
                   @if( $student->phone  !==null)
                    {{ $student->phone }} 
                   @else 
                   "Not Data Exist" 
                   @endif
                </td> 

                <td>{{ $student->spec }}</td>
                <td class="d-flex">
                    @include('Admin.inc.errors')

                    <form action="{{ route('admin.students.edit', ['id' => $student->id]) }}" method="POST" class="mr-1"> 
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-sm btn-info">Edit</button> 
                    </form>
                    
                    <form action="{{ route('admin.students.destroy', ['id' => $student->id]) }}" method="POST" class="mr-1"> 
                        @method('delete')
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button> 
                    </form>
                    
                    <form action="{{ route('admin.students.show', ['id' => $student->id]) }}" method="POST" class="mr-1"> 
                        @csrf 
                        @method('GET')
                        <button class="btn btn-sm btn-primary">Show</button> 
                    </form>
                    
                    <form action="{{ route('admin.students.showCourses', ['id' => $student->id]) }}" method="POST"> 
                        @csrf 
                        @method('GET')
                        <button class="btn btn-sm btn-primary">Show Courses</button> 
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection 
