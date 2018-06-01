<!DOCTYPE html>
<html>
<head>
<?php
    $this->load->view($this->config->item("customer_root") . 'template/customer_header'); 
?>
</head>

<body>
<?php 
    $this->load->view($this->config->item("customer_root") . 'template/customer_nav');
    $this->load->view($this->config->item("customer_root") . 'template/customer_content');
    $this->load->view($this->config->item("customer_root") . 'template/customer_footer');
?>
</body>
</html>