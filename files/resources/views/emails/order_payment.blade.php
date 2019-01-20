@component('mail::message')
# ORDER PAYMENT

Your payment for your order has been received.<br/>
Order invoice Number is {{$order->invoice_no}}<br/>
We shall get back to you shortly

@component('mail::button', ['url' => config('app.url')."customer_page"])
My Customer Page
@endcomponent

Thankyou for choosing 
GET ME BOOKS
@endcomponent
