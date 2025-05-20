<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new_class'])) {
        $class_name = $_POST['class_name'];
        $class_level = $_POST['class_level'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "INSERT INTO class (class, level) VALUES ('$class_name', '$class_level')";
        if (mysqli_query($conn, $sql)) {
            echo "New class added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['new_subject'])) {
        $class_id = $_POST['class_id'];
        $subject_name = $_POST['subject_name'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "INSERT INTO subjects (class_id, subject_name) VALUES ('$class_id', '$subject_name')";
        if (mysqli_query($conn, $sql)) {
            echo "New subject added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['new_student'])) {
        $class_id = $_POST['class_id'];
        $fname = $_POST['student_fname'];
        $lname = $_POST['student_lname'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "INSERT INTO students (class_id, fname, lname) VALUES ('$class_id', '$fname', '$lname')";
        if (mysqli_query($conn, $sql)) {
            echo "New student added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['new_test'])) {
        $class_id = $_POST['class_id'];
        $test_name = $_POST['test_name'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "INSERT INTO tests (class_id, test_name) VALUES ('$class_id', '$test_name')";
        if (mysqli_query($conn, $sql)) {
            echo "New test added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['edit_subject'])) {
        $subject_id = $_POST['subject_id'];
        $subject_name = $_POST['subject_name'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "UPDATE subjects SET subject_name='$subject_name' WHERE id='$subject_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Subject updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['delete_subject'])) {
        $subject_id = $_POST['subject_id'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "DELETE FROM subjects WHERE id='$subject_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Subject deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['edit_student'])) {
        $student_id = $_POST['student_id'];
        $fname = $_POST['student_fname'];
        $lname = $_POST['student_lname'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "UPDATE students SET fname='$fname', lname='$lname' WHERE id='$student_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Student updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['delete_student'])) {
        $student_id = $_POST['student_id'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "DELETE FROM students WHERE id='$student_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Student deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif (isset($_POST['edit_test'])) {
        $test_id = $_POST['test_id'];
        $test_name = $_POST['test_name'];

        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;
    }
}

// Fetch existing classes
$classes_result = mysqli_query($conn, "SELECT * FROM class");

// Fetching available subjects
$sql = "SELECT id, lesname FROM lesson";
$les = $conn->query($sql);
?>
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
    </style>
</head>
<body>
<div class="container">
    <h1>Manage Classes</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="class_name">Class Name</label>
            <input type="text" id="class_name" name="class_name" required>
        </div>
        <div class="form-group">
            <label for="class_level">Class Level</label>
            <input type="text" id="class_level" name="class_level" required>
        </div>
        <button type="submit" class="btn btn-primary" name="new_class">Add New Class</button>
    </form>

    <h2>Existing Classes</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Class</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($classes_result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td>
                    <button class="btn btn-info" onclick="showClassOptions('<?php echo $row['id']; ?>')">View Options</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="container hidden" id="classOptions">
    <h2>Class Options</h2>
    <button class="btn btn-primary" onclick="viewSubjects()">View Subjects</button>
    <button class="btn btn-secondary" onclick="viewStudents()">View Students</button>
    <button class="btn btn-secondary" onclick="viewTests()">View Tests</button>
</div>

<div class="container hidden" id="subjectsContainer">
    <h2>Subjects</h2>
    <table id="subjectsTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    <form method="post" action="">
        <div class="form-group">
            <label for="subject_name">Subject Name</label>
            <input type="text" id="subject_name" name="subject_name" required>
            <input type="hidden" id="subject_class_id" name="class_id">
        </div>
        <button type="submit" class="btn btn-primary" name="new_subject">Add Subject</button>
    </form>
</div>

<div class="container hidden" id="studentsContainer">
    <h2>Students</h2>
    <table id="studentsTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    <form method="post" action="">
        <div class="form-group">
            <label for="student_fname">First Name</label>
            <input type="text" id="student_fname" name="student_fname" required>
            <label for="student_lname">Last Name</label>
            <input type="text" id="student_lname" name="student_lname" required>
            <input type="hidden" id="student_class_id" name="class_id">
        </div>
        <button type="submit" class="btn btn-primary" name="new_student">Add Student</button>
    </form>
</div>

<div class="container hidden" id="testsContainer">
    <h2>Tests</h2>
    <table id="testsTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Test</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    <form method="post" action="">
        <div class="form-group">
            <label for="test_name">Test Name</label>
            <input type="text" id="test_name" name="test_name" required>
            <input type="hidden" id="test_class_id" name="class_id">
        </div>
        <button type="submit" class="btn btn-primary" name="new_test">Add Test</button>
    </form>
</div>


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


<script>

function dodo(){}
function jeeze(){}
function back(){}

let currentClassId = null;

function showClassOptions(classId) {
    currentClassId = classId;
    document.getElementById('classOptions').classList.remove('hidden');
}

function viewSubjects() {
    document.getElementById('subjectsContainer').classList.remove('hidden');
    document.getElementById('studentsContainer').classList.add('hidden');
    document.getElementById('testsContainer').classList.add('hidden');
    document.getElementById('subject_class_id').value = currentClassId;
    fetchSubjects(currentClassId);
}

function viewStudents() {
    document.getElementById('studentsContainer').classList.remove('hidden');
    document.getElementById('subjectsContainer').classList.add('hidden');
    document.getElementById('testsContainer').classList.add('hidden');
    document.getElementById('student_class_id').value = currentClassId;
    fetchStudents(currentClassId);
}

function viewTests() {
    document.getElementById('testsContainer').classList.remove('hidden');
    document.getElementById('subjectsContainer').classList.add('hidden');
    document.getElementById('studentsContainer').classList.add('hidden');
    document.getElementById('test_class_id').value = currentClassId;
    fetchTests(currentClassId);
}

function fetchSubjects(classId) {
    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'fetch_subjects': true,
            'class_id': classId
        })
    })
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('subjectsTable').querySelector('tbody');
        tbody.innerHTML = '';
        data.forEach(subject => {
            tbody.innerHTML += `
                <tr>
                    <td>${subject.id}</td>
                    <td>${subject.subject_name}</td>
                    <td>
                        <button class="btn btn-secondary" onclick="editSubject(${subject.id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteSubject(${subject.id})">Delete</button>
                    </td>
                </tr>
            `;
        });
    });
}

function fetchStudents(classId) {
    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'fetch_students': true,
            'class_id': classId
        })
    })
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('studentsTable').querySelector('tbody');
        tbody.innerHTML = '';
        data.forEach(student => {
            tbody.innerHTML += `
                <tr>
                    <td>${student.id}</td>
                    <td>${student.fname}</td>
                    <td>${student.lname}</td>
                    <td>
                        <button class="btn btn-secondary" onclick="editStudent(${student.id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteStudent(${student.id})">Delete</button>
                    </td>
                </tr>
            `;
        });
    });
}

