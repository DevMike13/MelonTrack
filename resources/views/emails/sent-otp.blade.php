@component('mail::message')
# OTP Verification

Your One-Time Password (OTP) is:

## **{{ $otp }}**

Please use this code to verify your account.  
This code will expire in 10 minutes.

Thanks,  
{{ config('app.name') }}
@endcomponent
