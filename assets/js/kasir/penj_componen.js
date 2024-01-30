// $('.list_barang').


function form_pickupBar(data) {
	return `
                        <div class="card shadow mb-4">
                            <div class="card-header py-2  d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">[ ${data.id} ] - ${data.namabar}</h6>
                            </div>
                            <div class="card-body">
                                   

                                <div class="row mb-2">
                                    <div class="col-4">
                                        <img class="img-thumbnail card-img-top" src="https://kiosprogram.com/upload/kamera.jpg" alt="">
                                    </div>
                                    <div class="col-8">
                                        <table class="table table-light">
                                            <tbody>
                                               
                                                <tr>
                                                    <td>Kategori</td>
                                                    <td>${data.kategori}</td>
                                                </tr>
                                                <tr>
                                                    <td>Stok</td>
                                                    <td>${data.jum_stok}</td>
                                                </tr>
                                                <tr>
                                                    <td>Harga</td>
                                                    <td>
                                                       Rp ${data.harga_jual.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") }
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Permintaan </td>
                                                    <td>
                                                        <input type="number" class="form-control inp_minta" autofocus >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col text-right">
                                                <button class="btn  text-white bg-gradient-info" data-dismiss="modal">Batalkan</button>
                                                <button class="btn  text-white bg-gradient-primary btn_tambahKeranjang">Tambah ke keranjang</button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                `;
}

function dsp_detail_penjualan(dt) {
	return `
                            <div class="card  mb-2">
                                <div class="card-header ">
                                    <h6 class="m-0 font-weight-bold text-primary">Detail Pembayaran</h6>
                                </div>
                                <div class="card-body px-2 py-0">

                                    <div class="row">
                                        <div class="col-6  p-1">
                                            <div class="card shadow-sm ">

                                                <div class="card-body p-1">
                                                    detail pesanan
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row"></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row"></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 p-1 ">
                                            <div class="card shadow-sm ">

                                                <div class="card-body p-1">
                                                    detail pesanan
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>

                                </div>
                            </div>
    `;
}
