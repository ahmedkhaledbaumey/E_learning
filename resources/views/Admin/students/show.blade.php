@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Student Details: {{ $student->name }}</h6>
        <a class="btn btn-sm btn-primary" href="{{ route('admin.students.index') }}">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <img src="{{ asset('upload/students/' . $student->img) }}" alt="{{ $student->name }}" class="img-fluid mb-3">

            <dl class="row">
                <dt class="col-sm-3">Name:</dt>
                <dd class="col-sm-9">{{ $student->name }}</dd>

                <dt class="col-sm-3">Phone:</dt>
                <dd class="col-sm-9">{{ optional($student->phone)->phone ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Trainer:</dt>
                <dd class="col-sm-9">{{ optional($student->trainer)->name ?? 'N/A' }}</dd> 

                <dt class="col-sm-3">Specialization:</dt>
                <dd class="col-sm-9">{{ optional($student->cat)->name ?? 'N/A' }}</dd>
            </dl>
        </div>
    </div>
@endsection
