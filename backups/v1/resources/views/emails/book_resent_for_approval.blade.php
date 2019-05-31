@component('mail::message')
# BOOK RESENT FOR APPROVAL

{{$vendor->firstname.' '.$vendor->lastname}} has resent this book({{$book->title}}) for approval after making changes.<br/>
Approve or reject accordingly

@component('mail::button', ['url' => config('app.url')."admin/resent_books"])
RESENT BOOKS
@endcomponent

Thankyou for choosing 
GET ME BOOKS
@endcomponent
