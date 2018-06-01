<div class="content">
    <div class="row">
        <div class="col-sm-12">

            <form class="form-horizontal" id="frmidentify">
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="txtCompanyName" class="col-sm-4 control-label">Company Name</label>
                        <div class="col-sm-6">
                            <input type="text" id="txtCompanyName" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="areaStreetAddress" class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-6">
                            <textarea id="areaStreetAddress" cols="30" class="form-control"></textarea>
                        </div>

                    </div>
                
                    <div class="form-group">
                        <label for="txtEmail" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" id="txtEmail" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtNumberPhone" class="col-sm-4 control-label">Phone Number</label>
                        <div class="col-sm-6">
                            <input type="text" id="txtNumberPhone" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txtNoBillAccount" class="col-sm-4 control-label">No. Bill Account</label>
                        <div class="col-sm-6">
                            <input type="text" id="txtNoBillAccount" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtDateInvoice" class="col-sm-4 control-label">Date Invoice</label>
                        <div class="col-sm-6">
                            <input type="text" id="txtDateInvoice" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4">
                            <input type="button" value="Set Buyer" class="btn btn-info" id="btnSetBuyer"> &nbsp;
                            <input type="button" value="Reset Buyer" class="btn btn-danger" id="btnResetBuyer">
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <div class="clearfix"></div><br>

    <div class="row">
        <div class="col-sm-12">
            <form>
                <div class="col-sm-2">
                    <label for="optItemCategory">Item Category</label>
                    <select id="optItemCategory" class="form-control">
                        <option value="-">-- Choose Category --</option>
                    </select>
                </div>

                <div class="col-sm-3">
                    <label for="optItemGroup">Item Group Name</label>
                    <select id="optItemGroup" class="form-control">
                        <option value="-">-- Choose Item Group --</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="clearfix"></div><br>

    <div class="row">
        <div class="col-sm-12">
            <table id="myListTable" class="table table-bordered table-striped table-hover">
                
                <thead>
                    <tr>
                        <th></th>
                        <th>NO. PO</th>
                        <th>KODE</th>
                        <th>NAMA</th>
                        <th>JENIS.</th>
                        <th>KUANTITAS</th>
                        <th>DISKON</th>
                        <th>HARGA</th>
                        <th>TOTAL HARGA</th>
                    </tr>
                </thead>

            </table>
        </div>

        <div class="clearfix"></div><br>

        <div class="col-sm-12">
            <form id="frmAddItemList" class="form-inline">
                <div class="col-sm-5">
                    <label class="control-label">Click "Insert Item" To Add List Item Order</label>
                    <button type="button" class="btn btn-success" id="btnInsertItem">Insert Item</button>
                </div>
            </form>
        </div>
    </div>

</div>