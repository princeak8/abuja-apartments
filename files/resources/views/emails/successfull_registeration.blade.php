@component('mail::message')
# SUCCESSFULL REGISTERATION

<p>
    CONGRATULATIONS!! {{$user->firstname.' '.$user->lastname }}. You are now a potential Realtor on Abuja Apartments<br/>
    We are very happy to have you. 
</p>
<p>
    You can now like your favorite houses and follow active realtors whose portfolios you like
</p>

<p>
    If you are a house agent or want to become an active Realtor(Create your own house portfolio to advertise) on Abuja Apartments, 
    Activate your account by clicking on the link below your name on the top right hand corner of the page as shown in the image below 
</p>

<p>
    For More on the wonderful features available in Abuja Apartments. 
    Click @component('mail::button', ['url' => config('app.url')."help"]) HERE @endcomponent
</p>

Thanks for choosing
ABUJA APARTMENTS<br/>
<i>Lets Find that House Together</i>
@endcomponent
