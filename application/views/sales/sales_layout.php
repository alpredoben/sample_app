<!DOCTYPE html>
<html>
<head>
<?php
    $this->load->view($this->config->item("sales_root") . 'template/sales_header'); 
?>
</head>

<body>
<?php 
    $this->load->view($this->config->item("sales_root") . 'template/sales_nav');
    $this->load->view($this->config->item("sales_root") . 'template/sales_content');
    $this->load->view($this->config->item("sales_root") . 'template/sales_footer');
?>
</body>
</html>