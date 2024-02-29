@extends('admin.layout')
@section('content')  
<div class="d-flex justify-content-between mb-3"> 

    <h6>Categories \ Add New {{ $cat->name }}</h6>  
    <a class="btn btn-sm btn-primary" href="{{ route('admin.cats.index') }}">Back </a>
</div>  
@include('Admin.inc.errors')
<form action="{{ route('admin.cats.update', ['id' => $cat->id]) }}" method="POST" > 
    @method('put') <!-- Assuming you're using 'put' method for updates -->
    @csrf 

    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $cat->name }}">
    </div>
  
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
@endsection
