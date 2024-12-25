// start for get time

const timeElement = document.querySelector(".time");
const dateElement = document.querySelector(".date");

function formatTime(date) {
  const hours12 = date.getHours() % 12 || 12;
  const minutes = date.getMinutes();
  const isAm = date.getHours() < 12;

  return `${hours12.toString().padStart(2, "0")}:${minutes
    .toString()
    .padStart(2, "0")} ${isAm ? "AM" : "PM"}`;
}

function formatDate(date) {
  const DAYS = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
  ];
  const MONTHS = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];

  return `${DAYS[date.getDay()]}, ${
    MONTHS[date.getMonth()]
  } ${date.getDate()} ${date.getFullYear()}`;
}

setInterval(() => {
  const now = new Date();

  timeElement.textContent = formatTime(now);
  dateElement.textContent = formatDate(now);
}, 200);

// end for get time


//for sidebar collapse
  document.addEventListener('DOMContentLoaded', () => {
    const iconSidebar = document.querySelector('.icon_sidebar');
    const containerNavbar = document.querySelector('.container');

    iconSidebar.addEventListener('click', () => {
      containerNavbar.classList.toggle('collapse');
    });
  });


// for tasks
document.addEventListener('DOMContentLoaded', () => {
  const taskInput = document.getElementById('taskInput');
  const addTaskButton = document.getElementById('addTaskButton');
  const taskList = document.getElementById('taskList');
  const completedList = document.getElementById('completedList');
  const dismissedList = document.getElementById('dismissedList');
  const dateInput = document.getElementById('taskDate');
  const timeInput = document.getElementById('taskTime');
  const timeData = document.querySelector('.time_data');

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
  const createTask = (taskText, date, time) => {
    const task = document.createElement('div');
    task.classList.add('task');
    task.innerHTML = `
      <p>${taskText} (${date} ${time})</p>
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
    const date = dateInput.value;
    const time = timeInput.value;

    if (taskText === '') {
      alert('Please enter a task!');
      return;
    }

    const task = createTask(taskText, date, time);
    taskList.appendChild(task);

    // Clear the input fields
    taskInput.value = '';
    dateInput.value = '';
    timeInput.value = '';
  });

  // Allow pressing Enter to add a task
  taskInput.addEventListener('keypress', (event) => {
    if (event.key === 'Enter') {
      addTaskButton.click();
    }
  });

  // Show datetime inputs when task input is focused
  taskInput.addEventListener('focus', () => {
    timeData.style.display = 'block';
    taskInput.style.borderBottomLeftRadius = '0';
    addTaskButton.style.borderBottomRightRadius = '0';
  });
});
