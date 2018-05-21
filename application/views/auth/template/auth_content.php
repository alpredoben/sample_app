
<div class="container">
    <h3 class="text-center"><?php echo $subtitle; ?></h3>

<?php 
if(isset($pages))
{
    if(isset($dir))
        $this->load->view("$dir/$pages");
    else
        $this->load->view($pages);
}
?>
</div>

