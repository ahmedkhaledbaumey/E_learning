@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <h6>Student / Courses Show</h6>
            <div>
                <a class="btn btn-sm btn-primary" href="{{ route('admin.students.index') }}">Back</a>
                <a class="btn btn-sm btn-info" href="{{ route('admin.students.addCourse', $student_id) }}">Add to Course</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Trainer</th>
                        <th>Specialization</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->pivot->status }}</td>
                            <td>{{ optional($course->trainer)->name ?? 'N/A' }}</td>
                            <td>{{ optional($course->cat)->name ?? 'N/A' }}</td>
                            <td>
                                @if ($course->pivot->status === 'pending' || $course->pivot->status === 'reject')
                                    <form
                                        action="{{ route('admin.students.approve', ['id' => $student_id, 'c_id' => $course->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                @endif

                                @if ($course->pivot->status === 'approve')
                                    <form
                                        action="{{ route('admin.students.reject', ['id' => $student_id, 'c_id' => $course->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.students.removeCourse', $course['id']) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-warning">Remove Course</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
