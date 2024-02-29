@extends('admin.layout')
@section('content')  
    <div class="d-flex justify-content-between mb-3"> 
        <h6>Trainers / Update {{ $trainer->name }}</h6>  
        <a class="btn btn-sm btn-primary" href="{{ route('admin.trainers.index') }}">Back</a>
    </div>  

    @include('Admin.inc.errors')

    <form action="{{ route('admin.trainers.update', ['id' => $trainer->id]) }}" method="POST" enctype="multipart/form-data"> 
        @csrf 
        @method('put')

        <!-- Display the old image -->
        <div class="mb-3">
            <label for="oldImage" class="form-label">Old Image</label>
            <div>
                <img src="{{ asset('/upload/trainers/' . $trainer->img) }}" height="100px" alt="Old Image">
            </div>
        </div>

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $trainer->name }}">
        </div>

        <!-- Phone Field -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ $trainer->phone }}">
        </div>

        <!-- Spec Field -->
        <div class="mb-3">
            <label for="spec" class="form-label">Spec</label>
            <input type="text" name="spec" class="form-control" id="spec" value="{{ $trainer->spec }}">
        </div>

        <!-- New Image Field -->
        <div class="mb-3">
            <label for="img" class="form-label">New Image</label>
            <input type="file" name="img" class="form-control-file" id="img">
        </div>

        <!-- Update Button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
