@component('mail::message')
# NEW CONTACT MESSAGE

<p>
	You have received a new contact message.
</p>

<p>
	<b>FROM: </b>{{$message->fullname}}
</p>
<p>
	<b>EMAIL: </b>{{$message->email}}
</p>
<p>
	<b>PHONE NUMBER: </b>{{$message->phone}}
</p>
<p>
	<b>TITLE: </b>{{$message->title}}
</p>
<p>
	<b>MESSAGE: </b>{{$message->message}}
</p>

@component('mail::button', ['url' => config('app.url')."admin/contact_message/{$message->id}"])
VIEW MESSAGE
@endcomponent
 
GET ME BOOKS
@endcomponent
