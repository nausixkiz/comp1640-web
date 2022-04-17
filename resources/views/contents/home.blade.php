@extends('layouts.main-layout')
@section('title', 'Homepage')

@section('content')
    @foreach($posts as $post)
        <div class="col-lg-6">
            <div class="card" style="height: 250px;">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4">
                        <img class="card-img img-fluid img-thumbnail" src="{{ $post->getFirstMediaUrl('thumbnail') }}"
                             alt="{{ $post->name }}" style="width: 250px; height: 175px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->name  }}</h5>
                            <p class="card-text">{{ $post->short_description }}</p>
                            <p class="card-text"><small class="text-muted">Last updated
                                    in {{ $post->updated_at }}</small></p>
                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="btn btn-primary waves-effect waves-light">{{ __('Read More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop

