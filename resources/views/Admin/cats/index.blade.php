@extends('Admin.layout') 
@section('content')  
<div class="d-flex justify-content-between mb-3"> 
    <h6>Categories</h6>  
    <a class="btn btn-sm btn-primary" href="{{ route('admin.cats.create') }}">Add New </a>
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
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody> 
        @foreach ($cats as $cat )      
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $cat->name }}</td>
                <td>  
                    @include('Admin.inc.errors')

                    <form action="{{ route('admin.cats.edit', ['id' => $cat->id]) }}" method="POST"> 
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-sm btn-info">Edit</button> 
                    </form>
                </td> 
                <td>
                    <form action="{{ route('admin.cats.destroy', ['id' => $cat->id]) }}" method="POST"> 
                        @method('delete')
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button> 
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection 
