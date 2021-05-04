<?php
require("lib/core.php");
require("functions/login_functions.php");
require("functions/checkLogState.php");

checkLogState();

// $gvar = $_SESSION['usertype'];
// $sessID = $_SESSION['userid'];
// echo "<script>console.log( 'usertype: " . $gvar . "' ) 
//               console.log( 'userid: " . $sessID . "' );</script>";

?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="image/iconic.ico">
<title>Alphalab Records Management System</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Stylesheet/CSS -->
<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- LOCAL FILES -->
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrapv3.3.7.min.css"> -->

<link rel="stylesheet" type="text/css" href="css/custom.css">

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- LOCAL FILES -->
<!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> -->

<script src="js/jQuery-2.1.1.min.js" type="text/javascript"></script>
<!-- <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script> -->

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-3.3.7.min.js" type="text/javascript"></script> 

<script type="text/javascript" src="js/sammy.min.js" ></script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<script type="text/javascript" src="js/sweetalert2.all.min.js" ></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- LOCAL FILES -->
<!-- <link rel="stylesheet" type="text/css" href="css/jquery-ui.css.css"> -->

<script type="text/javascript" src="js/jquery-ui.js"></script>
<!-- <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<script type="text/javascript" src="js/countTo.min.js"></script>

<!-- <script type="text/javascript" src="js/countUp.min.js"></script> -->
<!-- <script type="text/javascript" src="
https://raw.githubusercontent.com/inorganik/countUp.js/master/dist/countUp.js"></script> -->


</head>
<body class="cont">

<div class="nav-side-menu">
    <div class="brand">ALPHALAB RMS</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
    <div class="menu-list" id="menu-list">
        <!-- DASHBOARD -->
        <ul id="menu-content" class="menu-content collapse out">
            
            <li id="dashboard" data-toggle="collapse" data-target="#dashboard_submenu" class="collapsed">
              <a href="#/dashboard_samp_monitoring" id="dashboard_samp_monitoring"><i class="fa fa-dashboard fa-lg"></i> Dashboard <span class="arrow"></span></a>
            </li>

            <ul class="sub-menu collapse" id="dashboard_submenu">
               
                <li <?php if($_SESSION['usertype'] == 'LAB-CHEM-HEAD'  ||
                             $_SESSION['usertype'] == 'LAB-CHEM-USER'  || 
                             $_SESSION['usertype'] == 'LAB-MICRO-USER'  || 
                             $_SESSION['usertype'] == 'USER-ACCOUNTING')  
                             echo 'style="display:none"';?>>
                  <a href="#/dashboard_micro" id="dashboard_micro">Microbiological</a></li>


                <li <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD' ||
                             $_SESSION['usertype'] == 'LAB-CHEM-USER'  || 
                             $_SESSION['usertype'] == 'LAB-MICRO-USER'  || 
                             $_SESSION['usertype'] == 'USER-ACCOUNTING')  
                             echo 'style="display:none"';?>>
                  <a href="#/dashboard_pchem" id="dashboard_pchem">PhysicoChemical & Waste</a></li>

                <li <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD' || 
                             $_SESSION['usertype'] == 'LAB-CHEM-HEAD'  ||
                             $_SESSION['usertype'] == 'LAB-CHEM-USER'  || 
                             $_SESSION['usertype'] == 'LAB-MICRO-USER' || 
                             $_SESSION['usertype'] == 'USER-ACCOUNTING')
                             echo 'style="display:none"';?>>
                  <a href="#/dashboard_fsa" id="dashboard_fsa">Field Service Asst.</a></li>

                <li <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD' || 
                             $_SESSION['usertype'] == 'LAB-CHEM-HEAD'  ||
                             $_SESSION['usertype'] == 'LAB-CHEM-USER'  || 
                             $_SESSION['usertype'] == 'LAB-MICRO-USER'  || 
                             $_SESSION['usertype'] == 'USER-ACCOUNTING') 
                             echo 'style="display:none"';?>>
                  <a href="#/dashboard_clients" id="dashboard_clients">Clients</a></li>
            </ul>
            <!-- VIEW RECORDS -->
            
            <li id="viewRecords_" data-toggle="collapse" data-target="#subMenu_rwt" class="collapsed">
              <a href="#/viewRecords" id="viewRecords">
              <i class="fa fa-table fa-lg"></i> View Records <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="subMenu_rwt">
                <li><a href="#/viewRwtRwwt">View by Rwt/Rwwt</a></li>
            </ul>

            <!-- CLIENTS DATA -->
            <li <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD' || 
                         $_SESSION['usertype'] == 'LAB-CHEM-HEAD'  || 
                         $_SESSION['usertype'] == 'LAB-MICRO-USER' || 
                         $_SESSION['usertype'] == 'LAB-CHEM-USER'  || 
                         $_SESSION['usertype'] == 'USER-MANAGER'  || 
                         $_SESSION['usertype'] == 'USER-ACCOUNTING') 
                         echo 'style="display:none"';?>>
              <a href="#/clientsData" id="clientsData">
              <i class="fa fa-tasks fa-lg"></i> Clients Data
              </a>
            </li>
            <!-- MICRO -->
             <li id="microData_" data-toggle="collapse" data-target="#TRsubMenu_micro" class="collapsed" <?php if(       $_SESSION['usertype'] == 'LAB-CHEM-HEAD'  || 
                      $_SESSION['usertype'] == 'LAB-CHEM-USER'  || 
                      $_SESSION['usertype'] == 'USER-MANAGER'  || 
                      $_SESSION['usertype'] == 'USER-ACCOUNTING') 
                                 echo 'style="display:none"';?>>
              <a><i class="fa fa-list-alt fa-lg"></i> Microbiological <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="TRsubMenu_micro">
                <li><a href="#/microData">Potable</a></li>
                <li><a href="#/microWasteData">Non-Potable(waste)</a></li>
            </ul>
            <!-- PCHEM-WASTE -->
            <li <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD'  || 
                         $_SESSION['usertype'] == 'LAB-MICRO-USER'  || 
                         $_SESSION['usertype'] == 'USER-MANAGER'   || 
                         $_SESSION['usertype'] == 'USER-ACCOUNTING')
                         echo 'style="display:none"';?>>
              <a href="#/pchemWasteData" id="pchemWasteData">
              <i class="fa fa-flask"></i> PhysicoChemical & Waste
              </a>
            </li>
            <!-- REPORTS -->
            <li id="reports_" data-toggle="collapse" data-target="#TRsubMenu_reports" class="collapsed"     <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD' || 
                          $_SESSION['usertype'] == 'LAB-CHEM-HEAD'  || 
                          $_SESSION['usertype'] == 'LAB-MICRO-USER' || 
                          $_SESSION['usertype'] == 'LAB-CHEM-USER')
                          echo 'style="display:none"';?>>
              <a><i class="fa fa-file-excel-o"></i> Reporting <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="TRsubMenu_reports">
                <li><a href="#/reportMicro">Micro</a></li>
                <li><a href="#/reportPChemWaste">PChem / Waste</a></li>
                <li><a href="#/reportRwtMonitoring">Rwt Monitoring</a></li>
                <li><a href="#/masterList">Masterlist</a></li>
                <!-- <li><a href="#/dataSumm">Data Summary</a></li> -->
            </ul>
            <!-- USER ACCOUNTS -->
            <li id="useraccount_" data-toggle="collapse" data-target="#subMenu_useraccount" class="collapsed"     <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD' || 
                          $_SESSION['usertype'] == 'LAB-CHEM-HEAD'  || 
                          $_SESSION['usertype'] == 'LAB-MICRO-USER' || 
                          $_SESSION['usertype'] == 'LAB-CHEM-USER'  || 
                          $_SESSION['usertype'] == 'USER-MANAGER'   || 
                          $_SESSION['usertype'] == 'USER-ACCOUNTING'|| 
                          $_SESSION['usertype'] == 'USER-DES')
                          echo 'style="display:none"';?>>
              <a href="#/userAccount" id="userAccount">
              <i class="fa fa-users" aria-hidden="true"></i> User Accounts <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="subMenu_useraccount">
                <li><a href="#/rec_analyst">Analyst List</a></li>
                <li><a href="#/rec_fsa">FSA List</a></li>
                <li><a href="#/userlog">Users Login History</a></li>
            </ul>

            <!-- LOGOUT -->
            <li>
              <a href="logout.php" id="viewRecords">
              <i class="glyphicon glyphicon-log-out"></i> Logout
              </a>
            </li>
        </ul>
 </div>
</div>


<!-- Start Navigator -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#/"></a>
    </div>
          
<a href="#/" class="cos navbar-brand navbar-right"> <span id="date_time"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $_SESSION['usertype'];?>&nbsp;&nbsp;&nbsp;&nbsp;</a>
</div>
</nav>
<!-- End Navigator -->

<div id="content"></div> <!-- BASE CONTAINER -->

<script type="text/javascript" src="script/check_session.js"></script>

    <script type="text/javascript">

// active nav bar 
  $( '#menu-list .menu-content a' ).on( 'click', function () {
    $( '#menu-list .menu-content' ).find( 'li.active' ).removeClass( 'active' );
    $( this ).parent( 'li' ).addClass( 'active' );
  });
// active nav bar end

//Start of Sammy Scripts
        (function ($) {

            var app = $.sammy('#content', function () {
                
                this.debug = true;     
               
                this.get('#/', function () {
                    this.app.swap('');
                });
                 this.get('#/redirect', function () {
                    this.redirect('#/');
                });
                 this.get('#/dashboard_samp_monitoring', function () {
                    check_session();
                    this.partial('templates/dashboard_samp_monitoring.html');
                });
                this.get('#/dashboard_micro', function () {
                    check_session();
                    this.partial('templates/dashboard_micro.html');
                });
                this.get('#/dashboard_pchem', function () {
                    check_session();
                    this.partial('templates/dashboard_pchem.html');
                });
                this.get('#/dashboard_fsa', function () {
                    check_session();
                    this.partial('templates/dashboard_fsa.html');
                });
                this.get('#/dashboard_clients', function () {
                    check_session();
                    this.partial('templates/dashboard_clients.html');
                });
                this.get('#/viewRecords', function ()  {
                    check_session();
                    this.partial('templates/viewRecords.html');
                });
                this.get('#/viewRwtRwwt', function () {
                    check_session();
                    this.partial('templates/viewRwtRwwt.html');
                });           
                this.post('#viewRwtRwwt', function() {        // note: if return false; no need to post
                    this.redirect('#/viewRwtRwwt');
                });  
                this.get('#/clientsData', function () {
                    check_session();
                    this.partial('templates/clientsData.html');
                });
                 this.get('#/microData', function () {
                    check_session();
                    this.partial('templates/microData.php');
                });
                 this.post('#microData', function() {        // note: if return false; no need to post
                    this.redirect('#/microData');
                });
                 this.get('#/microWasteData', function () {
                    check_session();
                    this.partial('templates/microWasteData.php');
                });
                 this.post('#microWasteData', function() {        // note: if return false; no need to post
                    this.redirect('#/microWasteData');
                });  
                 this.get('#/pchemWasteData', function () {
                    check_session();
                    this.partial('templates/pchemWasteData.php');
                });
                 this.post('#pchemWasteData', function() {        // note: if return false; no need to post
                    this.redirect('#/pchemWasteData');
                });
                 this.get('#/reportMicro', function () {
                    check_session();
                    this.partial('templates/reportMicro.html');
                });
                 this.get('#/reportPChemWaste', function () {
                    check_session();
                    this.partial('templates/reportPChemWaste.html');
                });
                 this.get('#/reportRwtMonitoring', function () {
                    check_session();
                    this.partial('templates/reportRwtMonitoring.html');
                });
                 this.get('#/masterList', function () {
                    check_session();
                    this.partial('templates/masterList.html');
                });
                 this.get('#/dataSumm', function () {
                    check_session();
                    this.partial('templates/dataSumm.html');
                });
                this.get('#/userAccount', function () {
                    check_session();
                    this.partial('templates/userAccount.html');
                });           
                this.post('#userAccount', function() {        // note: if return false; no need to post
                    this.redirect('#/userAccount');
                });  
                this.get('#/userlog', function () {
                    check_session();
                    this.partial('templates/userlog.html');
                });           
                this.post('#userlog', function() {        // note: if return false; no need to post
                    this.redirect('#/userlog');
                });  
                this.get('#/rec_analyst', function () {
                    check_session();
                    this.partial('templates/rec_analyst.html');
                });           
                this.post('#rec_analyst', function() {        // note: if return false; no need to post
                    this.redirect('#/rec_analyst');
                }); 
                this.get('#/rec_fsa', function () {
                    check_session();
                    this.partial('templates/rec_fsa.html');
                });           
                this.post('#rec_fsa', function() {        // note: if return false; no need to post
                    this.redirect('#/rec_fsa');
                });   
            
            });

            $(function () {
                app.run('#/dashboard_samp_monitoring');
            });
        })(jQuery);

    </script>

<!-- End of Scripts -->
<script type="text/javascript" src="script/client.js"></script>
<script type="text/javascript" src="script/testrequest.js"></script> 
   
<!-- <script src="js/Chart.min.js"></script> -->
<script src="js/chart-2.7.3.min.js"></script>
<script src="js/chartjs-plugin-datalabels-0.7.0.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script> -->
<script type="text/javascript" src="script/datepickerFromTo.js"></script>
<script type="text/javascript" src="script/date_time.js"></script>
<script type="text/javascript">window.onload = date_time('date_time');</script>
<!-- <script src="script/dataGraph/numParam.js"></script>
<script src="script/dataGraph/microAnalyst.js"></script> -->

<!-- <script src="script/dataGraph/pwAnalyst.js"></script>
<script src="script/dataGraph/searchAnalyst.js"></script> -->

<!-- <script type="text/javascript" src="script/microresult.js"></script> -->
<!-- <script type="text/javascript" src="script/pchemresult.js"></script>
<script type="text/javascript" src="script/wasteresult.js"></script>
 -->

</body>
</html>