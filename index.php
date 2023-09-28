<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand">Salisu Idris</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">PHP - Simple Grade Calculator</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add student</button>
		<br /><br />
		<table class="table table-bordered">
			<thead class="alert-info">
				<tr>
					<th>Name</th>
					<th>Math</th>
					<th>English</th>
					<th>Chemistry</th>
					<th>Final Grade</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require 'conn.php';
					
					$query = mysqli_query($conn, "SELECT * FROM `student`") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
					
					$final = ($fetch['prelim'] + $fetch['midterm'] + $fetch['endterm']) / 3;
				?>
				<tr>
					<td><?php echo $fetch['name']?></td>
					<td><?php echo $fetch['prelim']?></td>
					<td><?php echo $fetch['midterm']?></td>
					<td><?php echo $fetch['endterm']?></td>
					<td><?php echo filter_var($final, FILTER_VALIDATE_INT) == false ? number_format($final,2) : number_format($final) ?></td>
					<?php
						if($final >=75){
							echo "<td style='background-color:green; color:#fff;'>Pass</td>";
						}else if($final < 75){
							echo "<td style='background-color:red; color:#fff;'>Fail</td>";
						}
					?>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
<div class="modal fade" id="form_modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="save_student.php">
				<div class="modal-header">
					<h3 class="modal-title">Add Student</h3>
				</div>
				<div class="modal-body">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" required="required"/>
						</div>
						<div class="form-group">
							<label>Math</label>
							<input type="number" min="0" max="100" class="form-control" name="prelim" required="required"/>
						</div>
						<div class="form-group">
							<label>English</label>
							<input type="number" min="0" max="100" class="form-control" name="midterm" required="required"/>
						</div>
						<div class="form-group">
							<label>Chemistry</label>
							<input type="number" min="0" max="100" class="form-control" name="endterm" required="required"/>
						</div>
					</div>
				</div>
				<br style="clear:both;"/>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Close</button>
					<button class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> save</button>
				</div>
			</form>
		</div>
	</div>
</div>	
<script src="js/jquery-3.2.1.min.js"></script>	
<script src="js/bootstrap.js"></script>	
</body>	
</html>
