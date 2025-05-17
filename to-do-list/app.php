<!-- To-Do List with User Login
💡 Description:
A task-tracking app where users can log in, add tasks, mark them done, and delete them.

🔧 Features:
User login/logout (PHP sessions)

Add/update/delete tasks (CRUD with MySQL)

Mark tasks as complete

Filter by status (optional)

UI with basic CSS -->

<?php
session_start();
require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST' && isset($_POST['action'])) {
  if ($_POST['action'] === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $user['password']) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header('Location: app.php');
      exit;
    } else {
      $error = 'Invalid username or password';
    }
  } else if ($_POST['action'] === 'logout') {
    session_destroy();
    header('Location: app.php');
    exit;
  }
}

if ($method == 'POST' && isset($_POST['action'])) {
  if ($_POST['action'] === 'add_task') {
    $title = $_POST['task_title'];
    $description = $_POST['task_description'];

    $stmt = $pdo->prepare('INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $title, $description]);
    header('Location: app.php');
    exit;
  } else if ($_POST['action'] === 'toggle_status') {
    $taskid = $_POST['task_id'];
    $stmt = $pdo->prepare('UPDATE tasks SET status = IF(status = "completed", "pending", "completed") WHERE id = ? AND user_id = ?');
    $stmt->execute([$taskid, $_SESSION['user_id']]);
    header('Location: app.php');
    exit;
  } else if ($_POST['action'] === 'delete_task') {
    $taskid = $_POST['task_id'];
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');
    $stmt->execute([$taskid, $_SESSION['user_id']]);
    header('Location: app.php');
    exit;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>To-Do List</title>
</head>

<body>
  <div class="container mx-auto p-4">
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="bg-white shadow-md rounded p-6">
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
          <form method="POST" class="mb-6">
            <input type="hidden" name="action" value="logout">
            <button type="submit"
              class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 hover:cursor-pointer">Logout</button>
          </form>
        </div>

        <h2 class="text-xl font-semibold mb-4">To-Do List</h2>

        <!-- Add Task Form -->
        <form method="POST" class="bg-gray-50 p-4 rounded shadow mb-6">
          <input type="hidden" name="action" value="add_task">
          <div class="mb-4">
            <label for="task_title" class="block text-sm font-medium text-gray-700">Task Title:</label>
            <input type="text" id="task_title" name="task_title" required
              class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-4">
            <label for="task_description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea id="task_description" name="task_description"
              class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
          <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 hover:cursor-pointer">Add Task</button>
        </form>

        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold">Your Tasks</h3>
          <form method="GET" class="flex items-center">
            <label for="status_filter" class="mr-2 text-sm font-medium text-gray-700">Filter:</label>
            <select name="status" id="status_filter"
              class="p-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
              onchange="this.form.submit()">
              <option value="all" <?php echo (!isset($_GET['status']) || $_GET['status'] === 'all') ? 'selected' : ''; ?>>
                All</option>
              <option value="completed" <?php echo (isset($_GET['status']) && $_GET['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
              <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
            </select>
          </form>
        </div>
        <ul class="space-y-4">
          <?php
          $status_filter = $_GET['status'] ?? 'all';

          if ($status_filter === 'completed' || $status_filter === 'pending') {
            $stmt = $pdo->prepare('SELECT * FROM tasks WHERE user_id = ? AND status = ?');
            $stmt->execute([$_SESSION['user_id'], $status_filter]);
          } else {
            $stmt = $pdo->prepare('SELECT * FROM tasks WHERE user_id = ?');
            $stmt->execute([$_SESSION['user_id']]);
          }

          $tasks = $stmt->fetchAll();

          foreach ($tasks as $task): ?>
            <li class="bg-white p-4 rounded shadow flex items-center justify-between">
              <div class="flex items-center">
                <form method="POST" class="mr-4">
                  <input type="hidden" name="action" value="toggle_status">
                  <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                  <button type="submit"
                    class="hover:cursor-pointer text-2xl <?php echo $task['status'] === 'completed' ? 'text-green-500' : 'text-red-500'; ?>">
                    <?php echo $task['status'] === 'completed' ? '✔' : '✖'; ?>
                  </button>
                </form>
                <div>
                  <p class="font-medium <?php echo $task['status'] === 'completed' ? 'line-through text-gray-500' : ''; ?>">
                    <?php echo htmlspecialchars($task['title']); ?>
                  </p>
                  <p class="text-sm text-gray-600"><?php echo htmlspecialchars($task['description']); ?></p>
                </div>
              </div>
              <form method="POST">
                <input type="hidden" name="action" value="delete_task">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <button type="submit"
                  class="hover:cursor-pointer bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
              </form>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php else: ?>
      <?php if (isset($error)): ?>
        <p class="text-red-500 mb-4"><?php echo htmlspecialchars($error); ?></p>
      <?php endif; ?>
      <div class="flex justify-center items-center">
        <form method="POST" class="bg-white shadow-md rounded p-6 w-3xl mx-auto">
          <h1 class="text-2xl font-bold mb-4">Login</h1>
          <input type="hidden" name="action" value="login">
          <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
            <input type="text" id="username" name="username" required
              class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
            <input type="password" id="password" name="password" required
              class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
          </div>
          <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 hover:cursor-pointer">Login</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>
