@extends('admin.layout')
@section('content')  
<div class="d-flex justify-content-between mb-3"> 
    <h6>Add Course</h6>  
    <a class="btn btn-sm btn-primary" href="{{ route('admin.students.addCourse', $student_id) }}">Back</a>
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

<form action="{{ route('admin.students.storeCourse', $student_id) }}" method="POST" enctype="multipart/form-data"> 
    @csrf
   
    <div class="mb-3">
        <label for="course_id" class="form-label">Courses</label>
        <select name="course_id" class="form-control" id="course_id">
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" >
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Add Course</button>
</form>
@endsection
