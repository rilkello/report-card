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

        
        
        // $res2 = {};

        $query3 = "SELECT class FROM class WHERE class='$class_name'";
        $re3 = mysqli_query($conn , $query3);

        if(mysqli_num_rows($re3) > 0){
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>Class exists</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        }
        else{
            $sql = "INSERT INTO class (class, level) VALUES ('$class_name', '$class_level')";
            if (mysqli_query($conn, $sql)) {
                echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <center><p>New class added</p></center>
                    </div>
                    <div id="counterr"></div>
                </div>
                </div>
            </div>';
            } // else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }

            $query1 = "SELECT lesname , outof FROM lesson WHERE level='$class_level'";
            $res1 = mysqli_query( $conn , $query1 );

            $query2 = "SELECT id FROM class WHERE class = '$class_name' ";
            $res2 = mysqli_query( $conn , $query2 );
            $rowe = mysqli_fetch_assoc($res2);
            $classid = $rowe['id'];

            while($row = mysqli_fetch_assoc($res1)){
                $subject = $row['lesname'];
                $outof = $row['outof'];
                $query3 = "INSERT INTO assessments ( name , level , typofass , date, outof , class , classid  ,term , subject , cat1a, cat1b, cat1c, cat1d, cat11, ex1, tot1, cat2a, cat2b, cat2c, cat2d, cat22, ex2, tot2, cat3a, cat3b, cat3c, cat3d, cat33, ex3, tot3) VALUES ( '$class_name', '$class_level' , 'test' , CURDATE() , $outof, '$class_name' , '$classid' , '$outof' , '$subject', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0' ) ";
                $res3 = mysqli_query( $conn , $query3 );
            } 
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
        // if (mysqli_query($conn, $sql)) {
        //     echo "New subject added successfully!";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }

        if (mysqli_query($conn, $sql)) {
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>New subject added</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    } elseif (isset($_POST['new_student'])) {
        $class = $_POST['class'];
        $fname = $_POST['student_fname'];
        $lname = $_POST['student_lname'];
        $imgg = $_FILES['filename']['name'];
        
        if($imgg==""){
            $img = "default.png";
        }
        else{
            $img = $imgg;
        }

        // if (file_exists("passports/".$img)){ 
        //     echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
        //         <div class="modal-dialog" role="document">
        //         <div class="modal-content">
        //             <div class="modal-header bg-primary text-light">
        //             <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
        //             <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
        //                 <span aria-hidden="true">&times;</span>
        //             </button>
        //             </div>
        //             <div class="modal-body">
        //                 <center><p>Image exists</p></center>
        //             </div>
        //             <div id="counterr"></div>
        //         </div>
        //         </div>
        //     </div>';
        // }
        // else{
            move_uploaded_file($_FILES['filename']['tmp_name'],"passports/".$img); 
        // }

        $check = "SELECT * FROM students WHERE class='$class' AND fname='$fname' AND lname='$lname' ";
        $chec = mysqli_query( $conn , $check );
        // $query3 = {}
        // $re3 = ;
        if(mysqli_num_rows($chec) > 0){
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>Student exists</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        } else{
            $sql = "INSERT INTO students (class , fname, lname, classid, level , count, dir ) VALUES ('$class', '$fname', '$lname', (SELECT id FROM class WHERE class='$class' ) , (SELECT level FROM class WHERE class='$class' ) , '1' , '$img')";
            // if (mysqli_query($conn, $sql)) {
            //     echo "New student added successfully!";
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
    
    
    
            // $query1 = "SELECT lesname , outof FROM lesson";
            // $res1 = mysqli_query( $conn , $query1 );
    
            // $query2 = "SELECT id FROM class WHERE class = '$class_name' ";
            // $res2 = mysqli_query( $conn , $query2 );
            // $rowe = mysqli_fetch_assoc($res2);
            // $classid = $rowe['id'];
    
            // while($row = mysqli_fetch_assoc($res1)){
            //     $subject = $row['lesname'];
            //     $outof = $row['outof'];
            //     $query3 = "INSERT INTO assessments ( name , sec , typofass , outof , class , classid  ,term , subject ) VALUES ( 'Test 1' , 'cat1a' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 2' , 'cat1b' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 3' , 'cat1c' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 4' , 'cat1d' , 'test' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Exam' , 'ex1' , 'exam' , '$outof', '$class_name' , '$classid' , 'term 1' , '$subject'), ( 'Test 1' , 'cat2a' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Test 2' , 'cat2b' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Test 3' , 'cat2c' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Test 4' , 'cat1d' , 'test' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject'), ( 'Exam' , 'ex2' , 'exam' , '$outof', '$class_name' , '$classid' , 'term 2' , '$subject') , ( 'Test 1' , 'cat3a' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Test 2' , 'cat3b' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Test 3' , 'cat3c' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Test 4' , 'cat3d' , 'test' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject'), ( 'Exam' , 'ex3' , 'exam' , '$outof', '$class_name' , '$classid' , 'term 3' , '$subject')";
            //     $res3 = mysqli_query( $conn , $query3 );
            // }

            move_uploaded_file($_FILES['filename']['tmp_name'],"passports/".$img);
    
            if ($re = mysqli_query($conn, $sql)) {
                echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                      <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                          <center><p>Student added</p></center>
                    </div>
                    <div id="counterr"></div>
                  </div>
                </div>
              </div>';
            } // else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
    
    
            // $row = mysqli_fetch_assoc($re)
            // $iddd = $row['id'];
    
    
            $query1 = "SELECT lesname , outof FROM lesson WHERE level =(SELECT level FROM class WHERE class='$class') ";
            $res1 = mysqli_query( $conn , $query1 );
            // $res11 = mysqli_fetch_assoc($res1);
    
            while($row = mysqli_fetch_assoc($res1)){
                $blesson = $row['lesname'];
                $boutof = $row['outof']; 
                $query2 = "INSERT INTO marks ( stid , fname , lname , dir, date , class , classid , level , subject , outof , cat1a , cat1b , cat1c , cat1d , cat11 , ex1 , tot1 , be1 , cat2a ,	cat2b , cat2c , cat2d , cat22 , ex2 , tot2 , be2 , cat3a , cat3b , cat3c , cat3d , cat33 , ex3 , tot3 , be3 ) VALUES ( (SELECT id FROM students WHERE class='$class' AND fname='$fname' AND lname='$lname') , '$fname' , '$lname' , (SELECT dir FROM students WHERE class='$class' AND fname='$fname' AND lname='$lname'), CURDATE(), '$class' , (SELECT id FROM class WHERE class='$class' ) , (SELECT level FROM class WHERE class='$class'), '$blesson' , '$boutof' , '0' , '0' , '0' , '0' , '0' , '0' , '0' , '40' , '0' , '0' , '0' , '0' , '0' , '0' , '0' , '40' , '0' , '0' , '0' , '0' , '0' , '0' , '0' , '40') ";
                $res2 = mysqli_query( $conn , $query2 );
            }
        }

    } elseif (isset($_POST['edit_subject'])) {
        $subject_id = $_POST['subject_id'];
        $subject_name = $_POST['subject_name'];

        // $query3 = {}
        // $re3 = ;

        $sql = "UPDATE lesson SET lesnam='$subject_name' WHERE id='$subject_id'";
        // if (mysqli_query($conn, $sql)) {
        //     echo "Subject updated successfully!";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }

        $query1 = "UPDATE assessments SET subject = ( SELECT lesname FROM lesson WHERE id = '$subject_id' ) ";
        $res1 = mysqli_query( $conn , $query1 );

        $query2 = "UPDATE marks SET subject = ( SELECT lesname FROM lesson WHERE id = '$subject_id' ) ";
        $res2 = mysqli_query( $conn , $query2 );

        if (mysqli_query($conn, $sql)) {
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>Subject updated successfully</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        } //else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }

    } elseif (isset($_POST['delete_subject'])) {

        // $query3 = {}
        // $re3 = ;

        $sql = "DELETE FROM lesson WHERE id='$subject_id'";
        // if (mysqli_query($conn, $sql)) {
        //     echo "Subject deleted successfully!";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }

        if (mysqli_query($conn, $sql)) {
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>Subject deleted successfully</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        }

        $subject_id = $_POST['subject_id'];

        $query1 = "DELETE FROM marks WHERE subject= (SELECT lesname FROM lesson WHERE id = '$subject_id' ) ";
        $res1 = mysqli_query( $conn , $query1 );

        $query2 = "DELETE FROM assessments WHERE subject = (SELECT lesname FROM lesson WHERE id = '$subject_id')";
        $res2 = mysqli_query( $conn , $query2 );

    } elseif (isset($_POST['edit_student'])) {
        $student_id = $_POST['student_id'];
        $fname = $_POST['student_fname'];
        $lname = $_POST['student_lname'];

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        $sql = "UPDATE students SET fname='$fname', lname='$lname' WHERE id='$student_id'";
        // if (mysqli_query($conn, $sql)) {
        //     echo "Student updated successfully!";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }

        $query1 = "UPDATE marks SET fname = '$fname' AND lname = '$lname' WHERE stid = '$student_id' ";
        $res1 = mysqli_query( $conn , $query1 );

        if (mysqli_query($conn, $sql)) {
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>Student updated successfully</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        }

    } elseif (isset($_POST['delete_student'])) {
        $student_id = $_POST['student_id'];

        $query1 = "DELETE FROM marks WHERE stid='$student_id' ";
        $res1 = mysqli_query( $conn , $query1 );

        $query3 = "SELECT dir FROM students WHERE id='$student_id'";
        $re3 = $conn->query($query3);
        $arr = mysqli_fetch_assoc($re3);
        $file = $arr['dir'];

        if(!($file=="default.png")){
            unlink('passports/'.$file);
        }

        $sql = "DELETE FROM students WHERE id='$student_id'";
        // if (mysqli_query($conn, $sql)) {
        //     echo "Student deleted successfully!";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }

        $query2 = "DELETE FROM marks WHERE stid = '$student_id' ";
        $res2 = mysqli_query( $conn , $query2 );



    // } elseif (isset($_POST['edit_test'])) {
    //     $class = $_POST['class'];
    //     $level = $_POST['level'];
    //     $idd = $_POST['classid'];

    //     $sql = "UPDATE class SET class = '$class' , level='$level' WHERE id = '$idd' ";
    //     if (mysqli_query($conn, $sql)) {
    //         echo "Class deleted successfully!";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //     }
        // $query1 = {};
        // $res1 = ;

        // $query2 = {};
        // $res2 = {};

        // $query3 = {}
        // $re3 = ;

        if (mysqli_query($conn, $sql)) {
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>Student deleted successfully</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>';
        }

    } elseif (isset($_POST['fetch_students'])) {
        $class_id = $_POST['class_id'];
        $students_result = mysqli_query($conn, "SELECT * FROM students WHERE classid='$class_id'");
        $students = [];
        while ($row = mysqli_fetch_assoc($students_result)) {
            $students[] = $row;
        }
        echo json_encode($students);
        exit;    

    } elseif (isset($_POST['delete_class'])) {
        $classid = $_POST['classid'];

        $sql = "DELETE FROM class WHERE id='$classid'";
        // if (mysqli_query($conn, $sql)) {
        //     echo "Class with id".$classid."deleted successfully!";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }  
        
        $query1 = "DELETE FROM marks WHERE classid='$classid' ";
        $res1 = mysqli_query( $conn , $query1 );

        $query2 = "DELETE FROM marks WHERE classid='$classid' ";
        $res2 = mysqli_query( $conn , $query2 );

        $query3 = "DELETE FROM assessments WHERE classid = '$classid' ";
        $re3 = mysqli_query( $conn , $query3 );

        $query4 = "DELETE FROM students WHERE classid= '$classid' ";
        $res4 = mysqli_query( $conn , $query4 );

        // mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
            echo '<div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <center><p>Class deleted successfully</p></center>
                </div>
                <div id="counterr1"></div>
              </div>
            </div>
          </div>';
        }

    } elseif (isset($_POST['update_marks'])) {
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

    } elseif (isset($_POST['update_outof'])) {
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

// Fetch existing classes
$classes_result = mysqli_query($conn, "SELECT * FROM class ORDER BY class ASC");

// Fetching available subjects
$sql = "SELECT id, lesname FROM lesson";
$les = $conn->query($sql);
?>
<?php // include 'header.php';?>
 <title>Manage Classes</title>
    <style>
        
        .hidden { display: none; }
        .container { margin: ; width: 72%; }
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
        #profile{ display: none; overflow: auto; position: fixed; z-index: 1; left: 0; animation:fade 0.5s linear ; }

        @-webkit-keyframes fade {
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

        #info{ margin-right: 10px; overflow: auto; position: fixed; z-index: 2; right: 0; align-items: center; animation:fade 0.5s linear; }
        #info1{ margin-right: 10px; overflow: auto; position: fixed; z-index: 2; right: 0; align-items: center; animation:fade 0.5s linear; display:none; }
        #counterr{ margin-bottom: 0px; height: 2px; background: red; animation: progress 4s linear; };
        #counterr1{ margin-bottom: 0px; height: 2px; background: red; animation: progress 4s linear; };

        .nav{
            align-items: center;
            height: 65px;
            position: fixed;
            /* background: black; */
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            /* justify-content: space-between; */
            gap: 0rem;
            display: flex;
        }

        .nav.top{
            background-image:url('images/bg.jpeg');
            top: 0; 
        }

        .nav.bottom{
            background: black;
            bottom: 0;
        }

        .logos{
            align-items:center;
            margin: 3px;
            border-radius: 10px;
            height: 54px;
            width: 54px;
            background: grey;
            border-radius:10 px;
        }

        .logo{
            border-radius: 10px;
            margin: 2px;
            width:50px;
            height:50px;
        }

        .navtop-list{
            color: white;
            display: inline;
        }

        /* a{
            align-self:center;
            margin: 5px;
            color: white;
        } */

        .left1{
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            display: flex;
            float: left;
        }

        h3{
            color: white;
            font-size: x-large;
            font-weight: lighter;
            width: 100px;
        } 
        .entry {
                height: 40px;
                border-radius: 10px;
                border: none;
                padding-inline: 20px;
                scroll-padding-inline: 20px;
                padding-top: 12px;
                padding-right: 10px;
                padding-left: 10px;
                padding-bottom: 12px;
                line-height: 1.3;
                background: white;
                font-weight: 600;
                color: black;
                display: flex;
                width:120px;
                margin-left: 1%;
                transition: width 0.5s linear;
                border: 1px solid #03A9F4;
        }

        .entry:hover {
            border: 1px solid #007bff;
            width: 120px;
            border-radius: 10px;
        }

        .entry:focus{
            border:none;
            border-color:violet;
        }

        .entry:active{

            border: 2px solid violet;
        }

        .entry:placeholder-shown{
            color: black;
        }

        .profile2{
            right: 0;
            position: fixed;
            margin-right:18%;
            border-radius: 50%;
            float: left;
            height:55px;
            width: 55px;
            background: grey;
        }

        .profile1{
            right: 0;
            position: fixed;
            margin-right:27%;
            border-radius: 50%;
            float: left;
            height: 55px;
            width: 55px;
            background: grey;
        }

        #studentsContainer{
            height: 10px;
        }
        #studentsContainer::-webkit-scrollbar { width: 5px; background: transparent; scrollbar-color: blue; border: 1px solid rgba(255, 255, 255, 0.276); border-radius: 2px; }
        #studentsContainer::-webkit-scrollbar-thumb { border-radius: 1px; border: 1px solid blue; background-clip: content-box; background-color: blue; width: 5px; border-radius: 7px; }


    </style>
</head>
<body>

<div class="nav top" style="background:transparent;margin-left:50px;">
        <div class="left1" style="padding-left:10px;" style="margin-left:80px;">
            <div class="logos" style="margin-left: 0px;">
                <img class="logo" src="logo2.jpg" alt="logo">
            </div>
            <a href="new4.php"><h3>ESK MS</h3></a>
            <input type="text" class="entry" placeholder="Search for artists, songs, albums!">
        </div>
        <!-- <div class="right"> -->
            <div class="profile2" style="margin-right:50px;">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M12 9.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-1c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5zM13.22 3l.55 2.2.13.51.5.18c.61.23 1.19.56 1.72.98l.4.32.5-.14 2.17-.62 1.22 2.11-1.63 1.59-.37.36.08.51c.05.32.08.64.08.98s-.03.66-.08.98l-.08.51.37.36 1.63 1.59-1.22 2.11-2.17-.62-.5-.14-.4.32c-.53.43-1.11.76-1.72.98l-.5.18-.13.51-.55 2.24h-2.44l-.55-2.2-.13-.51-.5-.18c-.6-.23-1.18-.56-1.72-.99l-.4-.32-.5.14-2.17.62-1.21-2.12 1.63-1.59.37-.36-.08-.51c-.05-.32-.08-.65-.08-.98s.03-.66.08-.98l.08-.51-.37-.36L3.6 8.56l1.22-2.11 2.17.62.5.14.4-.32c.53-.44 1.11-.77 1.72-.99l.5-.18.13-.51.54-2.21h2.44M14 2h-4l-.74 2.96c-.73.27-1.4.66-2 1.14l-2.92-.83-2 3.46 2.19 2.13c-.06.37-.09.75-.09 1.14s.03.77.09 1.14l-2.19 2.13 2 3.46 2.92-.83c.6.48 1.27.87 2 1.14L10 22h4l.74-2.96c.73-.27 1.4-.66 2-1.14l2.92.83 2-3.46-2.19-2.13c.06-.37.09-.75.09-1.14s-.03-.77-.09-1.14l2.19-2.13-2-3.46-2.92.83c-.6-.48-1.27-.87-2-1.14L14 2z"></path></svg>
            </div>
            <div class="profile1" style="margin-right:140px;">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="fill: white; pointer-events: none; padding-top: 10px; padding-left: 10px; display: inherit; width: 80%; height: 80%;"><path d="M10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2zm10-2.65V19H4v-1.65l2-1.88v-5.15C6 7.4 7.56 5.1 10 4.34v-.38c0-1.42 1.49-2.5 2.99-1.76.65.32 1.01 1.03 1.01 1.76v.39c2.44.75 4 3.06 4 5.98v5.15l2 1.87zm-1 .42-2-1.88v-5.47c0-2.47-1.19-4.36-3.13-5.1-1.26-.53-2.64-.5-3.84.03C8.15 6.11 7 7.99 7 10.42v5.47l-2 1.88V18h14v-.23z"></path></svg>
            </div>
    </div>

<?php // include 'home.php';?>

<div class="moda fad" id="profile" style="width:100%;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h5 class="modal-title" id="exampleModalLabel">ADD NEW CLASS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <div class="modal-body">
            <form method="post" action="">
                <div class="form-group">
                    <label for="class_name">Class Name</label>
                    <input type="text" id="class_name" name="class_name" required>
                </div>
                <div class="form-group">
                    <label for="class_level">Class Level</label>
                    <input type="text" id="class_level" name="class_level" required>
                </div>
                <button type="submit" class="btn btn-info" name="new_class" onclick="dothis()" id="yes">Add Class</button>
            </form>
      </div>
	</div>
  </div>
</div>

<div id="info1" style="width:200px;">
    <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <center><p>Class deleted successfully</p></center>
                    </div>
                    <div id="counterr1"></div>
                </div>
                </div>
</div>

<!-- <div class="container-responsive"> -->
        <!-- <div class="row"> -->
            <!-- <div class="col-lg-8 offset-lg-2"> -->
                <!-- <div class="table-responsive"> -->
                    <div class="container" style="margin-top: 100px;">
    <ul>
        <li><h1 style="float:left;display:inline;margin-left:-20px;">Manage system</h1></li>
        <li><button class="btn btn-primary" id="trigger" onclick="jee()" style="float:right;margin-bottom:10px;display:inline;">Add class</button></li> <!-- data-toggle="modal" data-target="#profile" -->
    </ul><br><br><br>


    <!-- <form method="post" action="">
        <div class="form-group">
            <label for="class_name">Class Name</label>
            <input type="text" id="class_name" name="class_name" required>
        </div>
        <div class="form-group">
            <label for="class_level">Class Level</label>
            <input type="text" id="class_level" name="class_level" required>
        </div>
        <button type="submit" class="btn btn-primary" name="new_class">Add New Class</button>
    </form> -->

    <div id="gee" style ="min-width: 10rem; margin: 0 auto;padding-left: 1rem;">
     <h2>Available Classes</h2>
        <table class="table table-hover text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Class</th>
                <th scope="col">Level</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($classes_result)) { ?>
                <tr>
                    <td class = "td-sm"><?php echo $row['id']; ?></td>
                    <td class = "td-sm"><?php echo $row['class']; ?></td>
                    <td class = "td-sm"><?php echo $row['level']; ?></td>
                    <td class = "td-sm">
                        <button class="btn btn-info btn-sm" onclick="editTest('<?php echo $row['id']; ?>')" >EDIT<!--<i class="fa fa-pencil">--></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTest('<?php echo $row['id']; ?>')" >DELETE<!--<i class="fa fa-pencil">--></i></button>
                        <button class="btn btn-success btn-sm" onclick="showClassOptions('<?php echo $row['id']; ?>')" >&rarr;</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    
</div>
<div id="jese">
<div class="container hidden" id="classOptions">
    <h2>Class Options</h2>
    <button class="btn btn-primary" onclick="back()" style="float:right;">Back</button>
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

<div class="container hidden" id="studentsContainer" >
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

</div>

<?php //if (isset($sec) && isset($class) && isset($subject)): ?>
    <!-- <h2>Enter Marks</h2> -->
    <?php
        // $getQuery1 = "SELECT id, fname, lname, `$sec` FROM marks WHERE class = ? AND subject = ?";
        // $stmt1 = $conn->prepare($getQuery1);
        // $stmt1->bind_param("ss", $class, $subject);
        // $stmt1->execute();
        // $result1 = $stmt1->get_result();
        // $stmt1->close();

        // $select1 = "SELECT id , outof , class FROM assessments WHERE sec = ?";
        // $stmt2 = $conn->prepare($select1);
        // $stmt2->bind_param("i", $sec);
        // $stmt2->execute();
        // $ress1 = $stmt2->get_result();
        // $rowe = $ress1->fetch_assoc();
        // $stmt2->close();
    ?>
    
    <!-- <button id="editButton" onclick="toggleEdit()">Enable Editing</button> -->

    <!-- </table> -->
    <?php // endif; ?>

    <!-- <div class="container-responsive">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="table-responsive">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="served_by" name="served_by" value="<?php //echo $session_id; ?>" onkeydown="return false">
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
                                    // $sql = "SELECT * FROM class";
                                    // $result = $conn->query($sql);
                                    // if (mysqli_num_rows($result) > 0) {
                                    //     while ($row = mysqli_fetch_assoc($result)) {
                                    // ?>
                                    //         <option value="<?php //echo $row["class"]; ?>"> <?php //echo $row["class"]; ?> </option>
                                    // <?php // }
                                    // } ?>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="typofass" name="typofass" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Type of assessment</option>
                                    <option value="test">Test</option>
                                    <option value="exam">Exam</option>
                                </select>
                            </div> -->
                            <!-- <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="subject" name="subject" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Subject</option>
                                    <?php
                                    // $sql = "SELECT lesname FROM lesson";
                                    // $result = $conn->query($sql);
                                    // if (mysqli_num_rows($result) > 0) {
                                    //     while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option value="<?php //echo $row["lesname"]; ?>"> <?php echo $row["lesname"]; ?> </option>
                                    <?php// }
                                    //} ?>
                                </select>
                            </div> -->
                            <!-- <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="term" name="term" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Term</option>
                                    <option value="Term 1">Term 1</option>
                                    <option value="Term 2">Term 2</option>
                                    <option value="Term 3">Term 3</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select form-select-sm" aria-label=".form-select-md example" id="sec" name="sec" required style="width:100%;height:30px;border-radius:0%;background:lightgray;color:darkgray;display:inline;">
                                    <option selected value="" style="color:lightgray;">Assessment</option>
                                    <option value="Test 1">Test 1</option>
                                    <option value="Test 2">Test 2</option>
                                    <option value="Test 3">Test 3</option>
                                    <option value="Test 4">Test 4</option>
                                    <option value="Exam">Exam</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background:blue;">Filter</button>
                            </div>
                        </div>
                    </form> -->
                    <!-- <button id="editButton" onclick="toggleEdit()">Enable Editing</button> -->
                    <!-- <table class="table table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Student's name</th>
                                <th scope="col">Marks</th>
                            </tr>
                        </thead>
                        <tbody> -->
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
    


	// if (isset($_POST['submit'])){
	// 	$typofass = $_POST['typofass'];
	// 	$term = $_POST['term'];  
	// 	$class = $_POST['class'];
	// 	$level = $_POST['level'];
    //     $sec = $_POST['sec'];
    //     $subject = $_POST['subject'];

    //     $query = "SELECT sec , outof , id FROM assessments WHERE name = '$sec' AND term = '$term' AND subject = '$subject' ";
    //     $res = mysqli_query( $conn , $query );
    //     $rowe = mysqli_fetch_assoc($res);
    //     $yeah = $rowe['sec'];
    //     $prob = $rowe['outof']; 
    //     $id = $rowe['id'];
	
	// 	$getQuery = " SELECT id , fname , lname , `$yeah` FROM marks
	// 	WHERE  
	// 	class = '$class' 
	// 	AND level = '$level'
    //     AND subject = '$subject'
	// 	LIMIT  15 " ;//.$initial_page.' ,' .$limit ;

	// 	$result = mysqli_query($conn , $getQuery);
    //     $result1 = mysqli_query($conn , $query);
	// 	if( mysqli_num_rows($result) >0):?>
    <!-- //         <button id="editButton" class="btn btn-success" onclick="toggleEdit()" style="float:right;">Enable Editing</button> -->
             <?php
	// 		while($row = mysqli_fetch_assoc($result)): ?>
	<!-- // 			<tr class = "td-sm" >
	// 			<td class = "td-sm" ><?php //echo $row['id']; ?></td>
	// 			<td class = "td-sm" ><?php //echo $row['fname'].' '.$row['lname']; ?></td>
	// 			<td class = "td-sm" ><input type="text" class="non-editable" value="<?php //echo $row[$yeah]; ?>" oninput="validateMarks(this, '<?php // echo $outof; ?>')" onchange="updateMarks(this, '<?php //echo $row['fname']; ?>', '<?php //echo $row['lname']; ?>', '<?php //echo $yeah; ?>', '<?php //echo $subject; ?>', '<?php //echo $outof; ?>')" style="border-top:none !important;border-left:none !important;border-right:none !important;border-bottom:1px solid blue;background:lightgray;text-align:center;background-color:white;width:50px;color:black">
    //                 <span class="error-message"></span>
    //                 <span class="success-tick">&#10004;</span>
    //             </td>
	// 			</tr> -->
	 		<?php //endwhile ;
    //     endif;
	// }
	
	?>
                            <!-- Table body content goes here -->
                        <!-- </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="margin-right: 30px; border-radius: 10px;">
                Generate report
                </button>
                <form id="outofForm" style="float:right;">
                    <input type="hidden" name="test_id" value='<?php echo $id ;?>'>
                    <input type="hidden" name="class" value="<?php echo $class ;?>">
                    <label>Total : </label>
                    <input type="number" name="outof" id="outof" value="<?php echo $prob ;?>" onchange="updateOutof(this, '<?php echo $prob ;?>' )">
                    <span class="success-tick">&#10004;</span>
                </form>
            </div>
        </div>
    </div>
    <div class="pagination" style="text-align:center;"> -->
        <?php
        // for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
        //     echo '<a class="page-link" href="new2.php?page=' . $page_number . '"> ' . $page_number . '</a>';
        // }
        ?>
    </div>
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Generate_Report_Cards" style="margin-right: 30px; border-radius: 10px;">
        Generate report
    </button> -->

<script>

// function dodo(){}
// function jeeze(){}
function back(){
    document.getElementById('jese').style.display = 'none' ;
    document.getElementById('gee').style.display = 'block';
}

let currentClassId = null;

function showClassOptions(classId) {
    document.getElementById('gee').style.display = 'none';
    document.getElementById('jese').style.display = 'block';
    currentClassId = classId;
    document.getElementById('classOptions').classList.remove('hidden');
}

// document.getElementById('profile').style.display = 'none';

function jee(){
    var modal = document.getElementById('profile');
    var btn = document.getElementById('trigger');
    btn.onclick = function(){
        modal.style.display='block';
    }

    var span = document.getElementById('close');
    span.onclick = function(){
        modal.style.display = 'none';
    }
    
    window.onclick = function(event){
        if(event.target == modal){
            modal.style.display = 'none';
        }
    }
}

function reload(){
    history.go(0);
}

function dothis(){  
    var here = document.getElementById('info');
    here.style.animation = ' fad 0.5s linear ';

    var here10 = document.getElementById('info1');
    here10.style.animation = ' fad 0.5s linear ';
    here10.style.display= 'block';
}
setTimeout(dothis , 4000);

function fthis(){  
    var here = document.getElementById('info');
    here.style.display = 'none';
    var here = document.getElementById('counterr');
    here.style.width = '0%';

    var here1 = document.getElementById('info1');
    here1.style.display = 'none';
    var here2 = document.getElementById('counterr1');
    here2.style.width = '0%';
}
setTimeout(fthis , 4000);

function noti(just){
    const notification = document.getElementById('info');
    notification.innerHTML ='';
    notification.innerHTML +=`
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
                      <center><p>` +just+ `</p></center>
                </div>
                <div id="counterr"></div>
              </div>
            </div>
          </div>`;
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
    // document.getElementById('student_class_id').value = currentClassId;
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

function editst(id){
            // var display = document.getElementById('addst');
                fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'fetch_students': true,
                    'id': id
                })
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('studentsTable').querySelector('tbody');
                tbody.innerHTML = '';
                data.forEach(student => {
                    tbody.innerHTML += `
                        <tr>
                            <td><img src="passports/${student.dir}" style="width:50px;height:50px;border-radius:50%;"</td>
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
                    <td><img src="passports/${student.dir}" style="width:50px;height:50px;border-radius:50%;"</td>
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
                noti('Student dleted successfully');
            });
            document.location.href="new2.php";
    }
}

function editTest(testId) {
    const newClassName = prompt("Enter the new classname:");
    const newLname = prompt("Enter Level :");
    if (newClassName && newLname) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'classid': testId,
                'class': newClassName,
                'level' : newLname,
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
    if (confirm("Are you sure you want to delete this class?")) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'classid': testId,
                'delete_class': true
            })
        }).then(response => response.text())
            .then(data => {
                // alert(data);
                // document.location.href="new2.php";
                // fetchTests(currentClassId);
                // const notification = document.getElementById('info');
                // notification.innerHTML ='';
                // notification.innerHTML +=`
                //         <div class="moda fad" id="info" style="width:200px;">  <!--tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
                //         <div class="modal-dialog" role="document">
                //         <div class="modal-content">
                //             <div class="modal-header bg-primary text-light">
                //             <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                //             <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                //                 <span aria-hidden="true">&times;</span>
                //             </button>
                //             </div>
                //             <div class="modal-body">
                //                 <center><p>Class deleted successfully</p></center>
                //             </div>
                //             <div id="counterr"></div>
                //         </div>
                //         </div>
                //     </div>`;

            dothis();
            fthis();
            });
            setTimeout(() => {
                document.location.href="new2.php";
            }, 4000);

    }
}

