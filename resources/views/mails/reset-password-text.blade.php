Dear {{ $user->first_name }},

We have received a request to reset your password. To reset your password, please copy and paste the following link in your browser:

{!! $resetUrl !!}

If you did not request to reset your password, please ignore this message.

Thank you,
{{env("APP_NAME")}}
