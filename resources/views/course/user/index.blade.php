@extends('layouts.app')

@section('content')

@include('parts.header')


<div class="container">
    <h1>Courses</h1>
    <div class="row mt-3">
        @foreach ($courses as $course)
            <div class="col-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <a href="{{-- {{ route('tags.show', $course) }} --}}">
                        <div class="card-header">{{ $course->title }}</div>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->description }}</h5>
                    </div>
                     <form method="POST" action="/users/{{$course->pivot->user_id}}/courses/{{ $course->id }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                     </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <a href="{{ route('users.courses.create', $user_id) }}" class="btn btn-success btn-lg">create new</a>
    </div>

</div>
@endsection
