@extends('layouts.app')

@section('content')

@include('parts.header')


<div class="container">
    <h1>Tags</h1>

    <div class="row mt-3">
        @foreach ($tags as $tag)
            <div class="col-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <a href="{{ route('tags.show', $tag) }}">
                        <div class="card-header">{{ $tag->name }}</div>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $tag->label }}</h5>
                    </div>
                     <a href="{{ route('tags.edit', $tag) }}" class="btn btn-primary btn-sm">Edit</a>
                     <a href="{{ route('tags.destroy', $tag) }}" class="btn btn-danger btn-sm">delete</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <a href="{{ route('tags.create') }}" class="btn btn-success btn-lg">create new</a>
    </div>

</div>
@endsection