function fetchTests(classId) {
    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'fetch_tests': true,
            'class_id': classId
        })
    })
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('testsTable').querySelector('tbody');
        tbody.innerHTML = '';
        data.forEach(test => {
            tbody.innerHTML += `
                <tr>
                    <td>${test.id}</td>
                    <td>${test.test_name}</td>
                    <td>
                        <button class="btn btn-secondary" onclick="editTest(${test.id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteTest(${test.id})">Delete</button>
                    </td>
                </tr>
            `;
        });
    });
}

function editSubject(subjectId) {
    const newSubjectName = prompt("Enter the new subject name:");
    if (newSubjectName) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'subject_id': subjectId,
                'subject_name': newSubjectName,
                'edit_subject': true
            })
        }).then(response => response.text())
            .then(data => {
                alert(data);
                fetchSubjects(currentClassId);
            });
    }
}

function deleteSubject(subjectId) {
    if (confirm("Are you sure you want to delete this subject?")) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'subject_id': subjectId,
                'delete_subject': true
            })
        }).then(response => response.text())
            .then(data => {
                alert(data);
                fetchSubjects(currentClassId);
            });
    }
}

function editStudent(studentId) {
    const newFname = prompt("Enter the new first name:");
    const newLname = prompt("Enter the new last name:");
    if (newFname && newLname) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'student_id': studentId,
                'student_fname': newFname,
                'student_lname': newLname,
                'edit_student': true
            })
        }).then(response => response.text())
            .then(data => {
                alert(data);
                fetchStudents(currentClassId);
            });
    }
}

function deleteStudent(studentId) {
    if (confirm("Are you sure you want to delete this student?")) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'student_id': studentId,
                'delete_student': true
            })
        }).then(response => response.text())
            .then(data => {
                alert(data);
                fetchStudents(currentClassId);
            });
    }
}

function editTest(testId) {
    const newTestName = prompt("Enter the new test name:");
    if (newTestName) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'test_id': testId,
                'test_name': newTestName,
                'edit_test': true
            })
        }).then(response => response.text())
            .then(data => {
                alert(data);
                fetchTests(currentClassId);
            });
    }
}

function deleteTest(testId) {
    if (confirm("Are you sure you want to delete this test?")) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'test_id': testId,
                'delete_test': true
            })
        }).then(response => response.text())
            .then(data => {
                alert(data);
                fetchTests(currentClassId);
            });
    }
}

function deleteClass(){}
function editClass(){}
 
</script>
</body>
</html>