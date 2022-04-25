@component('mail::message')

    New idea has been created!

    @component('mail::button', ['url' => route('ideas.show', $idea->slug)])
        View Idea
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
