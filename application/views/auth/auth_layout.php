<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view($this->config->item("auth_root") . 'template/auth_header'); ?>
</head>

<body>
<?php 
    $this->load->view($this->config->item("auth_root") . 'template/auth_content');
    $this->load->view($this->config->item("auth_root") . 'template/auth_footer');
?>
</body>
</html>