<?php
/**
 * Created by  Rafique
 * Date: 5/23/14
 * Time: 5:42 PM
 */
$db=new mysqli("localhost","root","","color_prediction");

if(isset($_GET['type'])&&!empty($_GET['type'])){
    $type=$_GET['type'];

    switch($type){
        case 'view':
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
            };
            break;
        case 'add':
            $name=$db->real_escape_string($_GET['name']);
            $hex=$db->real_escape_string($_GET['code']);

$qry=$db->query("SELECT * FROM `color_code` WHERE `code_name`='$name' OR `hex_code`='#{$hex}'");
if($qry->num_rows>0){
    $data=array("status"=>"no","result"=>"$name already exist! or ".$db->error);
}else{
              $db->query("INSERT INTO `color_code`(`code_name`,`hex_code`) VALUES('$name','#{$hex}')");


           if($db->affected_rows >0){
               $data=array("status"=>"ok","result"=>"$name successfully added!");
           }else{
               $data=array("status"=>"no","result"=>"Error Occured :  ".$db->error);
           }  
}

            ;
            break;
    }
}

echo json_encode($data);