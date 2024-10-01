@props(['step'])

@php
    // $list_item_navbar = ["Ringkasan", "Rincian Proyek", "Kelola Tim", "Kendali Anggaran", "Kelola Kegiatan", "Dokumen", "Penagihan"];

    if($step=="1"){
        $list_item_navbar = ["Ringkasan", "Kegiatan Pra Proyek", "Tenaga Ahli", "Pelaksana Pra Proyek", "RAB Internal"];
    } else {
        $list_item_navbar = ["Ringkasan", "Kelola Proyek", "Pelaksanaan Kegiatan", "Kendali Anggaran", "Dokumen", "Kalender Proyek"];
    }
@endphp

<x-app-content-wrapper judul="Detail Pra Proyek">
    <x-stepper-detail-project :step="$step"></x-stepper-detail-project>

    <!--begin::Navbar-->
    <x-header-detail-project :step="$step" :list_navbar="$list_item_navbar"></x-header-detail-project>
    <!--end::Navbar-->
    
    
    <!--begin::Row-->
    {{ $slot }}
    <!--end::Row-->
    
</x-app-content-wrapper>