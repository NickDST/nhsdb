<?php include 'requesthubheader.php'; ?>



<div class="content">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-12">
						<div class="card">

							<div class="header">
								<h4 class="title"><strong>Withdraw Requests</strong></h4>
								<p class="category">Please View Your Active Requests</p>
							</div>
							<div class="" style="padding-left:15px; padding-bottom:20px;">
								
								 <?php
            			//$search = mysqli_real_escape_string($connection, $_POST['search']);
            			$sql = "SELECT * FROM request WHERE request_username = '$username' AND status = 'inactive' ORDER BY datetime_start";

            			$result = mysqli_query($connection, $sql);
            			$queryResult = mysqli_num_rows($result);

            			echo "You have ".$queryResult. " tutoring event(s) <hr>";


            			if ($queryResult > 0) {
            				while ($row = mysqli_fetch_assoc($result)) {
            					echo "

            					<div>
            					<h3>".$row['requestee']."</h3>
            					<p>".$row['datetime_start']."</p>
            					<p>".$row['datetime_end']."</p>
            					</div>
								<p>".$row['subject']."</p>
            					<a href = 'withdrawrequest2.php?name=".$row['requestee']."&startdate=".$row['datetime_start']."&id=".$row['requestid']."'>More Info
            					</a>
            					<hr>";

								
            				}

            			} else {
            				echo "Nothing Here";
            			}


            		?>

								
								
								
								
								
							
							</div>
						</div>
					</div>
				
							</div>
						</div>
					</div>