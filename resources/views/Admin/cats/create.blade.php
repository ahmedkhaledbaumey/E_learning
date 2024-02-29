@extends('admin.layout')
@section('content')  
<div class="d-flex justify-content-between mb-3"> 

    <h6>Categories \ Add New</h6>  
    <a class="btn btn-sm btn-primary" href="{{ route('admin.cats.index') }}">Back </a>
</div>  
@include('Admin.inc.errors')
<form action="{{ route('admin.cats.store') }}" method="POST" > 
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
  
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection