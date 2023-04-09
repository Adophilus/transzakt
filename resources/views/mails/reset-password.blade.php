<p>Dear {{ $user->first_name }},</p>

<p>We have received a request to reset your password. To reset your password, please click on the button below:</p>

<p>
  <a href="{{$resetUrl}}" target="_blank" style="display: inline-block; background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none;">Reset Password</a>
</p>

<p>If you did not request to reset your password, please ignore this message.</p>

<p>Thank you,</p>
<p>{{ env("APP_NAME") }}</p>
