@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Add New Course</h6>  
            <a class="btn btn-sm btn-primary" href="{{ route('admin.courses.index') }}">Back</a>
        </div>  

        @include('admin.inc.errors')

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data"> 
            @csrf 
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="cat_id" class="form-label">Category</label>
                        <select name="cat_id" class="form-control" id="cat_id">
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="trainer_id" class="form-label">Trainer</label>
                        <select name="trainer_id" class="form-control" id="trainer_id">
                            @foreach ($trainers as $trainer)
                                <option value="{{ $trainer->id }}" {{ old('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                    {{ $trainer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="small_desc" class="form-label">Small Description</label>
                        <input type="text" name="small_desc" class="form-control" id="small_desc" value="{{ old('small_desc') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" id="desc" class="form-control" rows="5">{{ old('desc') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}">
                    </div>

                    <div class="mb-3">
                        <label for="img" class="form-label">Image</label>
                        <input type="file" name="img" class="form-control-file" id="img">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Course</button>
        </form>
    </div>
@endsection
