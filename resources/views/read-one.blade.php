@extends('layout')

@section('title', 'Read ad')

@section('content')

    <div class="card" style="margin-bottom: 15px">
        <div class="card-body">
            <h3 class="card-title">{{ $ad->title }}</h3>
            <h5 class="card-text">{{ $ad->description }}</h5>

            @can('update', $ad)
                <a href="{{ route('ad.create', ['id' => $ad->id]) }}" class="btn btn-warning">Edit</a>
            @endcan
            @can('delete', $ad)
                <a href="{{ route('ad.delete', ['id' => $ad->id]) }}" class="btn btn-danger">Delete</a>
            @endcan
        </div>
        <div class="card-footer text-muted">
            Created {{ $ad->created_at->diffForHumans() }} by {{ $ad->user->name }}
            <br>
            @if(!$ad->created_at->eq($ad->updated_at))
                Last update: {{ $ad->updated_at->diffForHumans() }}
            @endif
        </div>
    </div>
@endsection
