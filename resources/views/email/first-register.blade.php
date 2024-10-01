@component('mail::message')
Dear {{ $nama }},

<p style="text-align: justify; text-justify: inter-word;">
	Dengan ini diinformasikan sudah bisa masuk ke aplikasi ERP LM FEB UI pada:
</p>
@component('mail::table')
| <!-- -->          | <!-- -->                   	                      				   |
| ----------------- | ---------------------------------------------------------------------|
| Link Pengisian    |: [Klik di sini]({{ $url }})	   					  				   |
| **Username**      |: {{ $username }}           	   					  				   |
| **Password**      |: {{ $password }} (atau mengikuti password terakhir) 				   |
| 			        |  Jika belum merubah password, dimohon untuk  merubah password default|
@endcomponent

<p style="text-align: justify; text-justify: inter-word;">
	Apabila mengalami kesulitan dan/atau terdapat kesalahan data, mohon dapat menghubungi helpdesk LM FEB UI melalui email ... atau menghubungi Unit ...
	<br>
	<br>
	Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.
</p>

#Salamsehatselalu

Regards,<br>
**Lembaga Manajemen Fakultas Ekonomi dan Bisnis Universitas Indonesia**
@endcomponent
