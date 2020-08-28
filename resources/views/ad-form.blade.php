@extends('layout')

@section('title', 'Manage ad')

@section('content')
    <form action="{{ route('ad.create', ['id' => $ad->id ?? null]) }}" method="post">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            @error('title')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <input type="text" name = "title" class="form-control" id="title" aria-describedby="titleHelp"
            value="{{ old('title', $ad->title ?? '') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            @error('description')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <textarea class="form-control" name = "description" id="description" rows="3">{{ old('description', $ad->description ?? '') }}</textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="{{ $button }}" />
    </form>
@endsection
