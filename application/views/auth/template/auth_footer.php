
<script>
    window.site_url = "<?php echo base_url(); ?>";
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

<?php 
if(isset($scripts)){
    foreach ($scripts as $val) {
?>
        <script type="text/javascript" src="<?php echo site_url($val); ?>"></script>
<?php
    }
}
?>
</html>