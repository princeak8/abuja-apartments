@component('mail::message')
# SUCCESSFULL REGISTERATION

You have succesfully registered as a vendor in GETMEBOOKS<br/>
We are very happy to have you. 

@component('mail::button', ['url' => config('app.url')."vendor/login"])
Login in
@endcomponent

Thanks for choosing
GET ME BOOKS
@endcomponent
