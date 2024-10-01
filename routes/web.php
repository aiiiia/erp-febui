<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MasterData\BankController;
use App\Http\Controllers\MasterData\Honor\HonorAsesmenController;
use App\Http\Controllers\MasterData\Honor\HonorInternalontroller;
use App\Http\Controllers\MasterData\Honor\HonorRisetController;
use App\Http\Controllers\MasterData\Honor\HonorTrainingController;
use App\Http\Controllers\MasterData\Industri\IndustriController;
use App\Http\Controllers\MasterData\Industri\IndustriSektorController;
use App\Http\Controllers\MasterData\Klien\ClientController;
use App\Http\Controllers\MasterData\Klien\ClientJenisController;
use App\Http\Controllers\MasterData\Klien\ClientLokasiController;
use App\Http\Controllers\MasterData\Klien\ClientSumberDanaController;
use App\Http\Controllers\MasterData\Pekerjaan\PekerjaanController;
use App\Http\Controllers\MasterData\Pekerjaan\PekerjaanKelompokController;
use App\Http\Controllers\MasterData\Pelatihan\PelatihanController;
use App\Http\Controllers\MasterData\Pelatihan\PelatihanKelompokController;
use App\Http\Controllers\MasterData\KategoriProyekController;
use App\Http\Controllers\MasterData\PegawaiController;
use App\Http\Controllers\MasterData\PositionController;
use App\Http\Controllers\MasterData\PositionLevelController;
use App\Http\Controllers\MasterData\PositionTypeController;
use App\Http\Controllers\MasterData\UnitController;
use App\Http\Controllers\MasterData\UserController;
use App\Http\Controllers\Bapl\BaplController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('base');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => '/masterData'], function () {
        Route::group(['prefix' => '/client'], function () {
            Route::get('/dataTableClient', [ClientController::class, 'dataTableClient'])->name('masterDataClient.dataTableClient');
            Route::get('/masterDataClient/export', [ClientController::class, 'export'])->name('masterDataClient.export');
            Route::get('/masterDataClientTemplateImport', [ClientController::class, 'template_import'])->name('masterDataClient.templateImport');
            Route::post('/importClient', [ClientController::class, 'import_client'])->name('masterDataClient.importClient');
            Route::resource('/masterDataClient', ClientController::class)->names('masterDataClient');

            Route::get('/dataTableClientJenis', [ClientJenisController::class, 'dataTableClientJenis'])->name('masterDataClientJenis.dataTableClientJenis');
            Route::get('/masterDataClientJenis/export', [ClientJenisController::class, 'export'])->name('masterDataClientJenis.export');
            Route::get('/masterDataClientJenisTemplateImport', [ClientJenisController::class, 'template_import'])->name('masterDataClientJenis.templateImport');
            Route::post('/importClientJenis', [ClientJenisController::class, 'import_client_jenis'])->name('masterDataClientJenis.importClientJenis');
            Route::resource('/masterDataClientJenis', ClientJenisController::class)->names('masterDataClientJenis');

            Route::get('/dataTableClientLokasi', [ClientLokasiController::class, 'dataTableClientLokasi'])->name('masterDataClientLokasi.dataTableClientLokasi');
            Route::get('/masterDataClientLokasi/export', [ClientLokasiController::class, 'export'])->name('masterDataClientLokasi.export');
            Route::get('/masterDataClientLokasiTemplateImport', [ClientLokasiController::class, 'template_import'])->name('masterDataClientLokasi.templateImport');
            Route::post('/importClientLokasi', [ClientLokasiController::class, 'import_client_lokasi'])->name('masterDataClientLokasi.importClientLokasi');
            Route::resource('/masterDataClientLokasi', ClientLokasiController::class)->names('masterDataClientLokasi');

            Route::get('/dataTableClientSumberDana', [ClientSumberDanaController::class, 'dataTableClientSumberDana'])->name('masterDataClientSumberDana.dataTableClientSumberDana');
            Route::get('/masterDataClientSumberDana/export', [ClientSumberDanaController::class, 'export'])->name('masterDataClientSumberDana.export');
            Route::get('/masterDataClientSumberDanaTemplateImport', [ClientSumberDanaController::class, 'template_import'])->name('masterDataClientSumberDana.templateImport');
            Route::post('/importClientSumberDana', [ClientSumberDanaController::class, 'import_client_sumber_dana'])->name('masterDataClientSumberDana.importClientSumberDana');
            Route::resource('/masterDataClientSumberDana', ClientSumberDanaController::class)->names('masterDataClientSumberDana');
        });

        Route::group(['prefix' => '/honor'], function () {
            Route::get('/dataTableHonorAsesmen', [HonorAsesmenController::class, 'dataTableHonorAsesmen'])->name('masterDataHonorAsesmen.dataTableHonorAsesmen');
            Route::get('/masterDataHonorAsesmen/export', [HonorAsesmenController::class, 'export'])->name('masterDataHonorAsesmen.export');
            Route::get('/masterDataHonorAsesmenTemplateImport', [HonorAsesmenController::class, 'template_import'])->name('masterDataHonorAsesmen.templateImport');
            Route::post('/importHonorAsesmen', [HonorAsesmenController::class, 'import_honor_asesmen'])->name('masterDataHonorAsesmen.importHonorAsesmen');
            Route::resource('/masterDataHonorAsesmen', HonorAsesmenController::class)->names('masterDataHonorAsesmen');

            Route::get('/dataTableHonorInternal', [HonorInternalController::class, 'dataTableHonorInternal'])->name('masterDataHonorInternal.dataTableHonorInternal');
            Route::get('/masterDataHonorInternal/export', [HonorInternalController::class, 'export'])->name('masterDataHonorInternal.export');
            Route::get('/masterDataHonorInternalTemplateImport', [HonorInternalController::class, 'template_import'])->name('masterDataHonorInternal.templateImport');
            Route::post('/importHonorInternal', [HonorInternalController::class, 'import_honor_asesmen'])->name('masterDataHonorInternal.importHonorInternal');
            Route::resource('/masterDataHonorInternal', HonorInternalController::class)->names('masterDataHonorInternal');

            Route::get('/dataTableHonorRiset', [HonorRisetController::class, 'dataTableHonorRiset'])->name('masterDataHonorRiset.dataTableHonorRiset');
            Route::get('/masterDataHonorRiset/export', [HonorRisetController::class, 'export'])->name('masterDataHonorRiset.export');
            Route::get('/masterDataHonorRisetTemplateImport', [HonorRisetController::class, 'template_import'])->name('masterDataHonorRiset.templateImport');
            Route::post('/importHonorRiset', [HonorRisetController::class, 'import_honor_asesmen'])->name('masterDataHonorRiset.importHonorRiset');
            Route::resource('/masterDataHonorRiset', HonorRisetController::class)->names('masterDataHonorRiset');

            Route::get('/dataTableHonorTraining', [HonorTrainingController::class, 'dataTableHonorTraining'])->name('masterDataHonorTraining.dataTableHonorTraining');
            Route::get('/masterDataHonorTraining/export', [HonorTrainingController::class, 'export'])->name('masterDataHonorTraining.export');
            Route::get('/masterDataHonorTrainingTemplateImport', [HonorTrainingController::class, 'template_import'])->name('masterDataHonorTraining.templateImport');
            Route::post('/importHonorTraining', [HonorTrainingController::class, 'import_honor_asesmen'])->name('masterDataHonorTraining.importHonorTraining');
            Route::resource('/masterDataHonorTraining', HonorTrainingController::class)->names('masterDataHonorTraining');
        });

        Route::group(['prefix' => '/industri'], function () {
            Route::get('/dataTableIndustri', [IndustriController::class, 'dataTableIndustri'])->name('masterDataIndustri.dataTableIndustri');
            Route::get('/masterDataIndustri/export', [IndustriController::class, 'export'])->name('masterDataIndustri.export');
            Route::get('/masterDataIndustriTemplateImport', [IndustriController::class, 'template_import'])->name('masterDataIndustri.templateImport');
            Route::post('/importIndustri', [IndustriController::class, 'import_industri'])->name('masterDataIndustri.importIndustri');
            Route::resource('/masterDataIndustri', IndustriController::class)->names('masterDataIndustri');

            Route::get('/dataTableIndustriSektor', [IndustriSektorController::class, 'dataTableIndustriSektor'])->name('masterDataIndustriSektor.dataTableIndustriSektor');
            Route::get('/masterDataIndustriSektor/export', [IndustriSektorController::class, 'export'])->name('masterDataIndustriSektor.export');
            Route::get('/masterDataIndustriSektorTemplateImport', [IndustriSektorController::class, 'template_import'])->name('masterDataIndustriSektor.templateImport');
            Route::post('/importIndustriSektor', [IndustriSektorController::class, 'import_industri_sektor'])->name('masterDataIndustriSektor.importIndustriSektor');
            Route::resource('/masterDataIndustriSektor', IndustriSektorController::class)->names('masterDataIndustriSektor');
        });

        Route::group(['prefix' => '/pekerjaan'], function () {
            Route::get('/dataTablePekerjaan', [PekerjaanController::class, 'dataTablePekerjaan'])->name('masterDataPekerjaan.dataTablePekerjaan');
            Route::get('/masterDataPekerjaan/export', [PekerjaanController::class, 'export'])->name('masterDataPekerjaan.export');
            Route::get('/masterDataPekerjaanTemplateImport', [PekerjaanController::class, 'template_import'])->name('masterDataPekerjaan.templateImport');
            Route::post('/importPekerjaan', [PekerjaanController::class, 'import_pekerjaan'])->name('masterDataPekerjaan.importPekerjaan');
            Route::resource('/masterDataPekerjaan', PekerjaanController::class)->names('masterDataPekerjaan');

            Route::get('/dataTablePekerjaanKelompok', [PekerjaanKelompokController::class, 'dataTablePekerjaanKelompok'])->name('masterDataPekerjaanKelompok.dataTablePekerjaanKelompok');
            Route::get('/masterDataPekerjaanKelompok/export', [PekerjaanKelompokController::class, 'export'])->name('masterDataPekerjaanKelompok.export');
            Route::get('/masterDataPekerjaanKelompokTemplateImport', [PekerjaanKelompokController::class, 'template_import'])->name('masterDataPekerjaanKelompok.templateImport');
            Route::post('/importPekerjaanKelompok', [PekerjaanKelompokController::class, 'import_pekerjaan_kelompok'])->name('masterDataPekerjaanKelompok.importPekerjaanKelompok');
            Route::resource('/masterDataPekerjaanKelompok', PekerjaanKelompokController::class)->names('masterDataPekerjaanKelompok');
        });

        Route::group(['prefix' => '/pelatihan'], function () {
            Route::get('/dataTablePelatihan', [PelatihanController::class, 'dataTablePelatihan'])->name('masterDataPelatihan.dataTablePelatihan');
            Route::get('/masterDataPelatihan/export', [PelatihanController::class, 'export'])->name('masterDataPelatihan.export');
            Route::get('/masterDataPelatihanTemplateImport', [PelatihanController::class, 'template_import'])->name('masterDataPelatihan.templateImport');
            Route::post('/importPelatihan', [PelatihanController::class, 'import_pelatihan'])->name('masterDataPelatihan.importPelatihan');
            Route::resource('/masterDataPelatihan', PelatihanController::class)->names('masterDataPelatihan');

            Route::get('/dataTablePelatihanKelompok', [PelatihanKelompokController::class, 'dataTablePelatihanKelompok'])->name('masterDataPelatihanKelompok.dataTablePelatihanKelompok');
            Route::get('/masterDataPelatihanKelompok/export', [PelatihanKelompokController::class, 'export'])->name('masterDataPelatihanKelompok.export');
            Route::get('/masterDataPelatihanKelompokTemplateImport', [PelatihanKelompokController::class, 'template_import'])->name('masterDataPelatihanKelompok.templateImport');
            Route::post('/importPelatihanKelompok', [PelatihanKelompokController::class, 'import_pelatihan_kelompok'])->name('masterDataPelatihanKelompok.importPelatihanKelompok');
            Route::resource('/masterDataPelatihanKelompok', PelatihanKelompokController::class)->names('masterDataPelatihanKelompok');
        });

        Route::get('/dataTableBank', [BankController::class, 'dataTableBank'])->name('masterDataBank.dataTableBank');
        Route::get('/masterDataBank/export', [BankController::class, 'export'])->name('masterDataBank.export');
        Route::resource('/masterDataBank', BankController::class)->names('masterDataBank');

        Route::get('/dataTableUnit', [UnitController::class, 'dataTableUnit'])->name('masterDataUnit.dataTableUnit');
        Route::get('/masterDataUnit/export', [UnitController::class, 'export'])->name('masterDataUnit.export');
        Route::resource('/masterDataUnit', UnitController::class)->names('masterDataUnit');

        Route::get('/masterDataPositionLevel/export', [PositionLevelController::class, 'export'])->name('masterDataPositionLevel.export');
        Route::resource('/masterDataPositionLevel', PositionLevelController::class)->names('masterDataPositionLevel');
        Route::get('/dataTablePositionLevel', [PositionLevelController::class, 'dataTablePositionLevel'])->name('masterDataPositionLevel.dataTablePositionLevel');

        Route::get('/dataTablePositionType', [PositionTypeController::class, 'dataTablePositionType'])->name('masterDataPositionType.dataTablePositionType');
        Route::get('/masterDataPositionType/export', [PositionTypeController::class, 'export'])->name('masterDataPositionType.export');
        Route::resource('/masterDataPositionType', PositionTypeController::class)->names('masterDataPositionType');

        Route::get('/dataTablePosition', [PositionController::class, 'dataTablePosition'])->name('masterDataPosition.dataTablePosition');
        Route::get('/masterDataPosition/export', [PositionController::class, 'export'])->name('masterDataPosition.export');
        Route::resource('/masterDataPosition', PositionController::class)->names('masterDataPosition');

        Route::get('/dataTablePegawai', [PegawaiController::class, 'dataTablePegawai'])->name('masterDataPegawai.dataTablePegawai');
        Route::get('/masterDataPegawai/export', [PegawaiController::class, 'export'])->name('masterDataPegawai.export');
        Route::resource('/masterDataPegawai', PegawaiController::class)->names('masterDataPegawai');

        Route::get('/dataTableKategoriProyek', [KategoriProyekController::class, 'dataTableKategoriProyek'])->name('masterDataKategoriProyek.dataTableKategoriProyek');
        Route::get('/masterDataKategoriProyek/export', [KategoriProyekController::class, 'export'])->name('masterDataKategoriProyek.export');
        Route::resource('/masterDataKategoriProyek', KategoriProyekController::class)->names('masterDataKategoriProyek');

        Route::get('/dataTableUser', [UserController::class, 'dataTableUser'])->name('masterDataUser.dataTableUser');
        Route::get('/masterDataUser/export', [UserController::class, 'export'])->name('masterDataUser.export');
        Route::resource('/masterDataUser', UserController::class);
    });

    Route::group(['prefix' => '/bapl'], function () {
        Route::post('/searchKel', [BaplController::class, 'search_kel'])->name('bapl.searchKel');
        Route::post('/searchKodePos', [BaplController::class, 'search_kodepos'])->name('bapl.searchKodePos');

        Route::get('/dataTableBapl', [BaplController::class, 'dataTableBapl'])->name('bapl.dataTableBapl');
        Route::get('/export', [BaplController::class, 'export'])->name('bapl.export');
        Route::get('/trans/bapl/{ids}', [BaplController::class, 'export_bapl'])->name('bapl.bapl');
        Route::get('/trans/bapl-objek/{ids}', [BaplController::class, 'export_bapl_pemutakhiran'])->name('bapl.bapl-pemutakhiran');

        Route::get('/trans/pemutakhiran/{ids}', [BaplController::class, 'pemutakhiran'])->name('bapl.pemutakhiran');
        Route::get('/trans/pemutakhiran-badan/{ids}', [BaplController::class, 'pemutakhiran_badan'])->name('bapl.pemutakhiran-badan');
        Route::get('/trans/pemutakhiran-objek/{ids}', [BaplController::class, 'pemutakhiran_objek'])->name('bapl.pemutakhiran-objek');
        Route::get('/trans/pemutakhiran-objek-hotel/{ids}', [BaplController::class, 'pemutakhiran_objek_hotel'])->name('bapl.pemutakhiran-objek-hotel');
        Route::get('/trans/pemutakhiran-objek-resto/{ids}', [BaplController::class, 'pemutakhiran_objek_resto'])->name('bapl.pemutakhiran-objek-resto');

        Route::post('/trans/pemutakhiran/store', [BaplController::class, 'pemutakhiran_store'])->name('bapl.store-pemutakhiran');
        Route::post('/trans/pemutakhiran-badan/store', [BaplController::class, 'pemutakhiran_badan_store'])->name('bapl.store-pemutakhiran-wb');
        Route::post('/trans/pemutakhiran-objek/store', [BaplController::class, 'pemutakhiran_objek_store'])->name('bapl.store-pemutakhiran-op');
        Route::post('/trans/pemutakhiran-objek-hotel/store', [BaplController::class, 'pemutakhiran_objek_hotel_store'])->name('bapl.store-pemutakhiran-op-hotel');
        Route::post('/trans/pemutakhiran-objek-resto/store', [BaplController::class, 'pemutakhiran_objek_resto_store'])->name('bapl.store-pemutakhiran-op-resto');

        Route::resource('/trans', BaplController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/dashboard', DashboardController::class)->names('dashboard');
    Route::get('/slicing', [DashboardController::class, 'slicing'])->name('slicing');
});

require __DIR__.'/auth.php';
