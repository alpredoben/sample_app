<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <div class="contents">
                <h4 class="text-info">Form Data Sparepart</h4>
                <hr>
                <form class="inline">
                    <div class="col-md-4">
                        <label for="">ID Sparepart</label>
                        <input type="text" id="txtIDSparepart" class="form-control" placeholder="Unik ID Sparepart">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="">Nama Sparepart</label>
                        <input type="text" id="txtNamaSparepart" class="form-control" placeholder="Nama Sparepart">
                    </div>

                    <div class="col-md-4" style="margin-top:24px; margin-left:-5px;">
                        <button type="button" id="btnSimpanSparepart" class="btn btn-primary">Simpan</button>
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
                    <h3 class="panel-title">Tabel Master Data Sparepart</h3>
                </div>
                <div class="panel-body">
                    <table id="tblDataSparepart" class="display nowrap hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Sparepart</th>
                                <th>Nama Sparepart</th>
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