<div class="col-md-12">
    <div class="contents">
        <h4 class="text-info"><?php $title_table_order ?></h4>
        <hr>
        <form class="form-horizontal">
            <!-- Left Column -->
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label class="col-md-4 control-label">Nama Item</label>
                    <div class="col-md-6">
                        <select id="optionItemName" class="form-control">
                            <option value="-">-- Pilih Item --</option>
                            <?php foreach($data_items as $cf){ ?> 
                                <option value="<?php echo $cf['kode_item'] ?>"><?php echo $cf['nama_item'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label">Kuantitas</label>
                    <div class="col-md-4">
                        <input type="text" id="txtKuantitasItem" class="form-control" placeholder="">
                    </div>
                    <span class="col-md-4 text-danger">pcs</span>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-4 control-label">Harga (IDR)</label>
                    <div class="col-md-6">
                        <input type="text" id="txtHargaItem" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Diskon (%)</label>
                    <div class="col-md-6">
                        <input type="text" id="txtDiskonItem" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-4 col-md-4">
                        <button type="button" id="btnSubmitItem" class="btn btn-info">Submit</button>
                        <button type="button" id="btnKembali" class="btn btn-warning">Kembali</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title_form_order; ?></h3>
        </div>
        <div class="panel-body table-responsive">
            <table id="tblMasterPenawaran" class="table table-striped table-hover nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>KODE ITEM</th>
                        <th>NAMA ITEM</th>
                        <th>KUANTITAS</th>
                        <th>HARGA (IDR)</th>
                        <th>DISKON</th>
                        <th>AKTIFASI</th>
                        <th>KATEGORI</th>
                        <th>CREATE DATE</th>
                        <th>UPDATE DATE</th>
                        <th>#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
