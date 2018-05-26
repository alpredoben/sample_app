<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <div class="contents">
                <h4 class="text-info">FORM MASTER <?php echo $nama_item ?></h4>
                <hr>
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
        </div>
    </div>

    <div class="clearfix"></div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tabel Master <?php echo $nama_item ?> </h3>
                </div>
                <div class="panel-body">
                    <table id="tblMasterItem" class="display nowrap hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode <?php echo $nama_item ?></th>
                                <th>Nama <?php echo $nama_item ?></th>
                                <th>Create Date</th>
                                <th>Update Date</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>