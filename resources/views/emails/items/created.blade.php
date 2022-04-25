@component('mail::message')

    New idea has been created!

    {{ $user->name }} has created a new idea:
    {{ $idea->created_at }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
