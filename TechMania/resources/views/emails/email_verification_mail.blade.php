@component('mail::message')

# <span style="color:Tomato">Hello {{$user->first_name}},</span>
***
@component('mail::button', ['url' => route('verify_email',$user->email_verification_code)])
click here to verify your email address
@endcomponent

<span style="color:Black">Or, copy paste the following link on your web browser to verify your email address.</span>

<p><a href="{{route('verify_email',$user->email_verification_code)}}">{{route('verify_email',$user->email_verification_code)}}</a></p><br>

***
<span style="color:Tomato">Thanks,<br>
{{ config('app.name') }}
@endcomponent
</span>