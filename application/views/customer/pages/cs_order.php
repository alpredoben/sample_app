<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-primary">Form Customer Identity</h3>
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
            <h3 class="text-success">List Product/Item Available</h3>
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
            <table id="myListTable" class="table table-striped table-hover">
                
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center text-success">NO. PO</th>
                        <th class="text-center text-success">KODE</th>
                        <th class="text-center text-success">NAMA</th>
                        <th class="text-center text-success">JENIS.</th>
                        <th class="text-center text-success">KUANTITAS</th>
                        <th class="text-center text-success">DISKON</th>
                        <th class="text-center text-success">HARGA</th>
                        <th class="text-center text-success">TOTAL HARGA</th>
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

    <div class="clearfix"></div><hr>

    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-info">Your List Order</h3>
            <table id="tblCartListOrder" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center text-info">#</th>
                        <th class="text-center text-info">NO. PO</th>
                        <th class="text-center text-info">KODE</th>
                        <th class="text-center text-info">NAMA</th>
                        <th class="text-center text-info">JENIS</th>
                        <th class="text-center text-info">KUANTITAS</th>
                        <th class="text-center text-info">DISKON</th>
                        <th class="text-center text-info">HARGA</th>
                        <th class="text-center text-info">JUMLAH HARGA</th>
                        <th class="text-center text-info">ACTION</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="8" style="text-align:right">TOTAL HARGA (IDR) :</th>
                        <th></th>
                    </tr>
                </tfoot>

            </table>
        </div>

        <div class="clearfix"></div><br>

        <div class="col-sm-12">
            <form id="frmSubmitOrderProductItem" class="form-inline">
                <div class="col-sm-6">
                    <label class="control-label">Click "Submit Order" To Buy and Approve Order Product Item</label>
                    <button type="button" class="btn btn-primary" id="btnSubmitOrder">Submit Order</button>
                </div>
            </form>
        </div>

    </div>

</div>
