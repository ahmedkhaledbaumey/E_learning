@extends('admin.layout')
@section('content')  
<div class="d-flex justify-content-between mb-3"> 
    <h6>Students \ Edit</h6>  
    <a class="btn btn-sm btn-primary" href="{{ route('admin.students.index') }}">Back</a>
</div>  
@include('admin.inc.errors')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data"> 
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Student Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $student->name }}" aria-describedby="nameHelp">
    </div>
    <div class="mb-3">
        <label for="spec" class="form-label">Specialization</label>
        <input type="text" name="spec" class="form-control" id="spec" value="{{ $student->spec }}" aria-describedby="specHelp">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" id="phone" value="{{ $student->phone }}" aria-describedby="phoneHelp">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ $student->email }}" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="cat_id" class="form-label">Specialization</label>
        <select name="cat_id" class="form-control" id="cat_id">
            @foreach ($cats as $cat)
                <option value="{{ $cat->id }}" {{ $cat->id == $student->cat_id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="trainer_id" class="form-label">Trainer</label>
        <select name="trainer_id" class="form-control" id="trainer_id">
            @foreach ($trainers as $trainer)
                <option value="{{ $trainer->id }}" {{ $trainer->id == $student->trainer_id ? 'selected' : '' }}>
                    {{ $trainer->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Profile Image</label>
        <input type="file" name="img" class="form-control-file" id="img">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