// function mole(classId){
//     if (confirm("Are you sure you want to delete this class ?")) {
//         fetch('', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//             body: new URLSearchParams({
//                 'id': classId,
//                 'delete_class': true
//             })
//         }).then(response => response.text())
//             .then(data => {
//                 alert(data);
//                 // fetchTests(currentClassId);
//             });
//     }
// }
// function joo(classId){
//     const class = prompt("class name:");
//     const level = prompt("Level:");
//     if (newFname && newLname) {
//         fetch('', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//             body: new URLSearchParams({
//                 'classid': classId,
//                 'name': class,
//                 'level': level,
//                 'edit_class': true
//             })
//         }).then(response => response.text())
//             .then(data => {
//                 alert(data);
//                 // fetchStudents(currentClassId);
//             });
//     }
//}

// function toggleEdit() {
//     var elements = document.querySelectorAll('input[type="text"]');
//     elements.forEach(function(element) {
//         if (element.classList.contains('non-editable')) {
//             element.classList.remove('non-editable');
//             element.classList.add('editable');
//         } else {
//             element.classList.remove('editable');
//             element.classList.add('non-editable');
//         }
//     });

//     var button = document.getElementById('editButton');
//     if (button.textContent === 'Enable Editing') {
//         button.textContent = 'Lock Editing';
//         <?php //header("location:".$_SERVER['PHP_SELF']);?>
//     } else {
//         button.textContent = 'Enable Editing';
//     }
// }

