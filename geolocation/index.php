<?php require_once('Connections/dbconfig.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>EXO CNX TravelMap-Location</title>

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <link rel="stylesheet" href="css/patternCSS.css"> <!-- Pattern style -->

	<script src="js/modernizr.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en"></script>
    <script src="js/gmap3.js"></script> 
	<script src="js/main.js"></script>
    <script type="text/javascript">
		window.onload = function(){
		var heights = window.innerHeight;
		document.getElementById("map").style.height = heights + "px";}
	</script>
</head>

<body>
	<header>
    <?php include "include-header.php" ?>
	</header>
    <main class="cd-main-content">    
	<div id="googlemaps"></div>

    </main>
    <script type="text/javascript">
    $(function ()
        { 
            $('#googlemaps').gmap3(
                { map: 
                    { options: 
                        {
					<?php 
		            $stmt = $DB_con->prepare('SELECT location_id, Latitude, Longitude, Zoom FROM location ORDER BY location_id DESC LIMIT 0, 1' );
		            $stmt->execute();	
								if($stmt->rowCount() > 0)
								{
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))
								{
								extract($row);					
		            ?> 
                        center: [<?php echo $Latitude; ?>,<?php echo $Longitude; ?>], // MAIN LOCATION
                        zoom: <?php echo $Zoom; ?>, // LOCATION ZOOM
						
		       <?  } } else { ?><? } ?>    

                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: true,
                        mapTypeControlOptions: 
                            {
                                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                            },
                        }
                    },
                    marker: {
                    values: [
	               
                    <?php 
		              $stmt = $DB_con->prepare('SELECT locate_id, locate_province, locate_title, locate_des, locate_Latitude, locate_Longitude, locate_url, locate_icon FROM maplocate' );
		              $stmt->execute();	
		              if($stmt->rowCount() > 0)
		              { 
		                  while($row=$stmt->fetch(PDO::FETCH_ASSOC)) 
		                  { 
			                ++$i;
		                    $i != $num ? $k=',' : $k='';
		                    extract($row);					
		            ?> 

                    {latLng:[<?php echo $row[locate_Latitude]?>, <?php echo $row[locate_Longitude]?>], data:"<h4><?php echo $row['locate_title']?></h4><?php echo $row['locate_des']?><br><a href='<?php echo $row['locate_url']?>'>View All...</a>", options:{icon: "icon/<?php echo $row[locate_icon]?>"}}<?php echo $k?>

		  	        <?  } } else { ?><? } ?>    
                    ],
                    
                    events: {
                        mouseover: function (marker, event, context) {
                            var map = $(this).gmap3("get"),
                                infowindow = $(this).gmap3({
                                    get: {
                                        name: "infowindow"
                                    }
                                });
                            if (infowindow) {
                                infowindow.open(map, marker);
                                infowindow.setContent(context.data);
                            } else {
                                $(this).gmap3({
                                    infowindow: {
                                        anchor: marker,
                                        options: {
                                            content: context.data
                                        }
                                    }
                                });
                            }
                        },
                        closeclick: function () {
                            infowindow.close();
                        },
                        mouseout: function () {
                            var infowindow = $(this).gmap3({
                                get: {
                                    name: "infowindow"
                                }
                            });
                        }
                    }
                }
            });
        });
    </script>

 	<nav id="cd-lateral-nav">
  	<?php include "include-menu.php" ?>    
	</nav>
</body>
</html>