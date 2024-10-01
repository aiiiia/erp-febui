@component('mail::message')
# Anda meminta untuk reset password

Untuk mengubah password, silahkan klik pada tautan berikut
<br>
<a href="{{ $url }}">{{ $url }}</a>
<br>
Atau klik tombol di bawah ini.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

**Segera login ke aplikasi dan amankan akun Anda, jika Anda tidak pernah membuat permintaan ini.**

#Salamsehatselalu

Regards,<br>
**Lembaga Manajemen Fakultas Ekonomi dan Bisnis Universitas Indonesia**
@endcomponent
