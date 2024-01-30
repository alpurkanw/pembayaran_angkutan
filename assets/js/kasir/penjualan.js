// nota = {};
var dataBars = localStorage.getItem("bars");
var dataCusts = localStorage.getItem("custs");
var base_url = $(".baseUrl").data("url");

var list_pesanan = [];
var total_harga = 0;
var jumStok = 0;

//////////////////////////////////////////////////////////////////////////// mobile start
$(".display_utama").on("click", ".mdatacard", function () {
	// alert($(this).attr("databar"));
	// return;
	var dataItem = JSON.parse($(this).attr("databar"));

	var ls_dataItem = $(this).attr("databar");

	// alert(base_url + "kasir/Cpenjualan/getStok/" + dataItem.id);
	// return;

	$.get(base_url + "kasir/Cpenjualan/getStok/" + dataItem.id, function (data) {
		jumStok = JSON.parse(data).jum_stok;
		if (jumStok == 0) {
			alert("Stok Kosong");
			return;
		} else {
			$("#mmodal_formPermintaan .namabar").text(
				dataItem.id + " - " + dataItem.namabar + " Rp " + dataItem.harga_jual
			);
			$("#mmodal_formPermintaan #harga_jual").val(dataItem.harga_jual);
			$("#mmodal_formPermintaan #jum_stok").val(jumStok);
			$("#mmodal_formPermintaan #databar").val(ls_dataItem);
			$("#mmodal_formPermintaan #idbar").val(dataItem.id);
			$("#mmodal_formPermintaan #jum_minta").val(1);
			$("#mmodal_formPermintaan #catatan").val("");

			$("#mmodal_formPermintaan").modal("toggle");
		}
		// alert(jumStok);
		// return;
	});

	// lakukan fungsi get data jum_stok di sini
	// jika kosong toogle modal menjadi tutup
});

$(".m_btn_submitPermintaan").on("click", function () {
	// alert($("#modal_formPermintaan #databar").val());

	m_tambahListPensanan();

	// alert(list_pesanan.length);
	// return;
	changeDisplayTotal();
});

function m_tambahListPensanan() {
	// return;
	var jumMinta = $("#mmodal_formPermintaan #jum_minta").val();
	var jumlahStok = $("#mmodal_formPermintaan #jum_stok").val();
	var id = $("#mmodal_formPermintaan #idbar").val();
	var totalMinta = sumJumStokById(id) + parseInt(jumMinta);

	if (totalMinta > jumlahStok) {
		// alert(totalMinta + "-" + jumlahStok);
		alert("Permintaan Sudah Melebihi Jumlah Stok ");
		return;
	}

	var idbar = $("#mmodal_formPermintaan #idbar").val();

	// cek jika ada yang sama
	// cari index data yang sama
	const targetID = idbar;
	const index = list_pesanan.findIndex((item) => item.id === targetID);

	if (index >= 0) {
		// alert(parseInt(list_pesanan[index].jum_minta) + parseInt(jumMinta));
		list_pesanan[index].jum_minta =
			parseInt(list_pesanan[index].jum_minta) + parseInt(jumMinta);
	} else {
		var dataPesanan = {
			id: $("#mmodal_formPermintaan #idbar").val(),
			detailbar: $("#mmodal_formPermintaan #databar").val(),
			jum_minta: $("#mmodal_formPermintaan #jum_minta").val(),
			ket: $("#mmodal_formPermintaan #catatan").val(),
		};
		list_pesanan.push(dataPesanan);

		// alert("data sudah di tambahkan");
	}

	$("#mmodal_formPermintaan").modal("toggle");
	// $(".m_btn_opnDetailPesanan").html(JSON.stringify(list_pesanan));
	// refreshTampilanListPesanan();
	// console.log(list_pesanan[0].detailbar);
	// return;
}

/// cek jumlah permintaan yang 1d nya yang sama dengan yang akan di minta lagi setelah itu di jumlahkan agar 1 baris saja

function sumJumStokById(id) {
	const arr = list_pesanan;
	var jumMintatotalPerId = 0;
	for (let i = 0; i < arr.length; i++) {
		if (arr[i].id == id) {
			jumMintatotalPerId += parseInt(arr[i].jum_minta);
		}
	}
	return parseInt(jumMintatotalPerId);
}

// ubah tampilah total harga
function changeDisplayTotal() {
	var totalItem = list_pesanan.length;

	const arr = list_pesanan;
	var detBar = "";
	var sbttl = 0;
	var total = 0;
	for (let i = 0; i < arr.length; i++) {
		detBar = JSON.parse(arr[i].detailbar);

		sbttl = arr[i].jum_minta * detBar.harga_jual;
		total += sbttl;
		// alert(sbttl);
	}

	$(".display_utama .dsp_totalItem").text(
		"Total : " + totalItem + " Item | Nominal : " + total
	);
}

// function refresh_display() {
// 	// $(".m_btn_opnDetailPesanan").html(JSON.stringify(list_pesanan));
// }

$(".display_utama").on("click", ".mn_openListBarang", function () {
	$(".display_utama").html(display_listBarang());
});
$(".display_utama").on("click", ".m_btn_opnDetailPesanan", function () {
	$(".display_utama").html(detail_listPenjualan());
});
$(".display_utama").on("click", ".mn_openPembayaran", function () {
	$(".display_utama").html(desplay_detailPemabayan());
});
$(".display_utama").on("click", ".btn_openDtCust", function () {
	$("#modal_dataCustomer").modal("toggle");
	// $(".display_utama").html(desplay_detailPemabayan());
});

// btn_openDtCust;

