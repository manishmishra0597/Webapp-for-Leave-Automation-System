<?php

	$dbhost = 'localhost:3306'; 
	$dbuser = 'root'; 
	$dbpass = ''; 
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass); 
	if(! $conn ) { 
      die('Could not connect: ' . mysqli_error()); 
	} 
	$select_db = mysqli_select_db($conn,'interns');
	if(! $select_db)
	{
	die("database connection failed".mysqli_error($conn));
	}
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Area | View All Request</title>
	<link rel="icon" href="http://localhost/registration/logo.png">
    <!-- Bootstrap core CSS -->
    <link href="http://localhost/registration/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/registration/css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-default ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Employee Page</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="http://localhost/registration/employee.php">Dashboard</a></li>
            <li ><a href="http://localhost/registration/apply_for_leave.php">Short Leave</a></li>
			<li ><a href="http://localhost/registration/employee_full_leave.php">Full Leave</a></li>
            <li><a href="http://localhost/registration/employee_approved_request.php">Approved</a></li>
			<li><a href="http://localhost/registration/employee_pending_request.php">Pending</a></li>
			<li><a href="http://localhost/registration/employee_rejected_request.php">Rejected</a></li>
            <li class="active"><a href="http://localhost/registration/employee_view_all.php">View All</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome</a></li>
			<li><a href="http://localhost/registration/change_password.php">Change Password</a></li>
            <li><a class=btn href="http://localhost/registration/logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
          <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Dashboard<small>View All</small></h1>
            </div>
            
          </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li >Dashboard</li>
		  <li class="active">View All Leaves</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
           <div class="list-group ">
            <a href="#" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
			 <a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User ID<span class="badge"><?php echo $_COOKIE["id"]. "<br />";    ?></span></a>			
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Name<span class="badge"><?php echo $_COOKIE["name"] . "<br />"; ?></span></a>
       <a href="#" class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Approved Leaves<span class="badge">
			<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1' and status='approved'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			
			?>
			</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Pending Leaves<span class="badge">
			<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1' and status='pending'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			
			?>
			</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Rejected Leaves<span class="badge">
				<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1' and status='rejected'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			
			?>
			</span></a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> All Leaves<span class="badge">
				<?php
			$myid_1=$_COOKIE["id"];
			$myname=$_COOKIE["name"];
			$count=0;
				$sql="select user_id from apply_leave where user_id='$myid_1'";
				$result=mysqli_query($conn, $sql);
				while($user=mysqli_fetch_row($result))
				{
					$count++;
				}
				echo $count;
			
			?>
			</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Total Leaves Allowed<span class="badge">15</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Remaining Medical Leaves<span class="badge">
			<?php
			$count=5;
			$abc=0;
			$myid_1=$_COOKIE["id"];
			$sql5="select count_leave from apply_leave where type_of_leave='medical' and user_id='$myid_1' and status='approved'";
			$result5=mysqli_query($conn, $sql5);
			while($user=mysqli_fetch_row($result5))
			{
				$abc= $user[0];
			}
			$xyz= $count- $abc;
			if($xyz<0)
				echo 0;
			else
				echo $xyz;
			?>
			</span></a>
			<a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Remaining Non-Medical Leaves<span class="badge">
			<?php
			$count=10;
			$abc=0;
			$myid_1=$_COOKIE["id"];
			$sql5="select count_leave from apply_leave where type_of_leave='non_medical' and user_id='$myid_1' and status='approved'";
			$result5=mysqli_query($conn, $sql5);
			while($user=mysqli_fetch_row($result5))
			{
				$abc= $user[0];
			}
			$xyz= $count- $abc;
			if($xyz<0)
				echo 0;
			else
				echo $xyz;
			?>
			</span></a>
            </div>
          </div>
          
          <!-- Website Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">View All Requests</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-13">
                  <table class="table table-striped table-hover">
                  <tr>
                      <th>Type Of Leave</th>
                      <th>Concerned Manager</th>
                      <th>Time Of Leave</th>
					  <th>Date</th>
					  <th>Reason</th>
					  <th>Status</th>
                  </tr>
                  <?php
				  $myid_1=$_COOKIE["id"];
				  $myname=$_COOKIE["name"];
	$sql = "select type_of_leave, concerned_manager,time_of_leave, date, reason, status from apply_leave where user_id='$myid_1'";
	$record = mysqli_query($conn ,$sql );
			while($user=mysqli_fetch_assoc($record))
	{
		echo "<tr>";
		echo "<td>".$user['type_of_leave']."</td>";
		echo "<td>".$user['concerned_manager']."</td>";
		echo "<td>".$user['time_of_leave']."</td>";
		echo "<td>".$user['date']."</td>";
		echo "<td>".$user['reason']."</td>";
		echo "<td>".$user['status']."</td>";
		echo "</tr>";
}
	 mysqli_close($conn); 
	?>
				  
				  
                </table>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer id="footer">
        <p>Copyright  &copy; WESEE-ANNEXE | Developed by: Manish Mishra </p>

    </footer>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://localhost/registration/js/bootstrap.min.js"></script>
  </body>
</html>