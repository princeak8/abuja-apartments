@component('mail::message')
# CIRCLE REQUEST

You have a new Circle Request by {{$realtor->full_name}}) for your approval.<br/>
Please Approve or Decline this request

@component('mail::button', ['url' => config('app.url')."realtor/circle_request/{$circle->id}"])
View Request
@endcomponent

ABUJA APARTMENTS
@endcomponent
