@component('mail::message')
# NEW ORDER

You have received a new order.<br/>
Click on the link below to view order and treat accordingly

@component('mail::button', ['url' => config('app.url')."admin/order/{$order->id}"])
VIEW ORDER
@endcomponent
 
GET ME BOOKS
@endcomponent