//         function validateMarks(input, outof) {
//             var value = parseFloat(input.value);
//             var span = input.nextElementSibling;
//             if (value > outof) {
//                 span.textContent = 'Marks are out of limit';
//             } else {
//                 span.textContent = 'Done';
//             }
//         }

//         function updateMarks(input, fname, lname, sec, subject, outof) {
//             var value = parseFloat(input.value);
//             validateMarks(input, outof);

//             if (value <= outof) {
//                 var xhr = new XMLHttpRequest();
//                 xhr.open("POST", "<?php //echo $_SERVER['PHP_SELF']; ?>", true);
//                 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//                 xhr.onreadystatechange = function () {
//                     if (xhr.readyState === 4 && xhr.status === 200) {
//                         var response = JSON.parse(xhr.responseText);
//                         if (response.status === 'success') {
//                             var tick = input.parentElement.querySelector('.success-tick');
//                             tick.style.display = 'inline';
//                             // setTimeout(function() {
//                             //     tick.style.display = 'none';
//                             // }, 1000);
//                         } else {
//                             console.error(response.message);
//                         }
//                     }
//                 };
//                 var params = "update_marks=1&fname=" + encodeURIComponent(fname) +
//                              "&lname=" + encodeURIComponent(lname) +
//                              "&marks=" + encodeURIComponent(value) +
//                              "&subject=" + encodeURIComponent(subject) +
//                              "&sec=" + encodeURIComponent(sec);
//                 xhr.send(params);
//             }
//         }

//         function updateOutof(input, test_id) {
//             var new_outof = parseFloat(input.value);

//             var xhr = new XMLHttpRequest();
//             xhr.open("POST", "<?php //echo $_SERVER['PHP_SELF']; ?>", true);
//             xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//             xhr.onreadystatechange = function () {
//                 if (xhr.readyState === 4 && xhr.status === 200) {
//                     var response = JSON.parse(xhr.responseText);
//                     if (response.status === 'success') {
//                         var tick = input.parentElement.querySelector('.success-tick');
//                         tick.style.display = 'inline';
//                         history.go(0);
//                         setTimeout(function() {
//                             tick.style.display = 'none';
//                         }, 2000);
//                     }
//                 }
//             };
//             var params = "update_outof=1&new_outof=" + encodeURIComponent(new_outof) +
//                          "&test_id=" + encodeURIComponent(test_id);
//             xhr.send(params);
//         }
 
</script>
</body>
</html>