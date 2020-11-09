@extends('layouts.app')

@section('content')

@include('parts.header')


<div class="container">
    <h1>Enroll Course</h1>
    <form method="POST" action="/users/{{$user_id}}/courses">
        @csrf

        <div class="col-3">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">

                 <select class="custom-select"
                         id="inputGroupSelect01"
                         name="course">
                    <option selected>Choose...</option>
                    @foreach ($courses as $title => $id)
                        <option value="{{ $id }}">{{ $title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
