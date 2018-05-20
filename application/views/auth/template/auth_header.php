<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" href=""/>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

<?php 
if(isset($styles)) { 
    foreach ($styles as $val) {
?>
        <link rel="stylesheet" href="<?php echo site_url($val); ?>">
<?php 
    }        
}
?>
</head>
