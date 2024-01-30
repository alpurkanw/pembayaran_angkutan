const baseUrl = $(".baseUrl").data("url");
// var cust = { id: "", nama: "", alamat: "", notelp: "" };
// var cust_kosong = { id: "", nama: "", alamat: "", notelp: "" };

var list_item = [];
// var list_item_kosong = [];

// data-toggle="modal" data-target="#mdl_pickupBar"

// ambil list angkutan yang siap di bayarkan
// (yang sudah di update kubikasi dan harga angkut dan harga materiap per kubiknya)

$(".btn_pilih_pic").on("click", function () {
	// alert(baseUrl);
	var namapic = $("#namaPic").val();

	var datatosend = {};
	datatosend.namapic = namapic;

	if (namapic == 0) {
		alert("Pilih Sopirnya");
		return;
	}

	$.post(
		baseUrl + "/adm/CpembPic/get_angkutan",
		datatosend,
		function (response) {
			// alert(response);
			$(".t_body").html(response);
		}
	);
	// }
});

// masukan ke dalam array data list angkutan yang akan di bayarkan dan tampilkan ke list
$("#list_lap_bar .t_body").on("click", ".item_bar", function () {
	// Membuat objek item
	const item_input = {
		id: $(this).data("id"),
		namapic: $(this).data("namapic"),
		namapic: $(this).data("namapic"),
		tujuan: $(this).data("tujuan"),
		namamat: $(this).data("namamat"),
		tglangkut: $(this).data("tglangkut"),
		jum_kubikasi: $(this).data("jum_kubikasi"),
		upah_ang_per_kubik: $(this).data("upah_ang_per_kubik"),
		hargaperkubik: $(this).data("hargaperkubik"),
	};

	// Menambahkan objek item ke dalam array list_item
	if (list_item.length == 0) {
		list_item.push(item_input);
	} else {
		// Mencari nilai "id" yang sama dengan inputan
		const foundItem = list_item.find((item) => item.id === item_input.id);

		// Memeriksa apakah nilai "id" yang bernilai 25 ditemukan
		if (foundItem) {
			alert("Data Sudah DIMASUKAN Kedalam List Pembayaran");
		} else {
			list_item.push(item_input);
		}
	}

	$(".dsp_4").html(refreshDsp_4());
	// $("#mdl_pickupBar").modal("toggle");
});

//klik jika ingin mendelete data angkutan yang akan di bayarkan
$(".dsp_4 ").on("click", ".list_angkutan", function () {
	// alert(baseUrl);

	if (confirm("Mau Dibatalkan?")) {
		var i = $(this).data("row");
		list_item.splice(i, 1);
		$(".dsp_4").html(refreshDsp_4());
	}
	// }
});

//jika sudah di inputkan ke dalam list angkutan yang siap di bayar, maka klik sumit
$(".dsp_4 ").on("click", ".btn_submit_angkutan", function () {
	// alert(list_item.map((item) => item.id));

	if (list_item.length == 0) {
		alert("Data Angkutan Belum Ditambah");
		return;
	}
	var ids = list_item.map((item) => item.id);
	var total_harga = $(this).data("total_harga");
	// alert(total_harga);
	// return;
	var datainsert = {
		ids: ids,
		total_harga: total_harga,
	};
	if (confirm("Data Sudah Benar?")) {
		$.post(
			baseUrl + "/adm/Cpembpic/prosesByr",
			datainsert,
			function (response) {
				var resp = JSON.parse(response);

				// console.log(response);
				// alert(response);
				if (resp.pesan == "OK") {
					// list_item = [];
					alert("Transaksi Berhasil");
					// $(".dsp_4").html(refreshDsp_4());
					var url = baseUrl + "/adm/Cpembpic/notaPrint/" + resp.nota;
					bukawinbaru(url);
					location.reload();
				}
				// $(".t_body").html(response);
			}
		);
	}
});

function bukawinbaru(url) {
	window.open(
		url,
		"_blank",
		"toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1000,height=600"
	);
}

function formatAngka(angka) {
	return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatAngkaNormal(angka) {
	return angka.replace(/,/g, "");
}

function refreshDsp_4() {
	var textList = `
	
	`;
	var total_harga = 0;
	// var datacust = "";
	var total_harga_material = 0;
	// alert(list_item[0].namabar);
	// return;
	list_item.forEach(function (item, index) {
		total_harga_material =
			parseFloat(item.jum_kubikasi) * parseFloat(item.hargaperkubik);
		textList += `
					<div class="row ">
						<div class="col">
		
		
							<div class="card card_list_do mb-2 shadow">
								<div class="card-body p-2">
									
								<div class="row list_angkutan" data-row = "${index}">
									
									<div class="col ">
										<span class="font-weight-bold">
										${
											item.tglangkut.toString().substring(0, 4) +
											"-" +
											item.tglangkut.toString().substring(4, 6) +
											"-" +
											item.tglangkut.toString().slice(-2)
										}
										</span>
										 <br>
										<span class="small">
											${item.namapic + "|" + item.namapic + "|" + item.namamat}  @
																			${formatAngka(parseFloat(item.jum_kubikasi))}
																			@ Rp 
											${formatAngka(parseFloat(item.upah_ang_per_kubik))}
										</span>
									</div>
									
									<div class="col-3 font-weight-bold text-right">
										${formatAngka(total_harga_material)}
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
            `;

		total_harga += total_harga_material;
	});

	return `
        <div class="card card-outline card-primary">
			<div class="card-header p-2">
				Angkutan yang akan dibayar
			</div>
            <div class="card-body p-2">
				
                <div class="info-box bg-primary shadow">

                    <div class="info-box-content p-1">
                        <div class="row">
                         
                            <div class="col text-left">
                                <span class="info-box-text">TOTAL</span>
                                <span class="info-box-number h5">
                                    Rp ${formatAngka(total_harga)}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                
                        
                        ${textList}
                        
                    
                <button class="btn btn-primary  btn-block btn_submit_angkutan" data-total_harga ="${total_harga}">Submit</button>
            </div>
            <!-- /.card-body -->

        </div>
    `;
}
