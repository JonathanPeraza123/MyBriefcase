@component('mail::message')
# Nuevo Mensaje

Una persona te quiere contactar...

@component('mail::panel')
Nombre: {{$body['name']}} <br>
Email: {{$body['email']}} <br>
Mensaje: {{$body['body']}} <br>
@endcomponent

@component('mail::button', ['url' => route('home')])
Ir al inicio
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
