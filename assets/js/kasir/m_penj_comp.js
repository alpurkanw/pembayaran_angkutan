function display_listBarang() {
	var bars = JSON.parse(localStorage.getItem("bars"));
	var tes = "";
	var databar = "";

	bars.forEach((bar) => {
		databar = JSON.stringify(bar);
		// alert(databar);
		tes +=
			`
        <div class="col-6 mr-2">
            <div class="card mb-2 mdatacard" databar='` +
			databar +
			`' style="height: 11rem; width: 11rem;">
                <img src="http://localhost/devel/02_kasir_web_v_retail/assets/img/nasi_goreng.jpg" class="card-img-top img-thumbnail" style="height: 120px;">
                <div class="card-body p-1 ">
                    <div class="row">
                        <div class="col text-left">
                            <h5 class="card-title fs-6  mb-1">${bar.namabar} | ${bar.jum_stok} | <span class="badge text-bg-info">${bar.harga_jual}</span></h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
                            `;
	});

	return `
        <div class="container">


            <div class="row">
                <div class="col">
                    <div class="card bg-info shadow-sm m_btn_opnDetailPesanan">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col text-end ">
                                    <h6 class="card-title fs-6 dsp_totalItem">Total : 0 Item | Rp 0</h6>
                                </div>
                               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-2">
            <div class="display_submenu">
                <div class="card border-primary shadow-sm ">
                    <div class="card-body p-2">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="input-group  ">
                                    <input type="text" class="form-control search-input " placeholder="Cari Barang Disini" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-info btn_search" type="button">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            ${tes}
                        </div>
                        
                    </div>
                </div>
            </div>



        </div>
    `;
}

function detail_listPenjualan() {
	return `
    <div class="container">
        <div class="row">

            <div class="col-auto">
               
                
                <div class="card border-primary shadow-sm btn_openDtCust">
                    <div class="card-body p-2">
                        <i class="bi bi-person "></i>
                    </div>
                </div>
            </div>
            <div class="col px-0">

                <div class="card border-primary shadow-sm">
                    <div class="card-body p-2">
                        <label class="label fw-bold ">customer</label>
                    </div>
                </div>
                
                
            </div>
            <div class="col-auto ">
                <div class="card border-primary shadow-sm">
                    <div class="card-body p-2">
                        <i class="bi bi-gear dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" ></i>
                        
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item mn_openPembayaran" href="#">SIMPAN</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">BATALKAN</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        
        </div>

        <hr class="my-2">

        <div class="row mb-2">
            <div class="col">
                <div class="card border-primary shadow-sm">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Nasi Goreng</h5>
                            </div>
                            <div class="col text-end">
                                <h5 class="card-title">2,000</h5>
                            </div>
                        </div>
                        <p class="card-text">
                            @Rp 1,000 || Catatan disini jika ada dan boleh sampai 100 kata atau lebih
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card border-primary shadow-sm">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Nasi Goreng</h5>
                            </div>
                            <div class="col text-end">
                                <h5 class="card-title">2,000</h5>
                            </div>
                        </div>
                        <p class="card-text">
                            @Rp 1,000 || Catatan disini jika ada dan boleh sampai 100 kata atau lebih
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-2">

        <div class="row">
            <div class="col">
                <button type="button" class="btn w-100 btn-info fs-6  fw-bold fs-3 mn_openPembayaran ">10000</button>
            </div>
         
        </div>
        <div class="row">
       
            <div class="col">
                <button type="button" class="btn w-100 btn-secondary fs-6  mt-2 fw-bold fs-3 mn_openListBarang">Kembali</button>
            </div>
        </div>
    </div>
    `;
}

function desplay_detailPemabayan() {
	return `
        <div class="container">
            <div class="row">


                <div class="col">
                    <button type="button" class="btn w-100 btn-info p-1 fw-bold fs-5 ">10000</button>
                </div>
                
            </div>

            <hr class="my-2">

            <div class="row mb-2">
                <div class="col">
                    <label for="exampleFormControlInput1" class="form-label">JEnis Transaksi</label>
                    <select class="form-select" aria-label="Default select example">
                        <option value="1">TUNAI</option>
                        <option value="2">TRANSFER</option>
                        <option value="3">KREDIT</option>
                    </select>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <label for="exampleFormControlInput1" class="form-label">Pemberian Potongan</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="exampleFormControlInput1" class="form-label">Pembayaran</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <button type="button" class="btn w-100 btn-info  fw-bold fs-6 ">BAYAR</button>
                </div>
                <div class="col">
                    <button type="button" class="btn w-100 btn-warning  fw-bold fs-6 ">SIMPAN</button>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <button type="button" class="btn w-100 btn-info  fw-bold fs-6 ">BATALKAN</button>
                </div>
                
            </div>


        </div>

    `;
}

function desplay_suksesTransaksi() {
	return `
        <div class="container">
            <div class="row">


                <div class="col">
gambar
                </div>
                
            </div>

            <hr class="my-2">

            <div class="row mb-2">
                <div class="col">
                   Transaksi Sukses
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <label for="exampleFormControlInput1" class="form-label">Pemberian Potongan</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="exampleFormControlInput1" class="form-label">Pembayaran</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <button type="button" class="btn w-100 btn-info  fw-bold fs-6 ">BAYAR</button>
                </div>
                <div class="col">
                    <button type="button" class="btn w-100 btn-warning  fw-bold fs-6 ">SIMPAN</button>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <button type="button" class="btn w-100 btn-info  fw-bold fs-6 ">BATALKAN</button>
                </div>
                
            </div>


        </div>

    `;
}
