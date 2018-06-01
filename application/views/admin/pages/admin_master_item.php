<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Form, Tabel Informasi - Master <?php echo $nama_item; ?></h3>
                </div>

                <div class="panel-body">

                    <div class="col-md-12">
                        <form class="inline">
                            <div class="col-md-2">
                                <label for="">Kode <?php echo $nama_item ?></label>
                                <input type="text" id="txtKodeItem" class="form-control" placeholder="">
                            </div>
                            
                            <div class="col-md-3">
                                <label for="">Nama <?php echo $nama_item ?></label>
                                <input type="text" id="txtNamaItem" class="form-control" placeholder="">
                            </div>

                            <div class="col-md-3" style="margin-top:24px; margin-left:-5px;">
                                <button type="button" id="btnSimpanItem" class="btn btn-primary">Simpan</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-warning" id="btnKembali">Kembali</button>
                            </div>
                        </form>
                    </div>

                    <div class="clearfix"></div>
                    <br>

                    <div class="col-md-12">
                        <table id="tblMasterItem" class=" nowrap row-border compact text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Kode <?php echo $nama_item ?></th>
                                    <th class="text-center">Nama <?php echo $nama_item ?></th>
                                    <th class="text-center">Create Date</th>
                                    <th class="text-center">Update Date</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</div>