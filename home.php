<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Ensure the user is logged in and get the name of user
if($email != false && $password != false){
  $sql = "SELECT * FROM usertable WHERE email = '$email'";
  $run_Sql = mysqli_query($con, $sql);
  if($run_Sql){
      $fetch_info = mysqli_fetch_assoc($run_Sql);
      $name = $fetch_info['name'];
  }
}else{
  header('Location: login-user.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home page</title>
	<link rel="stylesheet" href="style_home.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>
<body>

<div class="container">
  <div class="navbar">
    <div class="icon_sidebar">
       <div class="one"></div>
       <div class="two"></div>
       <div class="three"></div>
    </div>
    <div class="welcome">
      <div class="logo">
        <img src="images/LOGO.png">
        <p>Do It</p>
    </div>
     <ul>
        <p><?php echo htmlspecialchars($name);?></p>
        <li>
          <a href="#">
            <i class="fas fa-user"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fas fa-bell"></i>
          </a>
        </li>
        <li>
          <a href="logout-user.php">
          <i class="fa-solid fa-right-from-bracket"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="sidebar">
      <ul>
        <li><a href="#">
          <span class="icon"><i class="fa-solid fa-calendar-day"></i></span>
          <span class="title">My day</span></a></li>
        <li><a href="#">
          <span class="icon"><i class="fa-regular fa-star"></i></span>
          <span class="title">Important</span>
          </a></li>
        <li><a href="#">
          <span class="icon"><i class="fa-solid fa-list-check"></i></span>
          <span class="title">Tasks</span>
          </a></li>
    </ul>
  </div>
  
  <div class="main_container">

    <div class="first-line">
      <div class="datetime">
        <h1 style="font-weight:normal">My Day</h1>
        <div class="date"></div>
        <div class="time"></div>
      </div>
    </div>
    
    <div class="line"></div>
   
    <div class="task_input">
      <input type="text" id="taskInput" placeholder="Add a new task..." />
      <button id="addTaskButton">Add</button>
    </div>
    
    <div class="time_data" style="display: none;">
      <input type="date" id="taskDate" />
      <input type="time" id="taskTime" />
    </div>

  

    <div class="task_list" id="taskList">
      <!-- Tasks will appear here -->
    </div>
  
    <h3 class="collapsible">Completed Tasks</h3>
    <div class="completed_list" id="completedList">
      <!-- Completed tasks will appear here -->
    </div>
  
    <h3 class="collapsible">Dismissed Tasks</h3>
    <div class="dismissed_list" id="dismissedList">
      <!-- Dismissed tasks will appear here -->
    </div>
  </div>
  
  
  
  
</div>
	

<script src="homepage.js"></script>

</body>
</html>
