<!--header-->
<div class="container-fluid cover_flow">
    <!--documents-->
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-2 sidebar-offcanvas" role="navigation">
            <?php if(isset($side_nav)) $this->load->view($side_nav); ?>
        </div>

        <div class="col-xs-12 col-sm-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo $subtitle; ?>
                    </h3>
                </div>

                <div class="panel-body">
                    <?php if(isset($content)) $this->load->view($content); ?>
                </div>
            </div>
        </div>
    </div>
</div>
