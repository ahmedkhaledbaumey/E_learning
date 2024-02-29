@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Course Details: {{ $course->name }}</h6>
            <a class="btn btn-sm btn-primary" href="{{ route('admin.courses.index') }}">Back</a>
        </div>

        <div class="card">
            <div class="card-body">
                <img src="{{ asset('upload/courses/' . $course->img) }}" alt="{{ $course->name }}" class="img-fluid mb-3">

                <dl class="row">
                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9">{{ $course->name }}</dd>

                    <dt class="col-sm-3">Specialization:</dt>
                    <dd class="col-sm-9">{{ $course->spec }}</dd>

                    <dt class="col-sm-3">Category:</dt>
                    <dd class="col-sm-9">{{ $course->cat->name }}</dd>

                    <dt class="col-sm-3">Trainer:</dt>
                    <dd class="col-sm-9">{{ $course->trainer->name }}</dd>

                    <dt class="col-sm-3">Small Description:</dt>
                    <dd class="col-sm-9">{{ $course->small_desc }}</dd>

                    <dt class="col-sm-3">Description:</dt>
                    <dd class="col-sm-9">{{ $course->desc }}</dd>

                    <dt class="col-sm-3">Price:</dt>
                    <dd class="col-sm-9">${{ $course->price }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
