<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

if (!function_exists('employee_doc_path')) {
    /**
     * Fungsi ini digunakan untuk mendapatkan lokasi dokumen dari employee
     * @var dir adalah nama folder yang ingin diakses
     * @var default_create digunakan untuk membuat direktori jika belum ada
     */
    function employee_doc_path($dir, $default_create = true) {
        if ($default_create && !Storage::exists($dir)) {
            Storage::makeDirectory($dir);
        }

        return Storage::path($dir);
    }
}

if (!function_exists('get_month')) {
    function get_month($bln) {
        $bulan = null;

        if($bln == "01")
		{
			$bulan = "Januari";
		}else if($bln == "02")
		{
			$bulan = "Februari";
		}else if($bln == "03")
		{
			$bulan = "Maret";
		}else if($bln == "04")
		{
			$bulan = "April";
		}else if($bln == "05")
		{
			$bulan = "Mei";
		}else if($bln == "06")
		{
			$bulan = "Juni";
		}else if($bln == "07")
		{
			$bulan = "Juli";
		}else if($bln == "08")
		{
			$bulan = "Agustus";
		}else if($bln == "09")
		{
			$bulan = "September";
		}else if($bln == "10")
		{
			$bulan = "Oktober";
		}else if($bln == "11")
		{
			$bulan = "November";
		}else if($bln == "12")
		{
			$bulan = "Desember";
		}

        return $bulan;
    }
}

if (!function_exists('get_day')) {
    function get_day($day) {
        $hari = null;

        if($day == "Sunday")
		{
			$hari = "Minggu";
		}else if($day == "Monday")
		{
			$hari = "Senin";
		}else if($day == "Tuesday")
		{
			$hari = "Selasa";
		}else if($day == "Wednesday")
		{
			$hari = "Rabu";
		}else if($day == "Thursday")
		{
			$hari = "Kamis";
		}else if($day == "Friday")
		{
			$hari = "Jumat";
		}else if($day == "Saturday")
		{
			$hari = "Sabtu";
		}

        return $hari;
    }
}

if (!function_exists('genderPrefix')) {
    /**
     * Fungsi ini digunakan pada saat generate enail
     * Untuk menentukan panggilan berdasarkan jenis kelamin
     * @var jk adalah jenis kelamin
     */
    function genderPrefix($jk) {
        switch (strtolower($jk)) {
            case 'male':
            case 'laki-laki':
            case 'laki - laki':
            case 'pria':
                $gender = "Bapak";
                break;

            case 'female':
            case 'perempuan':
                $gender = 'Ibu';
                break;

            default:
                $gender = "Saudara/i";
                break;
        }
        return $gender;
    }
}

if (!function_exists('genderSubprefix')) {
    /**
     * Fungsi ini digunakan pada saat generate enail
     * Untuk menentukan panggilan berdasarkan jenis kelamin
     * @var jk adalah jenis kelamin
     */
    function genderSubprefix($jk) {
        switch (strtolower($jk)) {
            case 'male':
            case 'laki-laki':
            case 'laki - laki':
            case 'pria':
                $gender_sub = "Bpk";
                break;

            case 'female':
            case 'perempuan':
                $gender_sub = "Ibu";
                break;

            default:
                $gender_sub = "Saudara/i";
                break;
        }
        return $gender_sub;
    }
}

if (!function_exists('sendmail')) {
    function sendmail($data){
        Mail::to($data["emails"])->send(new \App\Mail\SendMail($data));
    }
}
