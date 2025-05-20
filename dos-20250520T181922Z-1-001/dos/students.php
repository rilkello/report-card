<?php
include 'header.php';
?>
<style>
hr{
	width:90%;
}
</style>
<body>
    <?php
        include 'nav.php';
    ?>
<div class="table table table-hover text-center" style="margin-left:5%;width:90%;padding:10px;border-radius:10px;">
<table id="pager" class="table table table-hover text-center" cellspacing="0" style="align:center;border-radius:10px;">
  <thead class="table thead-dark">
    <tr>
	  <th class="th-sm">
	  number
      </th>
      <th class="th-sm">
	  Student's name
      </th>
      <th class="th-sm">
	  Class
      </th>
	  </tr>
  </thead>
  <tbody style="background-color:lightgray;">

<?php
$limit = 2;
include ('config/db.php');
$getQuery = " SELECT * from students ";
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
if(!isset($_POST['submit'])){
	$getQuery = " SELECT * from students ";
}
getData($getQuery);
?>
<?php

function getData($getQuery){
	include ('config/db.php');
	$result = mysqli_query($conn , $getQuery);
	if( mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			echo '<tr class = "td-sm" >
            <td class = "td-sm" >'.$row['id'].'</td>
            <td class = "td-sm" >'.$row['fname'].' '.$row['lname'].'</td>
            <td class = "td-sm" >'.$row['class'].'</td>
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
<div id="page" class="pagination" style="position:flex;margin-left:5%;float:left">
	<?php
	for($page_number = 1 ; $page_number<=$total_pages; $page_number ++){
		echo '<a class="page-link" href="students.php?page = '.$page_number.'"> '.$page_number.'</a>' ;
	}
	?>
</div>
<button class="btn btn-danger" style="float:right;margin-right:30px;border:none !important;border-radius:10px;"><a href="index.php?addstudent">add student</a></button>
</body>
</html>
</body>
</html>