
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<?php 
$szoveg="Belépés";
$link="belepes.php";
if (!empty($_SESSION['id'])) {
    $szoveg="Kilépés";
    $link ="kilepes.php";
}


$menupontok=array('index.php'=>"Főoldal",'ulesrend.php'=>"Ülésrend",$link=>$szoveg);

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<div class="navbar-nav">
<ul class="navbar-nav">
    <?php  
    foreach ($menupontok as $key=>$value){
        $active='';
        if ($_SERVER['REQUEST_URI']=='/teszt/'.$key) $active='active';
        ?>
        <li class="nav-item"<?php echo $active; ?>>
        
        <a class="nav-link"href=<?php echo $key ;?>><?php echo $value ?></a >
        </li>
        <?php
    }
    
            
    ?>



<?php 

?>

</a></li>
</ul>
</div>
</div>
</nav>

