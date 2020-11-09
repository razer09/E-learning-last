@extends('layouts.app')

@section('content')

@include('parts.header')


<div class="container">
    <h1>Tags {{ $tag->id }}</h1>

    <div class="row mt-3">
            <div class="col-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{ $tag->name }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $tag->label }}</h5>
                    </div>
                     <a href="{{ route('tags.edit', $tag) }}" class="btn btn-primary btn-sm">Edit</a>
                     <form method="POST" action="/tags/{{ $tag->id }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary">
                            Delete
                        </button>
                     </form>

                </div>
            </div>
    </div>
    <div class="row">
        <a href="{{ route('tags.create') }}" class="btn btn-success btn-lg">create new</a>
    </div>

</div>
@endsection
