<?php

?>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/date-ui.css" />
    <script src="js/jquery.js" language="JavaScript" ></script>
    <script src="js/jquery-ui.min.js" language="JavaScript" ></script>
<script src="js/bootstrap.min.js" language="JavaScript" ></script>

<title> Color Prediction</title>
    <script>
        $(function(){
           $('.date').datepicker({ autoSize: true, dateFormat: 'yy-mm-dd'});

            $('.getPrediction').on('click',function(){
                var bday=$('#b-date').val();
                var pday=$('#p-date').val();
                $.getJSON("Request.php?bday="+bday+"&pday="+pday,function(data){
                   if(data.status=="ok"){

                    var table="<table class='table table-responsive table-bordered table-striped'> "+
                        "<tr><td>Sr. No.</td><td>Birthday</td><td>Prediction Date</td><td>Prediction For</td>"+
                        "<td>Color</td></tr>";

                       table+="</table>";
                       $('#output').html(table).hide().slideDown();

                   }else if(data.status=="no"){
                       console.log(data);
                       $('#output').html(data.result).removeClass("alert-success").addClass("alert-danger");
                   }else{

                   }
                });

            });
        });
    </script>
</head>
<body>
<div class="navbar navbar-default" >
    <div class="container">
        <a class="navbar-brand" href="#">COLOR PREDICTIONS</a>

    </div>
</div>
<div class="container">


    <div class="row well">

        <div class="col-md-6">

          <div>
              <table class="table table-responsive">
                  <tr>
                  <td>
                          <input type="text" class="form-control date" id="b-date" placeholder="Your Birthday" />
                  </td>
                  <td>
                      <input type="text" class="form-control date" id="p-date" placeholder="Prediction Date" />
                  </td>
                  <td><input type="button" class="btn btn-primary getPrediction" value="Get Prediction" />
                  </td></tr>

              </table>

              <div class="row well" id="output"></div>

          </div>

        </div>


    </div>

    </div>


    <div class="clearfix"></div>



</body>
</html>