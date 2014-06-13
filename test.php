<?php

$color=(isset($_GET['color']))? "#".$_GET['color']: "#FFF";
?>

<div style="height: 50px;width: 50px;background:<?php echo $color;?>;"></div>