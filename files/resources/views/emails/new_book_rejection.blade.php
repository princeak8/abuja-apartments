@component('mail::message')
# BOOK DECLINED

Admin has declined approving the book({{$book->title}}) you added.<br/>
You can look at the reason for the rejection and make necessary changes

@component('mail::button', ['url' => config('app.url')."vendor/declined_books"])
DECLINED BOOKS
@endcomponent

Thankyou for choosing 
GET ME BOOKS
@endcomponent
