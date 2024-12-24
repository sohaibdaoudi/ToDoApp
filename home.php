<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Ensure the user is logged in
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
    }
}else{
    header('Location: login-user.php'); // Redirect to login if session is invalid
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

<div class="container_navbar">
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
        <p>Username</p>
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
    <div class="task_input">
      <input type="text" id="taskInput" placeholder="Add a new task..." />
      <button id="addTaskButton">Add</button>
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
	

<script>
//for sidebar collapse
  document.addEventListener('DOMContentLoaded', () => {
    const iconSidebar = document.querySelector('.icon_sidebar');
    const containerNavbar = document.querySelector('.container_navbar');

    iconSidebar.addEventListener('click', () => {
      containerNavbar.classList.toggle('collapse');
    });
  });


  document.addEventListener('DOMContentLoaded', () => {
    const taskInput = document.getElementById('taskInput');
    const addTaskButton = document.getElementById('addTaskButton');
    const taskList = document.getElementById('taskList');
    const completedList = document.getElementById('completedList');
    const dismissedList = document.getElementById('dismissedList');

    // Make sections collapsible
    const collapsibleHeaders = document.querySelectorAll('.collapsible');
    collapsibleHeaders.forEach(header => {
      header.addEventListener('click', () => {
        const nextElement = header.nextElementSibling;
        header.classList.toggle('active');
        nextElement.style.display = nextElement.style.display === 'none' || !nextElement.style.display ? 'block' : 'none';
      });
    });

    // Function to create a new task
    const createTask = (taskText) => {
      const task = document.createElement('div');
      task.classList.add('task');
      task.innerHTML = `
        <span>${taskText}</span>
        <div>
          <button class="complete">Completed</button>
          <button class="dismiss">Dismissed</button>
        </div>
      `;

      // Add "Completed" functionality
      task.querySelector('.complete').addEventListener('click', () => {
        task.remove();
        const completedTask = task.cloneNode(true);
        completedTask.querySelector('.complete').remove(); // Remove "Completed" button
        completedTask.querySelector('.dismiss').remove(); // Remove "Dismissed" button
        completedList.appendChild(completedTask);
      });

      // Add "Dismissed" functionality
      task.querySelector('.dismiss').addEventListener('click', () => {
        task.remove();
        const dismissedTask = task.cloneNode(true);
        dismissedTask.querySelector('.complete').remove(); // Remove "Completed" button
        dismissedTask.querySelector('.dismiss').remove(); // Remove "Dismissed" button
        dismissedList.appendChild(dismissedTask);
      });

      return task;
    };

    // Add a new task when clicking the "Add" button
    addTaskButton.addEventListener('click', () => {
      const taskText = taskInput.value.trim();
      if (taskText === '') {
        alert('Please enter a task!');
        return;
      }

      const task = createTask(taskText);
      taskList.appendChild(task);

      // Clear the input
      taskInput.value = '';
    });

    // Allow pressing Enter to add a task
    taskInput.addEventListener('keypress', (event) => {
      if (event.key === 'Enter') {
        addTaskButton.click();
      }
    });
  });



</script>

</body>
</html>
