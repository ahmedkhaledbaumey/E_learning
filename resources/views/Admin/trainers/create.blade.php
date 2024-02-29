@extends('admin.layout')
@section('content')  
    <div class="d-flex justify-content-between mb-3"> 
        <h6>Trainers / Add New</h6>  
        <a class="btn btn-sm btn-primary" href="{{ route('admin.trainers.index') }}">Back</a>
    </div>  

    @include('Admin.inc.errors')

    <form action="{{ route('admin.trainers.store') }}" method="POST" enctype="multipart/form-data" > 
        @csrf 
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phoneHelp">
        </div>

        <div class="mb-3">
            <label for="spec" class="form-label">Spec</label>
            <input type="text" name="spec" class="form-control" id="spec" aria-describedby="specHelp">
        </div>

        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input type="file" name="img" class="form-control-file" id="img" aria-describedby="imgHelp">
        </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
