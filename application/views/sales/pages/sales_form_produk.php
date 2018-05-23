<div class="col-md-12">
    <div class="contents">
        <h4 class="text-info">Form Penawaran Produk Kopi</h4>
        <hr>
        <form class="form-horizontal">
            <!-- Left Column -->
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label class="col-md-4 control-label">Produk Kopi</label>
                    <div class="col-md-6">
                        <select id="optionProdukKopi" class="form-control">
                            <option value="-">-- Pilih Kopi --</option>
                        <?php foreach($produk_kopi as $cf){ ?> 
                            <option value="<?php echo $cf['product_id'] ?>"><?php echo $cf['product_name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label">Kuantitas</label>
                    <div class="col-md-4">
                        <input type="text" id="txtKuantitasKopi" class="form-control" placeholder="">
                    </div>
                    <span class="col-md-4 text-danger">pcs</span>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-4 control-label">Harga (IDR)</label>
                    <div class="col-md-6">
                        <input type="text" id="txtHargaKopi" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Diskon (%)</label>
                    <div class="col-md-6">
                        <input type="text" id="txtDiskonKopi" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-4 col-md-4">
                        <button type="button" id="btnSubmitKopi" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tabel Detail Penawaran Kopi</h3>
        </div>
        <div class="panel-body table-responsive">
            <table id="tblPenawaranProduk" class="table table-striped table-hover nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>PRODUK</th>
                        <th>KUANTITAS</th>
                        <th>HARGA (IDR)</th>
                        <th>DISKON</th>
                        <th>STATUS</th>
                        <th>CREATE DATE</th>
                        <th>UPDATE DATE</th>
                        <th>#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>