@component('mail::message')
Bonjour {{$receiver}},<br>
Nous sommes ravis de vous savoir parmi les nôtres. Par la présente,
nous accusons réception de votre message envoyé sur notre plateforme {{ config('app.url') }}. <br>
Subject : <strong>{{$object}}</strong><br>
Message : {{$message}}<br>

Nous vous revenons tres bientôt pour échanger au sujet de votre préoccupation.<br>
Si c'est urgent, contacter le +237 6 91 51 60 82 / + 237 6 70 37 12 36

Thanks,<br>
{{ config('app.name') }}
@endcomponent
