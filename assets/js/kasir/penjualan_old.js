nota = {};
var list_pesanan = [];
var total_harga = 0;
var base_url = $(".global_var").data("base_url");
var dataBar = "";

$(document).ready(function () {
	$(".btn_display_barang").click();

	$(".list_barang").DataTable();
	$(".list_customer").DataTable();

	$(".inp_kode_barang").keydown(function (e) {
		if (event.which == 13) {
			var id = $(this).val();
			if (id == "") {
				// alert(list_pesanan.length);
				if (list_pesanan.length > 0) {
					if (confirm("Transaksi Sudah Selesai?")) {
						$(".inp_potongan").focus();
					}
				}
			}
			Penj_pickupdetail(id);
		}
	});

	$(".btn_opn_list_barang").click(function () {
		$("#modal_list_barang").modal("toggle");
	});

	$(".list_barang .barang").click(function () {
		var id = $(this).data("id");
		Penj_pickupdetail(id);
		$("#modal_list_barang").modal("toggle");
	});
});

$(".customer").click(function () {
	$(".dsp_nama_cust").text("tes nama");
});

$("#modal_penjualan").on("click", ".btn_tambahKeranjang", function () {
	// alert(JSON.stringify(dataBar));
	var minta = $("#modal_penjualan .inp_minta").val();
	// alert(minta);
	if (minta != "" || minta != 0) {
		var pesanan = {
			id: dataBar.id,
			namabar: dataBar.namabar,
			harga_beli: dataBar.harga_beli,
			harga_jual: dataBar.harga_jual,
			jum_stok: dataBar.jum_stok,
			satuan: dataBar.satuan,
			hrgjualbawah: dataBar.hrgjualbawah,
			hrgjualatas: dataBar.hrgjualatas,
			minta: minta,
		};
		list_pesanan.push(pesanan);
		// alert(dataBar.id);
		displyNota(list_pesanan);
		$("#modal_penjualan").modal("toggle");
	} else {
		$("#modal_penjualan").modal("toggle");
	}
});

function Penj_pickupdetail(id) {
	var id_bar = id;
	var url = base_url + "kasir/CPenj/BarPerId/" + id_bar;
	$.get(url, function (data) {
		// alert(data)
		// return;
		dataBar = JSON.parse(data)[0];
		// alert(dataBar.id)
		// return;
		$("#modal_penjualan .modal-content").html(form_pickupBar(dataBar));
		$("#modal_penjualan").modal("toggle");
		$("#modal_penjualan").on("shown.bs.modal", function () {
			$("#modal_penjualan .inp_minta").focus();
		});
		// alert(dataBar.namabar)

		$("#modal_penjualan .inp_minta").keydown(function (e) {
			if (event.which == 13) {
				$(".btn_tambahKeranjang").click();
				$(".inp_kode_barang").val("");
				$(".inp_kode_barang").focus();
			}
		});
	});
}

function displyNota(pesanan) {
	// tampilan list pesanan
	var komp = "";
	var no = 0;
	var total = 0;
	var sub_harga = 0;
	$.each(list_pesanan, function (indexInArray, valueOfElement) {
		no = indexInArray + 1;
		sub_harga =
			list_pesanan[indexInArray].minta * list_pesanan[indexInArray].harga_jual;
		komp += `<tr>
						<td>
						${list_pesanan[indexInArray].id + "-" + list_pesanan[indexInArray].namabar} 
						<small>@${list_pesanan[indexInArray].harga_jual
							.toString()
							.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</small>
						</td>
						<td class="text-center">${list_pesanan[indexInArray].minta}</td>
						<td class="text-right">${sub_harga
							.toString()
							.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}</td>
					</tr>`;
		total += sub_harga;
		total_harga = total;
	});
	$(".display_pesanan").html(komp);
	$(".dsp_total").text(
		"Rp " + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
	);

	//menampilkan Total
}

// $('.dsp_total').on('click', function () {

// 	$("#modal_penjualan .modal-dialog").addClass("modal-xl");

// 	$("#modal_penjualan .modal-content").html(dsp_detail_penjualan(dataBar))
// 	$("#modal_penjualan").modal("toggle")

// })

// $('.btn_display_barang').on('click', function () {
// 	// alert();
// 	$('.display_barang').fadeIn();
// 	$('.display_customer').fadeOut();

// })

// $('.btn_display_customer').on('click', function () {

// 	$('.display_barang').fadeOut();
// 	$('.display_customer').fadeIn();
// })
