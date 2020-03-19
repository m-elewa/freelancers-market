@component('mail::message')
# Bid Received

Your Job has Received a new bid from: **{{ $bid->user->name }}**

@component('mail::panel')
{!! $bid->description !!}
@endcomponent

@component('mail::button', ['url' => route('jobs.show', ['job' => $bid->job->id, 'title' => Str::slug($bid->job->title)])])
View Job
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent