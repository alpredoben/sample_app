<div class="content-row">
    <div class="row">
        <div class="col-md-12">
            <div class="contents">
                <h4 class="text-info">Form Data Mesin</h4>
                <hr>
                <form class="inline">
                    <div class="col-md-4">
                        <label for="">ID Mesin</label>
                        <input type="text" id="txtIDMesin" class="form-control" placeholder="Unik ID Mesin">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="">Nama Mesin</label>
                        <input type="text" id="txtNamaMesin" class="form-control" placeholder="Nama Mesin">
                    </div>

                    <div class="col-md-4" style="margin-top:24px; margin-left:-5px;">
                        <button type="button" id="btnSimpanMesin" class="btn btn-primary">Simpan</button>
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
                    <h3 class="panel-title">Tabel Master Data Mesin</h3>
                </div>
                <div class="panel-body">
                    <table id="tblDataMesin" class="display nowrap hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Mesin</th>
                                <th>Nama Mesin</th>
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