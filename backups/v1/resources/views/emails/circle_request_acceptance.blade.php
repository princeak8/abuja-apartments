@component('mail::message')
# CIRCLE REQUEST ACCEPTED

{{$realtor->full_name}} has accepted your circle request

@component('mail::button', ['url' => config('app.url')."realtor/circle"])
VIEW YOUR CIRCLE
@endcomponent

ABUJA APARTMENTS
@endcomponent
