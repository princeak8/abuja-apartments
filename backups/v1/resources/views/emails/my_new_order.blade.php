@component('mail::message')
# MY ORDER

Your order has been received.<br/>
Order invoice Number is {{$order->invoice_no}}

@component('mail::button', ['url' => config('app.url')."customer_page"])
My Customer Page
@endcomponent

Thankyou for choosing 
GET ME BOOKS
@endcomponent
