<h5>
    <ul class="cd-navigation cd-single-item-wrapper">
			<li><a href="Home"><h2>EXO CNX</h2></a></li>
   	</ul>
    
    <ul class="cd-navigation">
		<li class="item-has-children"><a href="#">Travel Location</a>
        	<ul class="sub-menu">
            <?php							 
			$stmt = $DB_con->prepare('SELECT locate_id, locate_province, locate_title, locate_des, locate_Latitude, locate_Longitude, locate_url, locate_icon FROM maplocate ORDER BY locate_id DESC');
			$stmt->execute();	
			if($stmt->rowCount() > 0)
				{
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
				extract($row);					
			?>
            <li><a href="<?php echo $row['locate_url'];?>"><?php echo $locate_province; ?></a></li>
                                <?php } } else { ?>
			<?php } ?> 
			</ul>
	</ul>
    
 	<ul class="cd-navigation cd-single-item-wrapper">
        <li><a href="#"><font color="#C0FF00">E-mail : <font color="#FFFFFF">Napat@exotravel.com</font></a></li>
        <li><a href="#"><font color="#7C7C7C" size="-0.5">COPYRIGHT © 2017 EXO CNX by Napat Natawaluck. ALL RIGHTS RESERVED.</font></a></li>
	</ul>
    </h5>