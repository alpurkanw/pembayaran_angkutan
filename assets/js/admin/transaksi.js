var base_url = $(".baseUrl").data("url");
var datalistbar = [];
$(".btn_openFormTambahStok").click(function (e) { 
    e.preventDefault();
    var id =  $(this).data("id");
    var namabar =  $(this).data("namabar");
    var stokSebelum =  $(this).data("jum_stok");
    // alert(namabar)
    $("#modalFormTambahStok #id_bar").val(id);
    $("#modalFormTambahStok .namabar").text(namabar);
    $("#modalFormTambahStok #namabar").val(namabar);
    $("#modalFormTambahStok #stok_sebelum").val(stokSebelum);
    $("#modalFormTambahStok").modal("toggle");

    $("#modalFormTambahStok").on("shown.bs.modal", function () {
        $("#modalFormTambahStok #jum_tambah").val("")
        $("#modalFormTambahStok #jum_tambah").focus()
    });
    
});

$(".list_bar_stok").on("click",  function () {
    sessionStorage.setItem ('list_bar_stok', datalistbar )
    window.location.href = base_url + "admin/Ctransaksi/openDetailtransaksi"

});


$("#modalFormTambahStok").on("click", ".btn_tambahstok", function () {
    // alert(base_url)
    // var param
    var itemTambahStok = {
        "id" : $("#modalFormTambahStok #id_bar").val(),
        "namabar" : $("#modalFormTambahStok #namabar").val(),
        "stok_awal" : $("#modalFormTambahStok #stok_sebelum").val(),
        "stok_tambah" : $("#modalFormTambahStok #jum_tambah").val(),
    }

    // $.post(base_url + "admin/Ctransaksi/addCartTambahStok", itemTambahStok,
    //     function (data) {
    //      alert(data)   
    //     }
    // );

    $("#modalFormTambahStok").modal("toggle");

    // alert(itemTambahStok)
    datalistbar.push(itemTambahStok)
    // alert(datalistbar.length)
    $(".list_bar_stok").text("Total Item : " + datalistbar.length)

});
