@extends('Admin.layout')

@section('content')   

{{-- <div class="d-flex justify-content-between mb-3"> 
    <h6 class="display-3">Trainers</h6>
    <a class="btn btn-sm btn-primary" href="{{ route('admin.trainers.create') }}">Add New Trainer</a>
</div>  --}}

<div class="d-flex justify-content-between mb-3 align-items-center bg-light p-3 rounded">
    <h6 class="display-3 mb-0">Trainers</h6>
    <a class="btn btn-sm btn-primary" href="{{ route('admin.trainers.create') }}">Add New Trainer</a>
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
            <th scope="col">Phone</th>
            <th scope="col">Spec</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            <th scope="col">Show</th>
        </tr>
    </thead>
    <tbody> 
        @foreach ($trainers as $trainer )      
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img src="{{ asset('upload/trainers/' .$trainer->img ) }}" height="100px" alt=""></td>
                <td>{{ $trainer->name }}</td>
                <td>
                   @if($trainer->phone)
                       {{ $trainer->phone }}
                   @else
                       "No Data Exist"
                   @endif
                </td> 
                <td>{{ $trainer->spec }}</td>
                <td>  
                    @include('Admin.inc.errors')

                    <form action="{{ route('admin.trainers.edit', ['id' => $trainer->id]) }}" method="GET"> 
                        @csrf
                        <button type="submit" class="btn btn-sm btn-info">Edit</button> 
                    </form>
                </td> 
                <td>
                    <form action="{{ route('admin.trainers.destroy', ['id' => $trainer->id]) }}" method="POST"> 
                        @method('delete')
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button> 
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.trainers.show', ['id' => $trainer->id]) }}" method="GET"> 
                        @csrf 
                        <button class="btn btn-sm btn-primary">Show</button> 
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
