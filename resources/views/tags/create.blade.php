@extends('layouts.app')

@section('content')

@include('parts.header')


<div class="container">
    <h1>Create Tag</h1>
    <form method="POST" action="/tags">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">
                Tag name
            </label>
            <input  name="name"
                    type="text"
                    class="form-control"
                    value="{{ old('name') }}"
            >
            @error ('name')
                <small class="text-danger">{{ $errors->first('name') }}</small>
            @enderror

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">
                Label
            </label>
            <input  name="label"
                    type="text"
                    class="form-control"
                    value="{{ old('label') }}"
            >
            @error ('label')
                <small class="text-danger">{{ $errors->first('label') }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
