@component('mail::message')
# NEW ORDER PAYMENT

You have received a new order payment.<br/>
Click on the link below to view order and treat accordingly

@component('mail::button', ['url' => config('app.url')."admin/order/{$order->id}"])
VIEW ORDER
@endcomponent
 
GET ME BOOKS
@endcomponent
