@extends('layouts.main-layout')
@section('title', 'Homepage')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="{{ asset('images/carousel/carousel1.jpg') }}" class="d-block w-100 h-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="{{ asset('images/carousel/carousel2.jpg') }}" class="d-block w-100 h-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/carousel/carousel3.jpg') }}" class="d-block w-100 h-100" alt="Slide 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/carousel/carousel4.jpg') }}" class="d-block w-100 h-100" alt="Slide 4">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/carousel/carousel5.jpg') }}" class="d-block w-100 h-100" alt="Slide 5">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/carousel/carousel6.jpg') }}" class="d-block w-100" alt="Slide 6">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6">
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
                                    <a href="{{ route('ideas.show', $post->slug) }}"
                                       class="btn btn-primary waves-effect waves-light">{{ __('Read More') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Top Categories') }}</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <a class="list-group-item list-group-item-action" href="javascript:void(0)">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop

