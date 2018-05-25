<!--footer-->
<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
    </div>
</div>

<script>
    window.site_url = "<?php echo base_url(); ?>";
    window.nama_master_item = "<?php echo (isset($nama_item)) ? strtolower($nama_item) : ''; ?>";
</script>

<script src="<?php echo base_url(); ?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/axios/dist/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery-confirm/dist/jquery-confirm.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/dataTable/js/jquery.dataTables.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/web/js/components.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/web/js/adm/admin.js"></script> -->
<?php if(isset($scripts)){ ?> 
<script src="<?php echo base_url().$scripts; ?>"></script>
<?php } ?>