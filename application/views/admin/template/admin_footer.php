<!--footer-->
<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
    </div>
</div>

<script>
    window.site_url = "<?php echo base_url(); ?>";
    window.state_active = "<?php echo (isset($active_)) ? $active_ : '' ?>";
</script>

<script src="<?php echo base_url(); ?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/axios/dist/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery-confirm/dist/jquery-confirm.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/dataTable/js/jquery.dataTables.min.js"></script> 

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script> -->


<script src="<?php echo base_url(); ?>assets/web/js/components.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/item/admin.js"></script>