const baseUrl = $(".baseUrl").data("url");
var cust = { id: "", nama: "", alamat: "", notelp: "" };
var cust_kosong = { id: "", nama: "", alamat: "", notelp: "" };

var list_item = [];
var list_item_kosong = [];

// data-toggle="modal" data-target="#mdl_pickupBar"

$(".item_bar").on("click", function () {
	$("#mdl_pickupBar .idbar").val($(this).data("id"));
	$("#mdl_pickupBar .namabar").val($(this).data("namabar"));
	$("#mdl_pickupBar .harga_jual").val($(this).data("harga_jual"));
	$("#mdl_pickupBar .harga_beli").val($(this).data("harga_beli"));
	$("#mdl_pickupBar").modal("toggle");
});

$("#mdl_pickupBar").on("shown.bs.modal", function () {
	$("#mdl_pickupBar .jum_minta").val("");
	$("#mdl_pickupBar .tot_harga").val("");
	$("#mdl_pickupBar .jum_minta").focus();

	$("#mdl_pickupBar .jum_minta").keyup(function (e) {
		e.preventDefault();
		// alert();
		var minta = $(this).val();
		var harga_jual = $("#mdl_pickupBar .harga_jual").val();
		$("#mdl_pickupBar .tot_harga").val(formatAngka(minta * harga_jual));
	});
});

$(".btn_sbmt_barang").on("click", function () {
	var item = {};
	item.idbar = $("#mdl_pickupBar .idbar").val();
	item.namabar = $("#mdl_pickupBar .namabar").val();
	item.qty = $("#mdl_pickupBar .jum_minta").val();
	item.harga_jual = $("#mdl_pickupBar .harga_jual").val();
	item.harga_beli = $("#mdl_pickupBar .harga_beli").val();

	if (item.qty == 0 || item.qty == "") {
		alert("Permintaan Harus Diisi!!!");
		return;
	}

	list_item.push(item);

	$(".dsp_4").html(refreshDsp_4());
	$("#mdl_pickupBar").modal("toggle");
});

$(".item_cust").on("click", function () {
	cust.id = $(this).data("id");
	cust.nama = $(this).data("nama");
	cust.alamat = $(this).data("alamat");
	cust.notelp = $(this).data("notelp");

	if (confirm("Tambahkan Customer?")) {
		$(".dsp_4").html(refreshDsp_4());
	}
});
$(".dsp_4").on("click", ".list_do", function () {
	if (confirm("Anda akan menghapus daftar DO?")) {
		let indexToDelete = $(this).data("row");
		if (indexToDelete < list_item.length) {
			list_item.splice(indexToDelete, 1);
		}
		$(".dsp_4").html(refreshDsp_4());
	}
});
$(".dsp_4").on("click", ".txt_dt_cust", function () {
	$(".btn_show_cust").click();
});
$(".dsp_4").on("click", ".btn_submit_do", function () {
	if (cust.id == "" || cust.nama == "") {
		alert("Data Customer Masih Kosong");
		return;
	}
	if (list_item.length == 0) {
		alert("Data Barang Masih Kosong");
		return;
	}

	if (confirm("Apakah Data Sudah Benar?")) {
		// Data yang akan Anda kirim dalam format JSON
		var datatosend = {};
		datatosend.cust = cust;
		datatosend.bars = list_item;

		// URL endpoint yang dituju
		var url = baseUrl + "kasir/Cdo/doTambah";

		// Lakukan permintaan POST dengan $.post
		$.post(url, datatosend, function (response) {
			// Tangani respon dari server di sini
			// console.log(response);
			var resp = JSON.parse(response);
			if (resp.status == "sukses") {
				resetTrx();
				$(".dsp_4").html(refreshDsp_4());
				$(".btn_show_bar").click();
				alert("Transaksi berhasil");
			}
		});
	}
});
function resetTrx() {
	cust = cust_kosong;
	list_item = list_item_kosong;
	// alert(list_item.length);
}
function formatAngka(angka) {
	return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function formatAngkaNormal(angka) {
	return angka.replace(/,/g, "");
}

function refreshDsp_4() {
	var textList = "";
	var total_harga = 0;
	var datacust = "";
	// alert(list_item[0].namabar);
	// return;
	list_item.forEach(function (item, index) {
		textList += `
                        <div class="row list_do" data-row = "${index}">
                            <div class="col">
                                ${item.namabar}  @ Rp 
                                ${formatAngka(item.harga_jual)}
                            </div>
                            <div class="col-2 text-center">
                                ${item.qty}
                            </div>
                            <div class="col-3 text-right">
                                ${formatAngka(item.qty * item.harga_jual)}
                            </div>
                        </div>
            `;

		total_harga += item.qty * item.harga_jual;
	});

	if (cust.nama == "") {
		datacust = "Klik Untuk cek customer";
		// exit();
	} else {
		datacust = cust.nama + "/" + cust.alamat + "/" + cust.notelp;
	}
	// alert(cust.nama);
	// return;
	return `
        <div class="card card-outline card-primary">

            <div class="card-body p-2">
                <div class="info-box bg-primary">

                    <div class="info-box-content p-1">
                        <div class="row">
                            <div class="col">
                                <span class="info-box-text">Nama/Alamat/Nohp</span>
                                <span class="info-box-number txt_dt_cust">${datacust}</span>
                            </div>
                            <div class="col text-right">
                                <span class="info-box-text">TOTAL</span>
                                <span class="info-box-number h5">
                                    Rp ${formatAngka(total_harga)}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <div class="card card_list_do">
                    <div class="card-body p-2">
                        <div class="row font-weight-bold">
                            <div class="col">KETERANGAN</div>
                            <div class="col-2 text-center">QTY</div>
                            <div class="col-3 text-right">JUMLAH</div>
                        </div>
                        
                        ${textList}
                        
                    </div>
                </div>

                <button class="btn btn-primary btn-block btn_submit_do">Submit</button>
            </div>
            <!-- /.card-body -->

        </div>
    `;
}
