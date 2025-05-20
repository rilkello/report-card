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

        $sql = "UPDATE marks SET `$sec` = ? WHERE fname = ? AND lname = ? AND subject = ? ";
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
    
    elseif (isset($_POST['update_outof'])) {
        $new_outof = $_POST['new_outof'];
        $test_id = $_POST['test_id'];
        $secl = $_POST['sekk'];
        
        echo '<script>document.write("efg")</script>';

        $sql = "UPDATE assessments SET `$secl` = '$new_outof' WHERE id ='$test_id'";
        // $sql = "UPDATE assessments SET ? = ? WHERE id = ? ";

        if(mysqli_query( $conn , $sql )){
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param("ssi", $secl , $new_outof , $test_id);

        // if ($stmt->execute()) {
        //     echo json_encode(['status' => 'success']);
        // } else {
        //     echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        // }

        // $stmt->close();
        // exit;

        // header("location:".$_SERVER['PHP_SELF']);
        // exit;
    }
}

    

// // Fetching available tests
// $sql = "SELECT id, name, class, sec FROM assessments";
// $tests = $conn->query($sql);

// Fetching available subjects
$sql = "SELECT id, lesname FROM lesson";
$les = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Marks</title>
    <?php include 'header.php'; ?>
    <style>
        .hidden { display: none; }
        .container { margin: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; }
        /* .btn { padding: 10px 15px; cursor: pointer; margin-right: 10px; }
        .btn-primary { background-color: #007bff; color: #fff; border: none; }
        .btn-secondary { background-color: #6c757d; color: #fff; border: none; }
        .btn-danger { background-color: #dc3545; color: #fff; border: none; } */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 15px; text-align: left; }
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
        @-webkit-keyframes fade1 {
                0% {
                    margin-top:-100px;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }

                to { 
                    margin-top: 5px;
                    /* top: 1; */
                    /* -webkit-transform: rotate(1turn) */
                }
        }

        @-webkit-keyframes fad {
                0% {
                    display: block;
                    margin-top:5px;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }

                to {
                    display: none; 
                    margin-top:-100px;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }
        } 

        @-webkit-keyframes progress {
                0% {
                    width: 100%;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }

                

                to {
                    width: 0%;
                    /* top: 0; */
                    /* -webkit-transform: rotate(10deg) */
                }
        } 

        #info{ display: none; margin-right: 10px; overflow: auto; position: fixed; z-index: 2; right: 0; align-items: center; animation:fade1 0.5s linear; }
        #counterr{ margin-bottom: 0px; height: 2px; background: red; animation: progress 4s linear; };


    </style>
    <script>

    function linkk(){
        document.location.href = 'new3.php'; 
    }

    function dothis(){  
        var here = document.getElementById('info');
        here.style.display = 'block';
        here.style.animation = ' fade1 0.5s linear ';
    }

    function omg(){
        var here = document.getElementById('info');
        here.style.animation = 'fad 0.5s linear ';
    }
    setTimeout(dothis , 4000);

    function fthis(){  
        var here = document.getElementById('info');
        here.style.display = 'none';
        var here = document.getElementById('counterr');
        here.style.width = '0%';
    }
    setTimeout(fthis , 4000);

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
                span.textContent = '';
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
                    co = 0;
                    coo = 1
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        // co = co + coo;
                        // coo++;
                        // // document.getElementById('goo').addEventListener('click', () => {
                        // //     document.write(co);
                        // // });
                        // alert(co);
                        if (response.status === 'success') {
                            var tick = input.parentElement.querySelector('.success-tick');
                            tick.style.display = 'inline';
                            dothis();
                            setTimeout(dothis , 0001);
                            omg();
                            setTimeout(omg , 4000);
                            fthis()
                            setTimeout(fthis , 4000);
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

        function updateOutof(input, test_id, sek) {
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
                         "&test_id=" + encodeURIComponent(test_id) +
                         "&sekk=" + encodeURIComponent(sek);
            xhr.send(params);
        }
    </script>
</head>
<body>
<?php //include 'home.php'; ?>
<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                      <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                          <center><p>Marks inserted</p></center>
                    </div>
                    <div id="counterr"></div>
                  </div>
                </div>
              </div>

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
    
    <button id="editButton" onclick="toggleEdit()">Enable Editing</button>

    </table>
    <?php endif; ?>

    <div class="container-responsive" id="mhn">
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
                                    <option value="test 3">Test 3</option>
                                    <option value="test 4">Test 4</option>
                                    <option value="exam">Exam</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;float: right;">Filter</button>
                            </div>
                        </div>
                    </form>
                    <!-- <button id="editButton" onclick="toggleEdit()">Enable Editing</button> -->
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
		$term = $_POST['term'];  
		$class = $_POST['class'];
		$level = $_POST['level'];
        $sec = $_POST['sec'];
        $subject = $_POST['subject'];

        if($term === "term 1" && $sec === "test 1" && $typofass == "test"){
            $secc = "cat1a"; 
        }   
        elseif($term === "term 1" && $sec === "test 2"){
            $secc = "cat1b";
        }

        elseif($term === "term 1" && $sec === "test 3"){
            $secc = "cat1c"; 
        }   
        elseif($term === "term 1" && $sec === "test 4"){
            $secc = "cat1d";
        }
        elseif($term === "term 1" && $sec === "exam"){
            $secc = "ex1"; 
        }   
        elseif($term === "term 2" && $sec === "test 1"){
            $secc = "cat2a";
        }
        elseif($term === "term 2" && $sec === "test 2"){
            $secc = "cat2b";
        }
        elseif($term === "term 2" && $sec === "test 3"){
            $secc = "cat2c";
        }
        elseif($term === "term 2" && $sec === "test 4"){
            $secc = "cat2d";
        }
        elseif($term === "term 2" && $sec === "exam" && $typofass == "exam"){
            $secc = "ex2";
        }
        elseif($term === "term 3" && $sec === "test 1"){
            $secc = "cat3a";
        }
        elseif($term === "term 3" && $sec === "test 2"){
            $secc = "cat3b";
        }
        elseif($term === "term 3" && $sec === "test 3"){
            $secc = "cat3c";
        }
        elseif($term === "term 3" && $sec === "test 4"){
            $secc = "cat3d";
        }
        elseif($term === "term 3" && $sec === "exam"){
            $secc = "ex3";
        }

        $query = "SELECT $secc, id, outof FROM assessments WHERE class = '$class' AND subject = '$subject' ";
        $res = mysqli_query( $conn , $query );
        $rowe = mysqli_fetch_assoc($res);
        // $secc = $rowe['sec'];
        $outof = $rowe[$secc]; 
        $idd = $rowe['id'];
	
		$getQuery = " SELECT id , fname , lname , `$secc`, dir FROM marks
		WHERE  
		class = '$class' 
		AND level = '$level'
        AND subject = '$subject'
		LIMIT  15 " ;//.$initial_page.' ,' .$limit ;

		$result = mysqli_query($conn , $getQuery);
        $result1 = mysqli_query($conn , $query);
		if( mysqli_num_rows($result) >0):?>
            <button id="editButton" class="btn btn-success" onclick="toggleEdit()" style="float:right;">Enable Editing</button>
            <?php
			while($row = mysqli_fetch_assoc($result)): ?>
				<tr class = "td-sm" >
				<td class = "td-sm" ><img src="passports/<?php echo $row['dir']; ?>" style="width:50px;height:50px;border-radius:50%;"/></td>
				<td class = "td-sm" ><?php echo $row['fname'].' '.$row['lname']; ?></td>
				<td class = "td-sm" ><input type="text" class="non-editable" value="<?php echo $row[$secc]; ?>" oninput="validateMarks(this, '<?php echo $outof; ?>')" onchange="updateMarks(this, '<?php echo $row['fname']; ?>', '<?php echo $row['lname']; ?>', '<?php echo $secc; ?>', '<?php echo $subject; ?>', '<?php echo $outof; ?>')" style="border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:1px solid blue;background:lightgray;text-align:center;background-color:white;width:50px;color:black">
                    <span class="error-message"></span>
                    <span class="success-tick">&#10004;</span>
                </td>
				</tr>
			<?php endwhile ;
        endif;
	// }
	
	?>
                            <!-- Table body content goes here -->
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="margin-right: 30px; border-radius: 10px;" onclick = "linkk()" >
                Generate report
                </button>
                <?php
                    $rok = mysqli_fetch_assoc($result1);
                    $neww = $rok[$secc];
                ?>
                <form id="outofForm" style="float:right;">
                    <input type="hidden" name="test_id" value='<?php echo $idd ;?>'>
                    <input type="hidden" name="class" value="<?php echo $class ;?>">
                    <!-- input type="hidden" name="class" value="<?php echo $neww ;?>"> -->
                    <label>Total : </label>
                    <input type="number" id="outof" value="<?php echo $neww; ?>" onchange="updateOutof(this, '<?php echo $idd;?>', '<?php echo $secc ?>' )">
                    <span class="success-tick">&#10004;</span>
                </form>
            </div>
        </div>
    </div>
    <div class="pagination" style="text-align:center;">
        <?php
        // for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
        //     echo '<a class="page-link" href="new5.php?page=' . $page_number . '"> ' . $page_number . '</a>';
        // }
        ?>
    </div>
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="margin-right: 30px; border-radius: 10px;">
        Generate report
    </button> -->
    <?php } ?>
</body>
</html>
