<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <div class="contents">
                <h4 class="text-info">Form Tambah Dan Update Produk</h4>
                <hr>
                <form class="inline">
                    <div class="col-md-4">
                        <label for="">ID Kopi</label>
                        <input type="text" id="txtIDKopi" class="form-control" placeholder="Unik ID Kopi">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="">Nama Kopi</label>
                        <input type="text" id="txtNamaKopi" class="form-control" placeholder="Nama Kopi">
                    </div>

                    <div class="col-md-4" style="margin-top:24px; margin-left:-5px;">
                        <button type="button" id="btnSimpan" class="btn btn-primary">Simpan</button>
                        <span>&nbsp;</span>
                        <button type="button" class="btn btn-warning" id="btnKembali">Kembali</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tabel Master Data Kopi</h3>
                </div>
                <div class="panel-body">
                    <table id="tblProdukKopi" class="display nowrap hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Produk</th>
                                <th>Nama Produk</th>
                                <th>Waktu Penambahan</th>
                                <th>Waktu Update</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>