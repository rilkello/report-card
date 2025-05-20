<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_marks'])) {
        $sec = $_POST['sec'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $marks = $_POST['marks'];
        $subject = $_POST['subject'];

        $sql = "UPDATE marks SET `$sec` = ? WHERE fname = ? AND lname = ? AND subject = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $marks, $fname, $lname, $subject);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        exit;

    }
    
    if (isset($_POST['update_outof'])) {
        $new_outof = $_POST['new_outof'];
        $test_id = $_POST['test_id'];

        $sql = "UPDATE assessments SET outof=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_outof, $test_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['status' => 'success']);

        //header("location:".$_SERVER['PHP_SELF']);
        exit;
    }
}

    

// Fetching available tests
$sql = "SELECT id, name, class, sec FROM assessments";
$tests = $conn->query($sql);

// Fetching available subjects
$sql = "SELECT id, lesname FROM lesson";
$les = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Marks</title>
    <?php include "header.php"; ?>
    <style>
        .editable {
            pointer-events: auto;
            color:white !important;
            background: black !important;
            border:none;
        }
        .non-editable {
            pointer-events: none;
        }
        .success-tick {
            color: green;
            display: none;
        }
    </style>
    <script>
        function toggleEdit() {
            var elements = document.querySelectorAll('input[type="text"]');
            elements.forEach(function(element) {
                if (element.classList.contains('non-editable')) {
                    element.classList.remove('non-editable');
                    element.classList.add('editable');
                } else {
                    element.classList.remove('editable');
                    element.classList.add('non-editable');
                }
            });

            var button = document.getElementById('editButton');
            if (button.textContent === 'Enable Editing') {
                button.textContent = 'Lock Editing';
                <?php //header("location:".$_SERVER['PHP_SELF']);?>
            } else {
                button.textContent = 'Enable Editing';
            }
        }

        function validateMarks(input, outof) {
            var value = parseFloat(input.value);
            var span = input.nextElementSibling;
            if (value > outof) {
                span.textContent = 'Marks are out of limit';
            } else {
                span.textContent = 'Done';
            }
        }

        function updateMarks(input, fname, lname, sec, subject, outof) {
            var value = parseFloat(input.value);
            validateMarks(input, outof);

            if (value <= outof) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            var tick = input.parentElement.querySelector('.success-tick');
                            tick.style.display = 'inline';
                            setTimeout(function() {
                                tick.style.display = 'none';
                            }, 1000);
                        } else {
                            console.error(response.message);
                        }
                    }
                };
                var params = "update_marks=1&fname=" + encodeURIComponent(fname) +
                             "&lname=" + encodeURIComponent(lname) +
                             "&marks=" + encodeURIComponent(value) +
                             "&subject=" + encodeURIComponent(subject) +
                             "&sec=" + encodeURIComponent(sec);
                xhr.send(params);
            }
        }

        function updateOutof(input, test_id) {
            var new_outof = parseFloat(input.value);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        var tick = input.parentElement.querySelector('.success-tick');
                        tick.style.display = 'inline';
                        history.go(0);
                        setTimeout(function() {
                            tick.style.display = 'none';
                        }, 2000);
                    }
                }
            };
            var params = "update_outof=1&new_outof=" + encodeURIComponent(new_outof) +
                         "&test_id=" + encodeURIComponent(test_id);
            xhr.send(params);
        }
    </script>
