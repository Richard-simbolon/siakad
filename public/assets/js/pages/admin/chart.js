$(document).ready(function() {
    jumlahMahasiswa();
    jumlahMahasiswaJurusan();
    jumlahMahasiswaStatus();
    jumlahDosen();
    jumlahDosenJenis();
    jumlahDosenStatus();
});


function jumlahMahasiswa() {
    if ($('#kt_chart_grafik_jumlah_mahasiswa').length == 0) {
        return;
    }
    $.ajax({
        type:'GET',
        url:'/data/mahasiswa/grafik_mahasiswa',
        success:function(result) {
            //console.log(result);
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_mahasiswa',
                data: JSON.parse(result),
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger')
                ],
            });
        }
    });
}

function jumlahMahasiswaJurusan() {
    if ($('#kt_chart_grafik_jumlah_mahasiswa_jurusan').length == 0) {
        return;
    }
    $.ajax({
        type:'GET',
        url:'/data/mahasiswa/grafik_jurusan',
        success:function(result) {
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_mahasiswa_jurusan',
                data: JSON.parse(result),
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger'),
                    KTApp.getStateColor('warning')
                ],
            });
        }
    });
}

function jumlahMahasiswaStatus() {
    if ($('#kt_chart_grafik_jumlah_mahasiswa_status').length == 0) {
        return;
    }
    $.ajax({
        type:'GET',
        url:'/data/mahasiswa/grafik_status',
        success:function(result) {
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_mahasiswa_status',
                data: JSON.parse(result),
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger')
                ],
            });
        }
    });
}

function jumlahDosen() {
    if ($('#kt_chart_grafik_jumlah_dosen').length == 0) {
        return;
    }
    $.ajax({
        type:'GET',
        url:'/data/dosen/grafik_dosen',
        success:function(result) {
            //console.log(result);
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_dosen',
                data: JSON.parse(result),
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger')
                ],
            });
        }
    });
}

function jumlahDosenJenis() {
    if ($('#kt_chart_grafik_jumlah_dosen_jenis').length == 0) {
        return;
    }
    $.ajax({
        type:'GET',
        url:'/data/dosen/grafik_jurusan',
        success:function(result) {
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_dosen_jenis',
                data: JSON.parse(result),
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger'),
                    KTApp.getStateColor('warning')
                ],
            });
        }
    });
}

function jumlahDosenStatus() {
    if ($('#kt_chart_grafik_jumlah_dosen_status').length == 0) {
        return;
    }
    $.ajax({
        type:'GET',
        url:'/data/dosen/grafik_status',
        success:function(result) {
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_dosen_status',
                data: JSON.parse(result),
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('danger')
                ],
            });
        }
    });
}