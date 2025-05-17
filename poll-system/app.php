<!-- Simple Voting System
💡 Description:
Users can vote on options (like polls). A chart displays the result. Useful for testing form handling and data display.

🔧 Features:
Login (or guest voting)

Poll display with voting form

Record vote in MySQL

Show results in a chart (optional)

Prevent multiple votes with sessions -->

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

    if ($user && $password === $user['password']) {
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
  } else if ($_POST['action'] === 'vote') {
    $poll_id = $_POST['poll_id'];
    $option_id = $_POST['option_id'] ?? null;

    if (isset($_SESSION['voted'][$poll_id])) {
      $error = 'You have already voted for this poll.';
    } else {
      $stmt = $pdo->prepare('INSERT INTO votes (poll_id, option_id, user_id) VALUES (?, ?, ?)');
      $stmt->execute([$poll_id, $option_id, $_SESSION['user_id']]);
      $_SESSION['voted'][$poll_id] = true;
      header('Location: app.php');
      exit;
    }
  }
}

$stmt = $pdo->query('SELECT * FROM polls WHERE id = 1');
$poll = $stmt->fetch();
$stmt = $pdo->prepare('SELECT * FROM options WHERE poll_id = ?');
$stmt->execute([$poll['id']]);
$options = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Poll System</title>
</head>

<body>
  <div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded p-6">
      <?php if (isset($_SESSION['user_id'])): ?>
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
          <form method="POST" class="mb-6">
            <input type="hidden" name="action" value="logout">
            <button type="submit"
              class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 hover:cursor-pointer">Logout</button>
          </form>
        </div>

        <h2 class="text-xl font-bold mb-4"><?php echo htmlspecialchars($poll['title']); ?></h2>
        <?php if (isset($error)): ?>
          <p class="text-red-500 mb-4"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST">
          <input type="hidden" name="action" value="vote">
          <input type="hidden" name="poll_id" value="<?php echo $poll['id']; ?>">
          <?php foreach ($options as $option): ?>
            <div class="mb-4">
              <label class="inline-flex items-center">
                <input type="radio" name="option_id" value="<?php echo $option['id']; ?>"
                  class="form-radio text-blue-500 hover:cursor-pointer">
                <span class="ml-2 hover:cursor-pointer"><?php echo htmlspecialchars($option['text']); ?></span>
              </label>
            </div>
          <?php endforeach; ?>
          <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 hover:cursor-pointer">Vote</button>
        </form>

        <h3 class="text-lg font-bold mt-6">Results:</h3>
        <?php
        $stmt = $pdo->prepare('SELECT options.text, COUNT(votes.id) as vote_count FROM options LEFT JOIN votes ON options.id = votes.option_id WHERE options.poll_id = ? GROUP BY options.id');
        $stmt->execute([$poll['id']]);
        $results = $stmt->fetchAll();

        foreach ($results as $result): ?>
          <div class="mb-2">
            <p class="font-medium"><?php echo htmlspecialchars($result['text']); ?>: <?php echo $result['vote_count']; ?>
              votes</p>
            <div class="w-full bg-gray-200 rounded-full h-4">
              <div class="bg-blue-500 h-4 rounded-full"
                style="width: <?php echo ($result['vote_count'] / array_sum(array_column($results, 'vote_count'))) * 100; ?>%;">
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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
