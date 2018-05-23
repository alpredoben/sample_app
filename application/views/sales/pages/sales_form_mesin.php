<div class="col-md-12">
    <div class="contents">
        <h4 class="text-info">Form Penawaran Mesin</h4>
        <hr>
        <form class="form-horizontal">
            <!-- Left Column -->
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label class="col-md-4 control-label">Mesin</label>
                    <div class="col-md-6">
                        <select id="optionMesin" class="form-control">
                            <option value="-">-- Pilih Mesin --</option>
                        <?php foreach($daftar_mesin as $cf){ ?> 
                            <option value="<?php echo $cf['machine_id'] ?>"><?php echo $cf['machine_name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label">Kuantitas</label>
                    <div class="col-md-4">
                        <input type="text" id="txtKuantitasMesin" class="form-control" placeholder="">
                    </div>
                    <span class="col-md-4 text-danger">pcs</span>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-4 control-label">Harga (IDR)</label>
                    <div class="col-md-6">
                        <input type="text" id="txtHargaMesin" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Diskon (%)</label>
                    <div class="col-md-6">
                        <input type="text" id="txtDiskonMesin" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-4 col-md-4">
                        <button type="button" id="btnSubmitMesin" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tabel Detail Penawaran Mesin</h3>
        </div>
        <div class="panel-body">
            <table id="tblPenawaranMesin" class="display nowrap hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>MESIN</th>
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