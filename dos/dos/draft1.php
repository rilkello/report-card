<?php
include "config/db.php";
include "header.php";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "regg";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
?>
<style>
hr{
	width:90%;
}
</style>
</head>
<body>
<?php include 'nav.php' ?>

<div class="form-container" style="background-color:#1266f1;">
<!-- <div class="table table table-hover text-center" style="margin-left:5%;width:90%;padding:10px;border-radius:10px;"> -->
<form action="dashboard.php" method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="served_by" name="served_by" value="<?php echo $session_id; ?>" onkeydown="return false">
<div class="row mb-2">
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="typofass" name="typofass" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">Typofass</option>
			<?php
			$sql ="SELECT * FROM assessments";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["typofass"]; ?>"> <?php echo $row["typofass"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="date" name="date" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">date</option>
			<?php
			$sql ="SELECT * FROM assessments";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["date"]; ?>"> <?php echo $row["date"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">class</option>
			<?php
			$sql ="SELECT * FROM class";
			$result = $conn->query($sql);
			if( mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
		?>
			<option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
		<?php }} ?>
			</select>
		</div>
		<div class="col-sm">
		<!--<label for="recipient-name" class="col-sm-form-label">Position:</label>-->
		
			<select class="form-select form-select-sm" aria-label=".form-select-md example" id="level" name="level" required style="width:100%;height:30px;;border-radius:0%;background:lightgray;color:darkgray;">
            <option selected value="" style = "color:lightgray;">level</option>
			<?php
			   $sql ="SELECT * FROM level";
			   $result = $conn->query($sql);
			   if( mysqli_num_rows($result)>0){
			   while($row = mysqli_fetch_assoc($result)){
		   ?>
			   <option value="<?php echo $row["level"]; ?>"> <?php echo $row["level"]; ?> </option>
		   <?php }} ?>
			</select>
		</div>	
		<div class="col-sm">
		    <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;">Filter</button>
	   </div>	
</div>
</form>
<table id="pager" class="table table table-hover text-center" cellspacing="0" style="align:center;border-radius:10px;margin-left:100px;margin-right:10px;">
  <thead class="table thead-dark">
    <tr>
	<th scope="col">Number</th>
                                <th scope="col">Student's name</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Actions</th>
	  </tr>
  </thead>
  <tbody style="background-color:lightgray;">

<?php
$limit = 5;
include ('config/db.php');
$getQuery = " SELECT * from marks ";
$result = mysqli_query ( $conn, $getQuery);
$total_rows =  mysqli_num_rows($result);
$total_pages = ceil($total_rows / $limit);
if(!isset($_GET['page'])){
	$page_number = 1; 
}
else{
	$page_number = $_GET['page'];
}
$initial_page = ( $page_number - 1 ) * $limit ;
if (isset($_POST['submit']) && isset($_POST['typofass']) && isset($_POST['date']) && isset($_POST['class']) && isset($_POST['level']) ){
	$typofass = $_POST['typofass'];
	$date = $_POST['date'];  
	$class = $_POST['class'];
	$level = $_POST['level'];

	$getQuery = "  SELECT marks.id , marks.fname , marks.lname , marks.date , marks.assname , marks.outof , marks.value ,marks.typofass, marks.class  from marks JOIN assessments ON assessments.typofass = marks.typofass AND assessments.date = marks.date JOIN class ON class.class = marks.class  JOIN level ON level.level = marks.level 
                   WHERE  
				   assessments.typofass = '$typofass'
				   AND assessments.date = '$date' 
				   AND class.class = '$class'
				   AND level.level = '$level' LIMIT " .$initial_page.' ,' .$limit ;
getData($getQuery);				   
}
?>
<?php

function getData($getQuery){
	include ('config/db.php');
	$result = mysqli_query($conn , $getQuery);
	if( mysqli_num_rows($result) >0){
		while($row = mysqli_fetch_assoc($result)){
			echo '<tr class = "td-sm" >
            <td class = "td-sm" >'.$row['id'].'</td>
            <td class = "td-sm" >'.$row['fname'].' '.$row['lname'].'</td>
            <td class = "td-sm" ><input type="text" value="'.$row['value'].'" style="border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:1px solid blue;background:lightgray;text-align:center;background-color:white;width:50px;"></td>
			<td>
			<button type="button" class="btn btn-info btn-sm" onclick="updateValue(' . $row['id'] . ')"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(' . $row['id'] . ')"><i class="fa fa-times"></i></button>
		</td>
            </tr>
			';
		}
	}
}

?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<hr>
<div class="pagination" style="position:flex;margin-left:5%;float:left">
	<?php
	for($page_number = 1 ; $page_number<= $total_pages; $page_number ++){
		echo '<a class="page-link" href="dashboard.php?page = '.$page_number.'"> '.$page_number.'</a>' ;
	}
	?>
</div>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="float:right;margin-right:30px;border:none !important;border-radius:10px;">
    Generate report
  </button>