</head>
<body>
    <h2>Select Test and Class to Enter Marks</h2>
    <form method="get">
        <label for="test_id">Test:</label>
        <select name="sec" id="test_id" required>
            <?php while ($test = $tests->fetch_assoc()): ?>
                <option value="<?php echo $test['sec']; ?>"><?php echo $test['name'] . " - " . $test['class']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="test_id">Subject:</label>
        <select name="subject" id="test_id" required>
            <?php while ($sub = $les->fetch_assoc()): ?>
                <option value="<?php echo $sub['lesname']; ?>"><?php echo $sub['lesname']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="class">Class:</label>
        <input type="text" name="class" id="class" required><br>
        <button type="submit">Submit</button>
    </form>

    <?php if (isset($sec) && isset($class) && isset($subject)): ?>
    <h2>Enter Marks</h2>
    <?php
        $getQuery1 = "SELECT id, fname, lname, `$sec` FROM marks WHERE class = ? AND subject = ?";
        $stmt1 = $conn->prepare($getQuery1);
        $stmt1->bind_param("ss", $class, $subject);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $stmt1->close();

        $select1 = "SELECT id , outof , class FROM assessments WHERE sec = ?";
        $stmt2 = $conn->prepare($select1);
        $stmt2->bind_param("i", $sec);
        $stmt2->execute();
        $ress1 = $stmt2->get_result();
        $rowe = $ress1->fetch_assoc();
        $stmt2->close();
    ?>
    <form id="outofForm">
        <input type="hidden" name="test_id" value="<?php echo $rowe['id']; ?>">
        <input type="hidden" name="class" value="<?php echo $class; ?>">
        <label for="outof">Out of:</label>
        <input type="number" name="outof" id="outof" value="<?php echo $rowe['outof']; ?>" onchange="updateOutof(this, '<?php echo $rowe['id']; ?>' )">
        <span class="success-tick">&#10004;</span>
    </form>
    <button id="editButton" onclick="toggleEdit()">Enable Editing</button>

    </table>
    <?php endif; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="table-responsive">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="served_by" name="served_by" value="<?php echo $session_id; ?>" onkeydown="return false">
                        <div class="form-row mb-2">
                        <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="level" name="level" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">level</option>
                                    <option value="Ordinary level">Ordinary level</option>ption
                                    <option value="Advanced level">Advanced level</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="class" name="class" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
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
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="typofass" name="typofass" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Type of assessment</option>
                                    <option value="test">Test</option>
                                    <option value="exam">Exam</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="subject" name="subject" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Subject</option>
                                    <?php
                                    $sql = "SELECT lesname FROM lesson";
                                    $result = $conn->query($sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option value="<?php echo $row["lesname"]; ?>"> <?php echo $row["lesname"]; ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="term" name="term" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Term</option>
                                    <option value="term 1">Term 1</option>
                                    <option value="term 2">Term 2</option>
                                    <option value="term 3">Term 3</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="sec" name="sec" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Assessment</option>
                                    <option value="test 1">Test 1</option>
                                    <option value="test 2">Test 2</option>
                                    <option value="term 3">Test 3</option>
                                    <option value="term 4">Test 4</option>
                                    <option value="exam">Exam</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;">Filter</button>
                            </div>
                        </div>
                    </form>
                    <button id="editButton" onclick="toggleEdit()">Enable Editing</button>
                    <table class="table table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Student's name</th>
                                <th scope="col">Marks</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
	// $limit = 15;
	// // include ('config/db.php');
	// $getQuery = " SELECT * from marks ";
	// $result = mysqli_query ( $conn, $getQuery);
	// $total_rows =  mysqli_num_rows($result);
	// $total_rows =  mysqli_num_rows($result);
	// $total_pages = ceil($total_rows / $limit);

	// // Check if $total_pages is defined before using it
	// if (isset($_GET['page'])) {
	// 	$page_number = $_GET['page'];
	// } else {
	// 	$page_number = 1;
	// }
	// $initial_page = ($page_number - 1) * $limit;
    
	if (isset($_POST['submit'])){
		$typofass = $_POST['typofass'];
		$date = $_POST['term'];  
		$class = $_POST['class'];
		$level = $_POST['level'];
        $sec = $_POST['sec'];
        $subject = $_POST['subject'];

        $query = "SELECT sec , outof FROM assessments WHERE name = '$sec' ";
        $res = mysqli_query( $conn , $query );
        $rowe = mysqli_fetch_assoc($res);
        $secc = $rowe['sec'];
        $outof = $rowe['outof']; 
	
		$getQuery = " SELECT id , fname , lname , `$secc` FROM marks
		WHERE  
		class = '$class' 
		AND level = '$level'
        AND subject = '$subject'
		LIMIT  15 " ;//.$initial_page.' ,' .$limit ;

		$result = mysqli_query($conn , $getQuery);
        $result1 = mysqli_query($conn , $query);
		if( mysqli_num_rows($result) >0){
			while($row = mysqli_fetch_assoc($result)): ?>
				<tr class = "td-sm" >
				<td class = "td-sm" ><?php echo $row['id']; ?></td>
				<td class = "td-sm" ><?php echo $row['fname'].' '.$row['lname']; ?></td>
				<td class = "td-sm" ><input type="text" class="non-editable" value="<?php echo $row[$secc]; ?>" oninput="validateMarks(this, '<?php echo $outof; ?>')" onchange="updateMarks(this, '<?php echo $row['fname']; ?>', '<?php echo $row['lname']; ?>', '<?php echo $secc; ?>', '<?php echo $subject; ?>', '<?php echo $outof; ?>')" style="border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:1px solid blue;background:lightgray;text-align:center;background-color:white;width:50px;color:black">
                    <span class="error-message"></span>
                    <span class="success-tick">&#10004;</span>
                </td>
				</tr>
			<?php endwhile ;
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
    <div class="pagination" style="text-align:center;">
        <?php
        // for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
        //     echo '<a class="page-link" href="new2.php?page=' . $page_number . '"> ' . $page_number . '</a>';
        // }
        ?>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="margin-right: 30px; border-radius: 10px;">
        Generate report
    </button>

</body>
</html>
