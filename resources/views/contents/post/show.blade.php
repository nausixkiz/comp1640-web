@extends('layouts.main-layout')
@section('title', $post->name)

@section('content')
    <div class="row mb-4">
        <div class="col-xl-12">

            <div class="card mb-0">
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <img class="rounded-circle avatar-lg" src="{{ $post->getFirstMediaUrl('thump') }}"
                                 alt="{{ $post->name }}">
                        </div>
                        <div class="flex-grow-1">
                            <h1 class="">{{ $post->name }} <span class="badge rounded-pill bg-info">{{ views($post)->unique()->count() }} views</span>
                            </h1>
                            <p class="text-muted">Written by {{ $post->user->name }}
                                at {{ $post->user->created_at }}</p>
                        </div>
                    </div>

                    {!! $post->contents !!}
                    <hr/>
                    @if($post->hasMedia('documents'))
                        <div class="row">
                            @foreach($post->getMedia('documents') as $document)
                                <div class="col-xl-2 col-6">
                                    <div class="card">
                                        @switch($document->mime_type)
                                            @case('text/plain')
                                            <img class="card-img-top img-fluid"
                                                 src="{{ asset('images/document-extensions/svg/file-lines.svg') }}"
                                                 alt="{{ $document->name }}">
                                            @break
                                            @case('application/vnd.openxmlformats-officedocument.presentationml.presentation')
                                            <img class="card-img-top img-fluid"
                                                 src="{{ asset('images/document-extensions/svg/file-pdf.svg') }}"
                                                 alt="{{ $document->name }}">
                                            @break
                                            @case('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                                            <img class="card-img-top img-fluid"
                                                 src="{{ asset('images/document-extensions/svg/file-excel.svg') }}"
                                                 alt="{{ $document->name }}">
                                            @break
                                            @case('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                            <img class="card-img-top img-fluid"
                                                 src="{{ asset('images/document-extensions/svg/file-word.svg') }}"
                                                 alt="{{ $document->name }}">
                                            @break
                                            @default
                                            {{ $document->img()->attributes(['class' => 'card-img-top img-fluid']) }}
                                            @break
                                        @endswitch


                                        <div class="py-2 text-center">
                                            <a href="{{ route('posts.download-a-document', [ $post->slug, $document]) }}"
                                               class="fw-medium">Download</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="d-flex mb-3">
                        <div class="p-2">
                            <a
                                class="btn btn-secondary waves-effect mt-4">
                                <i class="dripicons-thumbs-up"></i> Like
                            </a>
                            <a href="email-compose.html" class="btn btn-secondary waves-effect mt-4">
                                <i class="dripicons-thumbs-down"></i> Dislike
                            </a>
                        </div>
                        @if($post->hasMedia('documents'))
                            <div class="ms-auto p-2">
                                <a href="{{ route('posts.download-all-documents', $post->slug) }}"
                                   class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-download"></i> Download
                                    All
                                    Documents</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end card -->

        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-9">
            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h5><i class="dripicons-conversation"></i> Unread comments <span
                        class="badge bg-info">{{ $comment_total }}</h5>
            </div>
            @if($comments->count() == 0)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">No comments yet</h4>
                    </div>
                </div>
            @else
                @foreach($comments as $comment)
                    <div class="card p-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img
                                            src="@if($comment->isAnonymousComment()) {{ Avatar::create('Anonymous')->toBase64() }} @else {{ Avatar::create($comment->user->name)->toBase64() }} @endif"
                                            class="rounded-circle avatar-md mb-4 mb-lg-0 shadow-2"
                                            alt="@if($comment->isAnonymousComment()) Anonymous @else {{ $comment->user->name }} @endif"
                                            width="90"
                                            height="90">
                                    </div>
                                    <div class="flex-grow-1 ms-4 ps-3">
                                        <figure>
                                            <blockquote class="blockquote mb-4">
                                                <p>
                                                    <i class="fas fa-quote-left fa-lg text-warning me-2"></i>
                                                    <span class="font-italic">{{ $comment->contents }}</span>
                                                </p>
                                            </blockquote>
                                            <figcaption class="blockquote-footer">
                                                By @if($comment->isAnonymousComment())
                                                    Anonymous
                                                @else
                                                    {{ $comment->user->name }}
                                                @endif in <cite
                                                    title="Source Title">{{ $comment->created_at }}</cite>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center text-center">
                            <div class="d-inline-block ">
                                {!! $comments->links('contents.custom.pagination') !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div>
                        <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="post-slug" value="{{ $post->slug }}" hidden>
                            <div class="mb-3">
                                <textarea class="form-control @error('contents') is-invalid @enderror" name="contents"
                                          rows="3" placeholder="Leave an comment for this post..."></textarea>
                                @error('contents')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="d-flex btn-toolbar mb-3 mt-5">
                                    <div class="p-2">
                                        <input
                                            class="form-check-input @error('comment-as-anonymous') is-invalid @enderror"
                                            type="checkbox"
                                            id="comment-as-anonymous" name="comment-as-anonymous">
                                        <label class="form-check-label" for="comment-as-anonymous">
                                            Post this comment anonymously
                                        </label>
                                        @error('comment-as-anonymous')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="ms-auto p-2">
                                        <button class="btn btn-info waves-effect waves-light"><span>Send</span>
                                            <i class="fab fa-telegram-plane ms-2"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
