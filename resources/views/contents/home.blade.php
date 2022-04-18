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
    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-12 ">
                <div class="btn-toolbar justify-content-end align-content-end" role="toolbar">
                    <div class="form-group me-2 mb-3">
                        <h4 class="align-content-center text-center mr-3 pt-2">Sort By: </h4>
                    </div>
                    <div class="btn-group me-2 mb-3">
                        <form method="POST" action="{{ route('home.sorted') }}">
                            @csrf
                            <input type="hidden" name="sort" value="most-view">
                            <input type="hidden" name="order" value="asc">
                            <button type="submit" class="btn btn-primary waves-light waves-effect @if($sorted['most-view']) active @endif">
                                <em class="ri ri-eye-fill" style="vertical-align: middle;"></em> Most Viewed
                            </button>
                        </form>
                    </div>
                    <div class="btn-group me-2 mb-3">
                        <form method="POST" action="{{ route('home.sorted') }}">
                            @csrf
                            <input type="hidden" name="sort" value="most-comment">
                            <input type="hidden" name="order" value="asc">
                            <button type="submit" class="btn btn-primary waves-light waves-effect @if($sorted['most-comment']) active @endif">
                                <em class="ri ri-chat-4-fill" style="vertical-align: middle;"></em> Most Comment
                            </button>
                        </form>
                    </div>
                    <div class="btn-group me-2 mb-3">
                        <form method="POST" action="{{ route('home.sorted') }}">
                            @csrf
                            <input type="hidden" name="sort" value="most-like">
                            <input type="hidden" name="order" value="asc">

                            <button type="submit" class="btn btn-primary waves-light waves-effect @if($sorted['most-like']) active @endif">
                                <em class="ri ri-thumb-up-fill" style="vertical-align: middle;"></em> Most Like
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 mb-5">
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

{{--                {!! $posts->appends(Request::except('page'))->render() !!}--}}
                {!! $posts->links('contents.custom.pagination') !!}
        </div>
    </div>
    <div class="col-lg-3 pt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Top Categories') }}</h4>
            </div>
            <div class="card-body">
                @if($departments->count() == 0)
                    <p>{{ __('No categories found.') }}</p>
                @endif

                <div id="accordion">
                    @foreach($departments as $department)
                        @if($department->category->count() > 0)
                            <div class="card mb-0">
                                <div class="card-header" id="heading-{{$department->slug}}">
                                    <h5 class="m-0 font-size-14">
                                        <a data-bs-toggle="collapse" data-parent="#accordion" href="#collapse-{{$department->slug}}" aria-expanded="true" aria-controls="collapse-{{$department->slug}}" class="text-dark">
                                            {{ $department->name }}
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse-{{$department->slug}}" class="collapse" aria-labelledby="heading-{{$department->slug}}" data-parent="#accordion">
                                    <div class="card-body">
{{--                                        <ul class="list-group">--}}
                                            @foreach($department->category as $category)
                                                <li class="list-group-item">
                                                    <a href="javascript:void(0)">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
{{--                                        </ul>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

