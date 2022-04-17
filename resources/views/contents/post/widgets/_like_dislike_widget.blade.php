<div class="row col-2">
    <div class="col-sm">
        @can('like', $post)
            <form action="{{ route('ideas.like', $post->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <button class="btn btn-secondary btn-sm waves-effect">
                    <i class="dripicons-thumbs-up"></i> Like ({{ $post->likes->count() }})
                </button>
            </form>
        @endcan
        @can('remove-like', $post)
            <form action="{{ route('ideas.remove-like', $post->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-primary btn-sm waves-effect active">
                    <i class="dripicons-thumbs-up"></i> Like ({{ $post->likes->count() }})
                </button>
            </form>
        @endcan
    </div>
    <div class="col-sm">
        @can('dislike', $post)
            <form action="{{ route('ideas.dislike', $post->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <button class="btn btn-secondary btn-sm waves-effect">
                    <i class="dripicons-thumbs-down"></i> Dislike ({{ $post->dislikes->count() }})
                </button>
            </form>
        @endcan
        @can('remove-dislike', $post)
            <form action="{{ route('ideas.remove-dislike', $post->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm waves-effect active">
                    <i class="dripicons-thumbs-down"></i> Dislike ({{ $post->dislikes->count() }})
                </button>
            </form>
        @endcan
    </div>
</div>
