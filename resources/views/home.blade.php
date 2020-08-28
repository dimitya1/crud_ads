@extends('layout')

@section('title', 'Home page')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('nothing to update'))
        <div class="alert alert-dark" role="alert">
            {{ Session::get('nothing to update') }}
        </div>
    @endif

    @error('not allowed')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror

    @error('ad not found')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror

    @forelse($ads as $ad)
    <div class="card" style="margin-bottom: 15px">
        <div class="card-body">
            <h4 class="card-title"> <a href="{{ route('readone', ['id' => $ad->id]) }}">{{ $ad->title }}</a> </h4>
            <p class="card-text">{{ \Illuminate\Support\Str::limit($ad->description, 30) }}</p>

            @can('update', $ad)
                <a href="{{ route('ad.create', ['id' => $ad->id]) }}" class="btn btn-warning">Edit</a>
            @endcan
            @can('delete', $ad)
                <a href="{{ route('ad.delete', ['id' => $ad->id]) }}" class="btn btn-danger">Delete</a>
            @endcan

        </div>
        <div class="card-footer text-muted">
            {{ $ad->created_at->diffForHumans() }} by {{ $ad->user->name }}
        </div>
    </div>
    @empty
        <p>No ads</p>
    @endforelse

    {{ $ads->links() }}
@endsection
