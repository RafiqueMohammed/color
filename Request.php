<?php
/**
 * Created by  Rafique
 * Date: 5/23/14
 * Time: 5:42 PM
 */
$db=new mysqli("localhost","root","","color_prediction");

if(isset($_GET['bday'],$_GET['pday'])&&!empty($_GET['bday'])){
    $bday=trim($_GET['bday']);
    $pday=trim($_GET['pday']);

$qry= $db->query("SELECT * FROM `predictions` as p INNER JOIN `color_code` as c WHERE p.`color-code`=c.`color_id` AND p.`b-date`='$bday' AND p.`p-date`='$pday'") or die($db->error);

    $data=array();

    if($qry->num_rows>0){
        $data["status"]="ok";

        while($info=$qry->fetch_assoc()){
            $data[]=$info;
        }
    }else{
        $data=array("status"=>"no","result"=>"No predictions are found.");
    }
}else{
    $data=array("status"=>"no","result"=>"Invalid argument passed #3500");
}

echo json_encode($data);