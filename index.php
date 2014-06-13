<?php

?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/date-ui.css"/>
    <script src="js/jquery.js" language="JavaScript"></script>
    <script src="js/jquery-ui.min.js" language="JavaScript"></script>
    <script src="js/bootstrap.min.js" language="JavaScript"></script>

    <title> Color Prediction</title>
    <script>
        $(function () {
            $('.date').datepicker({ autoSize: true, dateFormat: 'yy-mm-dd'});

            $('.getPrediction').on('click', function () {
                var bday = $('#b-date').val();
                var pday = $('#p-date').val();
                $.getJSON("Request.php?type=view&bday=" + bday + "&pday=" + pday, function (data) {

                    if (data.status == "ok") {
                        delete data.status;
                        var table = "<table class='table table-responsive table-bordered table-striped' style='font-size: 12px'> " +
                            "<tr><td>Sr. No.</td><td>Birthday</td><td>Prediction Date</td><td>Prediction For</td>" +
                            "<td>Color</td></tr>";
                        var i = 1;
                        $.each(data, function (id, val) {
                            table += "<tr><td>" + i + "</td><td>" + val['b-date'] + "</td><td>" + val['p-date'] + "</td><td>" + val['p-for'] + "</td><td>" +
                                " <div style='width: 20px;height: 20px;background:" + val['hex_code'] + ";border:1px solid #ccc; '></div></td></tr>";
                            i++;
                        });
                        table += "</table>";
                        $('#output').html(table);

                    } else if (data.status == "no") {
                        console.log(data);
                        $('#output').html(data.result).removeClass("alert-success").addClass("alert-danger");
                    } else {
                        $('#output').html("No data");
                    }
                });

            });

            $('.addColor').on('click', function () {
                var color = $('#c-name').val();
                var hex = $('#c_code').val();
                console.log(hex);
                $.getJSON("Request.php?type=add&name=" + color + "&code=" + hex, function (data) {
                    if (data.status == "ok") {

                        $('#color_output').html(data.result).removeClass().addClass("alert alert-success");

                    } else if (data.status == "no") {

                        $('#color_output').html(data.result).removeClass().addClass("alert alert-danger");
                    } else {
                        $('#color_output').html("No data");
                    }
                });

            });

        });
    </script>
</head>
<body>
<div class="navbar navbar-default">
    <div class="container">
        <a class="navbar-brand" href="#">COLOR PREDICTIONS</a>

    </div>
</div>
<div class="container">


    <div class="row">

        <div class="col-md-6 well pull-left">

            <div>
                <table class="table table-responsive">
                    <tr>
                        <td>
                            <input type="text" class="form-control date" id="b-date" placeholder="Your Birthday"/>
                        </td>
                        <td>
                            <input type="text" class="form-control date" id="p-date" placeholder="Prediction Date"/>
                        </td>
                        <td><input type="button" class="btn btn-primary getPrediction" value="Get Prediction"/>
                        </td>
                    </tr>

                </table>

                <div id="output"></div>

            </div>

        </div>

        <div class="col-md-5 well pull-right">

            <div>
                <table class="table table-responsive">
                    <tr>
                        <td>
                            <input type="text" class="form-control" id="c-name" placeholder="Color Name"/>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="c_code" placeholder="Code Code"/>
                        </td>
                        <td><input type="button" class="btn btn-primary addColor" value="Add Color"/>
                        </td>
                    </tr>

                </table>

                <div id="color_output"></div>

            </div>

        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row col-md-5">
        <table class="table table-bordered table-striped">
            <?php
            $db = new mysqli("localhost", "root", "", "color_prediction");
            $qry = $db->query("SELECT * FROM `color_code`");
            $i = 1;
            while ($info = $qry->fetch_assoc()) {
                echo "<tr> <td>$i</td><td><b>" . $info['color_id'] . "</b></td><td><div style='border:1px solid #ccc;width: 100px;height: 40px;background:" . $info['hex_code'] . "'></div></td><td>{$info['code_name']}</td></tr>";
                $i++;
            }
            ?>

        </table>
    </div>

</div>


</body>
</html>