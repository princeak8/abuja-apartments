@component('mail::message')
# NEW CIRCLE REQUEST

<p>
    {{$user->firstname.' '.$user->lastname }}. Just sent You a Circle Request. 
</p>
<p>
    Please @component('mail::button', ['url' => config('app.url')."login"]) Log in @endcomponent and respond to the request by accepting or declining
</p>

<p>
    Realtors in your circle can share their houses with you and vice versa 
</p>

<p>
    For More on the wonderful features available in Abuja Apartments. 
    Click @component('mail::button', ['url' => config('app.url')."help"]) HERE @endcomponent
</p>

Thanks for choosing
ABUJA APARTMENTS<br/>
<i>Lets Find that House Together</i>
@endcomponent
