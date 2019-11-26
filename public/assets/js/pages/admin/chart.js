$(document).ready(function() {
    jumlahMahasiswa();
    jumlahMahasiswaJurusan();
    jumlahMahasiswaStatus();
    jumlahDosen();
    jumlahDosenJenis();
    jumlahDosenStatus();


});

var color = ['#34bfa3','#36a3f7','#fd3995','#5d78ff','#282a3c','#ffb822','#D68910','#A569BD', '#F0B27A', '#5D6D7E','#F7DC6F'];

function jumlahMahasiswa() {
    if ($('#kt_chart_grafik_jumlah_mahasiswa').length == 0) {
        return;
    }
    $.ajax({
        type:'GET',
        url:'/data/mahasiswa/grafik_mahasiswa',
        success:function(result) {
            var res = JSON.parse(result);
            $("#totalJumlahMahasiswa").html("Total : " + res.count);
            $.each(res.data, function( index, value ) {
                $("#sectionDataJumlahMahasiswa").append(
                    '<div class="kt-widget14__legend"><span class="kt-widget14__bullet" style="background-color: '+color[index]+'"></span><span class="kt-widget14__stats" id="totalJumlahLakilaki">' + value['label'] + ' : ' + value['value'] + '</span></div>'
                );
            });
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_mahasiswa',
                data: res.data,
                colors: color
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
            var res = JSON.parse(result);
            $("#totalJumlahMahasiswaJurusan").html("Total : " + res.count);
            $.each(res.data, function( index, value ) {
                $("#sectionDataJumlahMahasiswaJurusan").append(
                    '<div class="kt-widget14__legend"><span class="kt-widget14__bullet" style="background-color: '+color[index]+'"></span><span class="kt-widget14__stats" id="totalJumlahLakilaki">' + value['label'] + ' : ' + value['value'] + '</span></div>'
                );
            });
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_mahasiswa_jurusan',
                data: res.data,
                colors: color
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
            var res = JSON.parse(result);
            $("#totalJumlahMahasiswaStatus").html("Total : " + res.count);
            $.each(res.data, function( index, value ) {
                $("#sectionDataJumlahMahasiswaStatus").append(
                    '<div class="kt-widget14__legend"><span class="kt-widget14__bullet" style="background-color: '+color[index]+'"></span><span class="kt-widget14__stats" id="totalJumlahLakilaki">' + value['label'] + ' : ' + value['value'] + '</span></div>'
                );
            });
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_mahasiswa_status',
                data: res.data,
                colors: color
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
            var res = JSON.parse(result);
            $("#totalJumlahDosen").html("Total : " + res.count);
            $.each(res.data, function( index, value ) {
                $("#sectionDataJumlahDosen").append(
                    '<div class="kt-widget14__legend"><span class="kt-widget14__bullet" style="background-color: '+color[index]+'"></span><span class="kt-widget14__stats" id="totalJumlahLakilaki">' + value['label'] + ' : ' + value['value'] + '</span></div>'
                );
            });
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_dosen',
                data: res.data,
                colors: color
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
        url:'/data/dosen/grafik_jenis',
        success:function(result) {
            var res = JSON.parse(result);
            $("#totalJumlahDosenJenis").html("Total : " + res.count);
            $.each(res.data, function( index, value ) {
                $("#sectionDataJumlahDosenJenis").append(
                    '<div class="kt-widget14__legend"><span class="kt-widget14__bullet" style="background-color: '+color[index]+'"></span><span class="kt-widget14__stats" id="totalJumlahLakilaki">' + value['label'] + ' : ' + value['value'] + '</span></div>'
                );
            });
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_dosen_jenis',
                data: res.data,
                colors:color
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
            var res = JSON.parse(result);
            $("#totalJumlahDosenStatus").html("Total : " + res.count);
            $.each(res.data, function( index, value ) {
                $("#sectionDataJumlahDosenStatus").append(
                    '<div class="kt-widget14__legend"><span class="kt-widget14__bullet" style="background-color: '+color[index]+'"></span><span class="kt-widget14__stats" id="totalJumlahLakilaki">' + value['label'] + ' : ' + value['value'] + '</span></div>'
                );
            });
            Morris.Donut({
                element: 'kt_chart_grafik_jumlah_dosen_status',
                data: res.data,
                colors:color
            });
        }
    });
}