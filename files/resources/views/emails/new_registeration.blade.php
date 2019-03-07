@component('mail::message')
# NEW VENDOR REGISTERATION

You have a new Vendor registeration.<br/>
Verify the Vendor Immediately

@component('mail::button', ['url' => config('app.url')."admin/view_vendor/{$vendor->id}"])
VERIFY
@endcomponent

GET ME BOOKS
@endcomponent
