@extends('layouts.main-layout')
@section('title', 'Homepage')

@section('content')
    @foreach($posts['data'] as $post)
        <div class="col-lg-6">
            <div class="card">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4">
                        <img class="card-img img-fluid" src="{{ $post['thump_image_url'] }}" alt="{{ $post['name'] }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post['name'] }}</h5>
                            <p class="card-text">{{ $post['short_description'] }}</p>
                            <p class="card-text"><small class="text-muted">Last updated
                                    in {{ $post['updated_at'] }}</small></p>
                            <a href="{{ route('posts.show', $post['slug']) }}"
                               class="btn btn-primary waves-effect waves-light">{{ __('Read More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop
