<?php
	foreach ($_GET as $key => $value) 
	{
		$_GET[$key]=addslashes(strip_tags(trim($value)));
	}
	if ($_GET['id'] !='') { $_GET['id']=(int) $_GET['id']; }
	extract($_GET);
?>
<?php include "phpscript/security.php";?>
<?php include_once "connections/dbconnect.php";?>
<?php include_once "connections/dbconfig.php";?>
<?php

	session_start();
	if (isset($_SESSION['administrator'])&&($_SESSION['userpass'])){}
	else
	{
		header("Location:index.php");
	}
	include_once 'connections/dbconnect.php';
	$error = false;
?>
<?php
	include("phpscript/timeout.php");
	if (isset($_SESSION['administrator'])&&($_SESSION['userpass']))
	{
		if(isLoginSessionExpired())
		{
		header("Location:logout.php?session_expired=1");
		}
	}	
?>
<?php
	if(isset($_GET['delete_id']))
	{
		// Delete image & file in DB
		$stmt_select = $DB_con->prepare('SELECT locate_icon FROM maplocate WHERE locate_id =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("../icon/".$imgRow['locate_icon']);

		
		// Delete record in DB
		$stmt_delete = $DB_con->prepare('DELETE FROM maplocate WHERE locate_id =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: Location-Area.php");
	}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <link href="css/administratorCSS.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css">
	<link href="css/shCore.css" rel="stylesheet" type="text/css">
	<link href="css/demo.css" rel="stylesheet" type="text/css">
    
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
    <script src="js/responsive-nav.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="js/demo.js"></script>
	<script src="js/jquery.menu-aim.js"></script>
	<script src="js/main.js"></script>
  
	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {$('#example').dataTable();} );
    </script>
       
	<script>
	  function CenterWindow(windowWidth, windowHeight, windowOuterHeight, url, wname, features) {
		var centerLeft = parseInt((window.screen.availWidth - windowWidth) / 2);
		var centerTop = parseInt(((window.screen.availHeight - windowHeight) / 2) - windowOuterHeight);
	 
		var misc_features;
		if (features) {
		  misc_features = ', ' + features;
		}
		else {
		  misc_features = ', status=no, location=no, scrollbars=yes, resizable=yes';
		}
		var windowFeatures = 'width=' + windowWidth + ',height=' + windowHeight + ',left=' + centerLeft + ',top=' + centerTop + misc_features;
		var win = window.open(url, wname, windowFeatures);
		win.focus();
		return win;
 	 }
	</script>
  	
<title>EXO CNX Travel Map by Yuii Napat</title>
</head>
<body>

 <!-- Header -->
<header class="cd-main-header"><?php include "include-header.php"; ?></header>

<main class="cd-main-content">
		
        <!-- Navigation -->
        <div class="cd-side-nav"><?php include "include-menu.php"; ?></div>

		<!-- Main Content -->
        <div class="content-wrapper">
        
        <!-- Header  -->
        <div id="panel-fullarea">
        <div class="panelfooter">
        <div class="panel-title"><font size="+2">Travel Map Location</font></div> 
        </div>
        </div>   
        
   		<!-- Data Table  -->
        <div id="panel-fullarea">
   	    <div class="panelfull">
        <div class="panel-fullheader">
        <div class="panel-icon">
        <a onClick="CenterWindow(1024,768,10,'Location-AreaADD.php',''); " href="javascript:void(0);"><img src="img/icon-add.png" /></a>
        </div>
     	</div> 
               		<div class="page">
					<section>
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th style="text-align:centert">no.</th>
                                <th style="text-align:centert">trip</th>
                                <th style="text-align: center">title</th>
                                <th style="text-align: center">latitude</th>
                                <th style="text-align: center">longitude</th>
                                <th style="text-align: center">URL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?PHP							 
								$n=1;
								$stmt = $DB_con->prepare('SELECT locate_id, locate_province, locate_title, locate_des, locate_Latitude, locate_Longitude, locate_url, locate_icon FROM maplocate ORDER BY locate_id DESC');
								$stmt->execute();	
								if($stmt->rowCount() > 0)
								{
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))
								{
								extract($row);					
							?>
							<tr>
                                 	<td valign="middle"><center><? echo "$n";?></center></td>
                                    <td valign="middle"><? echo $locate_province; ?></td>
                                    <td valign="middle">
									<? echo $locate_title; ?>
                                    <br><font color="#9F9F9F"><? echo $locate_des; ?></font>
                                    </td>                             
                                    <td valign="middle"><? echo $locate_Latitude; ?></td>
                                    <td valign="middle"><? echo $locate_Longitude; ?></td>
                                    <td valign="middle"><? echo $locate_url; ?></td>
                                    <td valign="middle"><center><img src="../icon/<? echo $locate_icon; ?>" alt="" width="24px"/></center></td>  
                                    <td valign="middle"><center><a href="#" onClick="CenterWindow(1024,768,10,'Location-AreaEDIT.php?edit_id=<?php echo $row['locate_id']; ?>',''); " href="javascript:void(0);" title="click for edit" ><img src="img/icon-edit.png" alt="" width="24px"/></a></center></td>
                                    <td valign="middle"><center><a href="Location-EventArea.php?view_id=<?php echo $row['locate_url']; ?>"><img src="img/icon-viewmap.png" alt="" width="24px"/></a></center></td>
                                    <td valign="middle"><center><a onClick="return confirm('Do you want to delete?');" href="?delete_id=<?php echo $row['locate_id']; ?>" onSubmit="return confirm('Do you want to delete?');" title="click for delete"><img src="img/icon-delete.png" alt="" width="24px"/></a>
                              </center></td>
				  			</tr> 
               				<? $n++; } } else { ?>
                   			<? } ?>
                            </tbody>
                        </table>
					</section>
					</div>
        </div>
        </div>
        <!-- End of Data Table  -->     
        
        <!-- Footer -->     
        <div id="panel-fullarea">
        <div class="panelfooter">
        <div class="panel-iconlist"><img src="img/icon-addview.png" alt=""/></div>
        <div class="panel-detail">ADD</div>
        <div class="panel-iconlist"><img src="img/icon-viewmap.png" alt=""/></div>
        <div class="panel-detail">VIEW EVENT LOCATIONS </div> 
        <div class="panel-iconlist"><img src="img/icon-edit.png" alt=""/></div>
        <div class="panel-detail">EDIT</div> 
        <div class="panel-iconlist"><img src="img/icon-delete.png" alt=""/></div>
        <div class="panel-detail">DELETE</div> 
        </div>
        </div>   
        
</div>
</main>
</body>
</html>