// $(".m_btn_opnDetailPesanan").on("click", function () {
// 	// var list_p = JSON.stringify(list_pesanan);
// 	alert("Belum Ada Transaksi");

// 	return;
// 	var total = 0;
// 	var dsp_listPesanan = "";

// 	if (list_pesanan.length == 0) {
// 		alert("Belum Ada Transaksi");
// 		return;
// 	}

// 	list_pesanan.forEach(function (item, index) {
// 		var detailbar = JSON.parse(item.detailbar);
// 		// console.log(detailbar.harga_jual);
// 		// return ;
// 		var subtotal = detailbar.harga_jual * item.jum_minta;
// 		total += subtotal;
// 		// console.log(detailbar.harga_jual);
// 		dsp_listPesanan +=
// 			`
// 				<div class="row">
// 					<div class="col">
// 						<div class="card">
// 							<div class="card-body p-2">
// 								` +
// 			detailbar.namabar +
// 			"|" +
// 			item.jum_minta +
// 			"|" +
// 			`
// 							</div>
// 						</div>
// 					</div>
// 				</div>
// 			`;
// 	});

// 	$(".display_utama").html(dsp_listPesanan);
// 	// $(".total_harga").text(total);
// });

// function refreshTampilanListPesanan() {
// 	var total = 0;
// 	var dsp_listPesanan = "";
// 	list_pesanan.forEach(function (item, index) {
// 		var detailbar = JSON.parse(item.detailbar);
// 		// console.log(detailbar.harga_jual);
// 		// return ;
// 		var subtotal = detailbar.harga_jual * item.jum_minta;
// 		total += subtotal;
// 		// console.log(detailbar.harga_jual);
// 		dsp_listPesanan += comp_listPesanan(index, item);
// 	});

// 	$(".dsp_list_pesanan").html(dsp_listPesanan);
// 	$(".total_harga").text(total);
// 	// $(".keranjang_item").text(list_pesanan.length + " Item");
// 	$("#modal_formPermintaan").modal("toggle");
// }

////////////////////////////////////////////////////////////////////////////////////////////mobile end

$(".datacard").on("click", function () {
	var dataItem = JSON.parse($(this).attr("databar"));
	var ls_dataItem = $(this).attr("databar");

	// alert(base_url + "kasir/Cpenjualan/getStok/" + dataItem.id);
	// return;

	$.get(base_url + "kasir/Cpenjualan/getStok/" + dataItem.id, function (data) {
		jumStok = JSON.parse(data).jum_stok;
		if (jumStok == 0) {
			alert("sStok Kosong");
			return;
		} else {
			$("#modal_formPermintaan .namabar").text(
				dataItem.id + " - " + dataItem.namabar + " Rp " + dataItem.harga_jual
			);
			$("#modal_formPermintaan #harga_jual").val(dataItem.harga_jual);
			$("#modal_formPermintaan #jum_stok").val(jumStok);
			$("#modal_formPermintaan #databar").val(ls_dataItem);
			$("#modal_formPermintaan #idbar").val(dataItem.id);
			$("#modal_formPermintaan #jum_minta").val(1);
			$("#modal_formPermintaan #catatan").val("");

			$("#modal_formPermintaan").modal("toggle");
		}
		// alert(jumStok);
		// return;
	});

	// lakukan fungsi get data jum_stok di sini
	// jika kosong toogle modal menjadi tutup
});

$(".dsp_list_pesanan ").on("click", ".cart_list_pesanan", function () {
	// alert($(this).attr("dataIndex"));
	// dataIndex = "${index}" dataNamaBar="${
	//   itembar.namabar
	// }" dataIdbar

	$("#modal_cartList .index").text($(this).attr("dataIndex"));
	$("#modal_cartList .idbar").text($(this).attr("dataIdbar"));
	$("#modal_cartList .namabar").text($(this).attr("dataNamaBar"));
	$("#modal_cartList").modal("toggle");
});

$(".search-input").on("keyup", function () {
	var keyword = $(this).val();
	tampilkanBarang(keyword);
});

$(".btn_arrow_back").on("click", function () {
	window.location.href = base_url + "kasir/Home";
});

function comp_listPesanan(index, data) {
	var itembar = JSON.parse(data.detailbar);
	// console.log(itembar.harga_jual * data.jum_minta);
	return `
	<div class="card text-bg-light mb-2 cart_list_pesanan" dataIndex = "${index}" dataNamaBar="${
		itembar.namabar
	}" dataIdbar = "${itembar.id}">
		<div class="card-body p-1 ">
			<div class="row ">
				<div class="col-8  ">
					<h6>${itembar.namabar + index} | Qty: ${data.jum_minta}</h6>
				</div>
				<div class="col-4 fw-bold text-end" style="font-size: 14px;">
				  ${itembar.harga_jual * data.jum_minta}
				</div>
			</div>
        <p class="card-text " style="font-size: 13px;">
          Id: ${itembar.id} | @${itembar.harga_jual}   ${" | " + data.ket}
        </p>
		</div>
	</div>
	`;
}
function tampilkanBarang(kword) {
	kword = kword.toLowerCase();
	if (kword.length > 2) {
		$(".datacard").each(function () {
			var info = $(this).attr("databar").toLowerCase();
			if (info.indexOf(kword) === -1) {
				$(this).hide();
			} else {
				$(this).show();
			}
		});
	} else {
		$(".datacard").each(function () {
			$(this).show();
		});
	}
}

// // Fungsi untuk melakukan pencarian barang
// $(".btn_search").on("click", function () {
// 	var keyword = $(this).val();
// 	// alert(keyword);
// 	tampilkanBarang(keyword);
// });
