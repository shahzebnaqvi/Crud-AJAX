<?php
include_once("includes/function.php");
$total="";
if(isset($_REQUEST['calculate'])){
$riskvalue="";
    // echo $_REQUEST['annual'];
    // echo $_REQUEST['earningsrate'];
    // echo $_REQUEST['risk'];
    // echo $_REQUEST['paidtoowner'];
    // echo $_REQUEST['noofyear'];
    // echo $_REQUEST['discount'];


    $annual =  $_REQUEST['annual'];
    $earningsrate =  $_REQUEST['earningsrate'];
    $risk = $_REQUEST['risk'];
    $paidtoowner = $_REQUEST['paidtoowner'];
    $noofyear = $_REQUEST['noofyear'];
    $discount = $_REQUEST['discount'];


    if($risk==2){
        $riskvalue="Low";
    }
    else if($risk==3){
        $riskvalue="Average";
    }
    else if($risk==4){
        $riskvalue="Considerable";
    }
    else if($risk==5){
        $riskvalue="High";
    }
    $total=  $annual*$earningsrate*$risk*$paidtoowner *$noofyear*$discount;
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>Preadmin - Bootstrap Admin Template</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
		<link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="bootstrap.min.css" />
        <script src="jquery.min.js"></script>  
        <script src="jquery-ui.js"></script>
    </head>

    <body>
        <div class="main-wrapper">
          <?php include_once("includes/header.php");?>

          <?php include_once("includes/sidebar.php");?>

          <div class="page-wrapper">
            <div class="content container-fluid">
















                <div class="row">

                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <h4 class="card-title">Calculation</h4>
                                    <div class="row">                                    
                                        <form action="" id="myform">

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Annual earnings before interest, taxes, depreciation, and amortization ($)</label>
                                                    <input type="number" name="annual" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Anticipated rate of earnings/compensation growth (0 if level) (0% to 100%)</label>
                                                    <input type="number" name="earningsrate" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Level of business/industry/financial risk
                                                    (Typically restaurants and retail are lower risk than manufacturing and high tech)</label>
                                                    <select class="select" name="risk">
                                                        <option>Select</option>
                                                        <option value="1">None</option>
                                                        <option value="2">Low</option>
                                                        <option value="3">Average</option>
                                                        <option value="4">Considerable</option>
                                                        <option value="5">High</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>"Excess compensation" paid to owners (if any) ($)</label>
                                                    <input type="number" name="paidtoowner" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Number of years earnings are expected to continue
                                                    (maximum 10 which assumes perpetuity) (0 to 10)</label>
                                                    <input type="number" name="noofyear" min="0" max="10" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Discount for lack of marketability (-100% to 100%)</label>
                                                    <input type="number" name="discount" class="form-control" min="-100" max="100" >
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary" name="calculate">Calculate</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    
                                    <div id="msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if($total!=""){  echo'
                <div class="row">
                <div class="col-lg-12">
                <div class="card-box">
                <div class="card-block">
                <table class="table">
                <thead>
                <tr>
                <th>Title</th>
                <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>Annual earnings before interest, taxes, depreciation, and amortization ($)</td>
                <td> '.$annual.'</td>
                </tr>
                <tr>
                <td>Anticipated rate of earnings/compensation growth (0 if level) (0% to 100%)</td>
                <td> '.$earningsrate.'</td>
                </tr>
                <tr>
                <td>Level of business/industry/financial risk
                (Typically restaurants and retail are lower risk than manufacturing and high tech)</td>
                <td> '.$riskvalue.'</td>
                </tr>
                <tr>
                <td>"Excess compensation" paid to owners (if any) ($)</td>
                <td> '.$paidtoowner.'</td>
                </tr>
                <tr>
                <td>Number of years earnings are expected to continue
                (maximum 10 which assumes perpetuity) (0 to 10)</td>
                <td> '.$noofyear.'</td>
                </tr>
                <tr>
                <td>Discount for lack of marketability (-100% to 100%)</td>
                <td> '.$discount.'</td>
                </tr>
                </tbody>
                </table>
                <h3  style="text-align:center">Total  = '.$total.'</h3>

                </div>
                </div>
                </div>
                </div>';


            } ?>
















        </div>


        <?php include_once("includes/notification.php");?>
    </div>
</div>
<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="assets/js/select2.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
</body>

</html>