<!-- The Modal -->
<div class="modal fade" id="Generate_Report_Cards">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">SEARCH CLASREPORTS TO PRINT</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <div class="modal-body">
        <form action="report_cards.php" method="POST" enctype="multipart/form-data">
		  <div class="row">
				<div class="col">
					<label for="recipient-name" class="col-form-label">Select Class:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required>
					  <option selected value="">Select class</option>
					<?php 
						$sql ="SELECT * from class ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["class"];
					?>
						<option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
				</div>
			  	
				<div class="col-sm">
				  <label for="recipient-name" class="col-form-label">Select Term:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="term" name="term" required>
					  <option selected value="">Select Term</option>
					<?php 
						$sql ="SELECT * from marks ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["typofass"];
					?>
						<option value="<?php echo $row["term"]; ?>"> <?php echo $row["term"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
			   </div>  
		  </div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="search" class="btn btn-primary">Generate Report Cards</button>
		</div>
        </form>
      </div>
  </div></div>
</div>

<div class="moda fade" id="Generate_Report_Cards" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-light">
        <h5 class="modal-title" id="exampleModalLabel">SEARCH MARK SHEET</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
	  <div class="modal-body">
        <form action="report_cards.php" method="POST" enctype="multipart/form-data">
		  <div class="row">
				<div class="col">
					<label for="recipient-name" class="col-form-label">Select Class:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="askclass" name="askclass" required>
					  <option selected value="">Select class</option>
					<?php 
						$sql ="SELECT * from class ORDER BY classid DESC";
						$res = $conn->query($sql);
						while($row = $res->fetchArray(SQLITE3_ASSOC)){
							$id = $row["classname"];
					?>
						<option value="<?php echo $row["classname"]; ?>"> <?php echo $row["classname"]; ?> </option>
					<?php } ?>
					</select>
				   </div>
				</div>
			  	
				<div class="col">
				  <label for="recipient-name" class="col-form-label">Select Exam:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="exam" name="exam" required>
					  <option selected value="">Select exam</option>
					<?php 
						$res ="SELECT * from exam ORDER BY examid DESC";
						$ret1 = $conn->query($res);
						while($row = $ret1->fetchArray(SQLITE3_ASSOC) ) 
						{
					?>
						<option value="<?php echo $row["examname"]; ?>"> <?php echo $row["examname"]; ?> </option>
					<?php } ?>
					</select>
				   </div>
			   </div>  
		  </div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="search" class="btn btn-primary">Generate Report Cards</button>
		</div>
        </form>
      </div>
  </div></div>
</div>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="Generate_Report_Cards" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-light">
        <h5 class="modal-title" id="exampleModalLabel">SEARCH MARK SHEET</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
	  <div class="modal-body">
        <form action="report_cards.php" method="POST" enctype="multipart/form-data">
		  <div class="row">
				<div class="col">
					<label for="recipient-name" class="col-form-label">Select Class:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required>
					  <option selected value="">Select class</option>
					<?php 
						$sql ="SELECT * from class ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["class"];
					?>
						<option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
				</div>
			  	
				<div class="col-sm">
				  <label for="recipient-name" class="col-form-label">Select Term:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="term" name="term" required>
					  <option selected value="">Select Term</option>
					<?php 
						$sql ="SELECT * from marks ORDER BY id DESC";
						$result = mysqli_query($conn , $sql);
						if( mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							$id = $row["typofass"];
					?>
						<option value="<?php echo $row["term"]; ?>"> <?php echo $row["term"]; ?> </option>
					<?php }} ?>
					</select>
				   </div>
			   </div>  
		  </div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="search" class="btn btn-primary">Generate Report Cards</button>
		</div>
        </form>
      </div>
  </div></div>
</div>

<div class="modal fade" id="Generate_Report_Cards" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-light">
        <h5 class="modal-title" id="exampleModalLabel">SEARCH MARK SHEET</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
	  <div class="modal-body">
        <form action="report_cards.php" method="POST" enctype="multipart/form-data">
		  <div class="row">
				<div class="col">
					<label for="recipient-name" class="col-form-label">Select Class:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="askclass" name="askclass" required>
					  <option selected value="">Select class</option>
					<?php 
						$sql ="SELECT * from class ORDER BY classid DESC";
						$res = $conn->query($sql);
						while($row = $res->fetchArray(SQLITE3_ASSOC)){
							$id = $row["classname"];
					?>
						<option value="<?php echo $row["classname"]; ?>"> <?php echo $row["classname"]; ?> </option>
					<?php } ?>
					</select>
				   </div>
				</div>
			  	
				<div class="col">
				  <label for="recipient-name" class="col-form-label">Select Exam:</label>
				  <div class="form-group">
					<select class="form-select form-select-sm" aria-label=".form-select-md example" id="exam" name="exam" required>
					  <option selected value="">Select exam</option>
					<?php 
						$res ="SELECT * from exam ORDER BY examid DESC";
						$ret1 = $conn->query($res);
						while($row = $ret1->fetchArray(SQLITE3_ASSOC) ) 
						{
					?>
						<option value="<?php echo $row["examname"]; ?>"> <?php echo $row["examname"]; ?> </option>
					<?php } ?>
					</select>
				   </div>
			   </div>  
		  </div>
		<div class="modal-footer">
			<button type="submit" name="submit" value="search" class="btn btn-primary">Generate Report Cards</button>
		</div>
        </form>
      </div>
  </div></div>
</div>
	<!-- <script src="script.js"></script> -->	
</body>
<script>
	<script>

function updateValue(id) {
	// Get the updated value from the input field
	var updatedValue = document.getElementById('value_' + id).value;

	// Send an AJAX request to update the data in the database
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				// Data updated successfully
				alert('Data updated successfully.');
			} else {
				// Error updating data
				alert('Error updating data: ' + xhr.responseText);
			}
		}
	};
	xhr.open('POST', 'dashboard.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send('update=1&id=' + id + '&updated_value=' + encodeURIComponent(updatedValue));
}

function deleteRow(id) {
	// Send an AJAX request to delete the row with the provided id
	// You'll need to implement this part using your backend code (PHP)
	// For demonstration purposes, I'm using a simple alert
	if (confirm('Are you sure you want to delete this row?')) {
		alert('Row with ID ' + id + ' will be deleted.');
	}
}
</script>
</script>	

</html>
</body>
</html>
