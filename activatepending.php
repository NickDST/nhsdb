<?php

include 'hubheader.php';
?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Activate Pending</title>
</head>

<body>
	

	 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h2 class="title">Activate Pending</h2>
								<br>
                                <p class="category">This is where your pending tutor requests will be shown</p>
								<br>
                            </div>
                            <div class = "" style= "padding-left:15px;">
               
	<div class = "article-container">
		
		<?php
			//$search = mysqli_real_escape_string($connection, $_POST['search']);
			$sql = "SELECT * FROM request WHERE datetime_start > NOW() AND studentid = '$id' ORDER BY datetime_start";
			
			$result = mysqli_query($connection, $sql);
			$queryResult = mysqli_num_rows($result);
			
			echo "You have ".$queryResult. " pending requests <hr>";
			
			
			if ($queryResult > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "
					
					<div>
					<h3>".$row['requestee']."</h3>
					<p>".$row['datetime_start']."</p>
					<p>".$row['datetime_end']."</p>
					</div>
					<a href = 'confirmpending.php?name=".$row['requestee']."&startdate=".$row['datetime_start']."&id=".$row['requestid']."'>More Info
					</a>
					<hr>";
					
				}
				
			} else {
				echo "You will be emailed when there is a request.";
			}
		
		
		?>
		        </div>
                        </div>
                    </div>
	
	</div>
	</div>
				</div>
		 </div>
	
</body>
</html>












