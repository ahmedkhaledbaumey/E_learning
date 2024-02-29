@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Trainer Details: {{ $trainer->name }}</h6>
        <a class="btn btn-sm btn-primary" href="{{ route('admin.trainers.index') }}">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <img src="{{ asset('upload/trainers/' . $trainer->img) }}" alt="{{ $trainer->name }}" class="img-fluid mb-3">

            <dl class="row">
                <dt class="col-sm-3">Name:</dt>
                <dd class="col-sm-9">{{ $trainer->name }}</dd>

                <dt class="col-sm-3">Phone:</dt>
                <dd class="col-sm-9">{{ $trainer->phone ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Specialization:</dt>
                <dd class="col-sm-9">{{ $trainer->spec }}</dd> 
            </dl>
        </div>
    </div>
@endsection
