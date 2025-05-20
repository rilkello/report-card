<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        hr {
            width: 90%;
        }
    </style>
</head>
<body>
    <?php //include 'nav.php' ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="table-responsive">
                    <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="served_by" name="served_by" value="<?php echo $session_id; ?>" onkeydown="return false">
                        <div class="form-row mb-2">
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="typofass" name="typofass" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;">
                                    <option selected value="" style="color:lightgray;">Typofass</option>
                                    <?php
                                    $sql = "SELECT * FROM assessments";
                                    $result = $conn->query($sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option value="<?php echo $row["typofass"]; ?>"> <?php echo $row["typofass"]; ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="date" name="date" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;">
                                    <option selected value="" style="color:lightgray;">date</option>
                                    <?php
                                    $sql = "SELECT * FROM assessments";
                                    $result = $conn->query($sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option value="<?php echo $row["date"]; ?>"> <?php echo $row["date"]; ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;">
                                    <option selected value="" style="color:lightgray;">class</option>
                                    <?php
                                    $sql = "SELECT * FROM class";
                                    $result = $conn->query($sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option value="<?php echo $row["class"]; ?>"> <?php echo $row["class"]; ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="level" name="level" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;">
                                    <option selected value="" style="color:lightgray;">level</option>
                                    <option value="Ordinary level">Ordinary level</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;">Filter</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Student's name</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
	$limit = 5;
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "regg";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    include "header.php";
	$getQuery = " SELECT * from marks ";
	$result = mysqli_query ( $conn, $getQuery);
	$total_rows =  mysqli_num_rows($result);
	$total_rows =  mysqli_num_rows($result);
	$total_pages = ceil($total_rows / $limit);

	// Check if $total_pages is defined before using it
	if (isset($_GET['page'])) {
		$page_number = $_GET['page'];
	} else {
		$page_number = 1;
	}
	$initial_page = ($page_number - 1) * $limit;
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
                            <!-- Table body content goes here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="pagination" style="text-align:center;">
        <?php
        for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
            echo '<a class="page-link" href="dashboard.php?page=' . $page_number . '"> ' . $page_number . '</a>';
        }
        ?>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="margin-right: 30px; border-radius: 10px;">
        Generate report
    </button>

    <!-- The Modal -->
    <div class="modal fade" id="Generate_Report_Cards" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Modal content goes here -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateValue(id) {
            var updatedValue = document.getElementById('value_' + id).value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Data updated successfully.');
                    } else {
                        alert('Error updating data: ' + xhr.responseText);
                    }
                }
            };
            xhr.open('POST', 'dashboard.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('update=1&id=' + id + '&updated_value=' + encodeURIComponent(updatedValue));
        }

        function deleteRow(id) {
            if (confirm('Are you sure you want to delete this row?')) {
                alert('Row with ID ' + id + ' will be deleted.');
            }
        }
    </script>
</body>
</html>
