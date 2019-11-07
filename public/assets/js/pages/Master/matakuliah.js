$(document).ready(function() {
    $(document).on('blur' , '#bobot_tatap_muka' , function(){
        calc();
    });
    $(document).on('blur' , '#bobot_praktikum' , function(){
        calc();
    });
    $(document).on('blur' , '#bobot_praktek_lapangan' , function(){
        calc();
    });
    $(document).on('blur' , '#bobot_simulasi' , function(){
        calc();
    });
})

function calc() {
    var bobot_tatap_muka = $("#bobot_tatap_muka").val() == '' ? 0 : $("#bobot_tatap_muka").val();
    var bobot_praktikum=$("#bobot_praktikum").val()== '' ? 0 : $("#bobot_praktikum").val();
    var bobot_praktek_lapangan=$("#bobot_praktek_lapangan").val()== '' ? 0 : $("#bobot_praktek_lapangan").val();
    var bobot_simulasi=$("#bobot_simulasi").val()== '' ? 0 : $("#bobot_simulasi").val();
    var bobot = parseFloat(bobot_tatap_muka) + parseFloat(bobot_praktikum) + parseFloat(bobot_praktek_lapangan) + parseFloat(bobot_simulasi);
    $("#bobot_mata_kuliah").val(bobot);
}