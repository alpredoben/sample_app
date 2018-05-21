<!DOCTYPE html>
<html>
<head>
<?php
    $this->load->view($this->config->item("admin_root") . 'template/admin_header'); 
?>
</head>

<body>
<?php 
    $this->load->view($this->config->item("admin_root") . 'template/admin_nav');
    $this->load->view($this->config->item("admin_root") . 'template/admin_content');
    $this->load->view($this->config->item("admin_root") . 'template/admin_footer');
?>
</body>
</html>