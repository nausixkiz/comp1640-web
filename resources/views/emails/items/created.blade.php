@component('mail::message')

    New idea has been created!

    {{ $idea->user->name }} has created a new idea:
    {{ $idea->created_at }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
