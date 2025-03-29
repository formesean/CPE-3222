<?php

session_start();

if (!isset($_SESSION["address_book"])) {
    $_SESSION["address_book"] = array();
}

function addMember($firstName, $lastName, $address, $phone) {
    $_SESSION["address_book"][] = [
        "first_name"=> $firstName,
        "last_name" => $lastName,
        "address" => $address,
        "phone" => $phone
    ];
}

function searchMember($query) {
  $results = [];

  foreach ($_SESSION["address_book"] as $index => $member) {
    if (stripos($member["first_name"], $query) !== false ||
        stripos($member["last_name"], $query) !== false ||
        stripos($member["address"], $query) !== false ||
        stripos($member["phone"], $query) !== false) {
      $results[$index] = $member;
    }
  }
  return $results;
}

function deleteMember($index) {
    if (isset($_SESSION['address_book'][$index])) {
        unset($_SESSION['address_book'][$index]);
    }
    $_SESSION['address_book'] = array_values($_SESSION['address_book']);
}

function editMember($index, $firstName, $lastName, $address, $phone) {
  if (isset($_SESSION["address_book"][$index])) {
    $_SESSION["address_book"][$index] = [
      'first_name' => $firstName,
      'last_name' => $lastName,
      'address' => $address,
      'phone' => $phone
    ];
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["add"])) {
    $firstName = $_POST["first_name"] ?? "";
    $lastName = $_POST["last_name"] ?? "";
    $address = $_POST["address"] ?? "";
    $phone = $_POST["phone"] ?? "";
    addMember($firstName, $lastName, $address, $phone);
  }

  if (isset($_POST["search"])) {
    $query = $_POST["search_query"] ?? "";
    $results = searchMember($query);
  }

  if (isset($_POST["delete"])) {
    $index = $_POST["delete_index"] ?? -1;
    deleteMember($index);
  }

  if (isset($_POST["edit"])) {
    $index = $_POST["edit_index"] ?? -1;
    $firstName = $_POST["edit_first_name"] ?? "";
    $lastName = $_POST["edit_last_name"] ?? "";
    $address = $_POST["edit_address"] ?? "";
    $phone = $_POST["edit_phone"] ?? "";
    editMember($index, $firstName, $lastName, $address, $phone);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Address Book</title>
</head>
<body>
  <h2>Address Book</h2>

  <form method="POST">
    <h3>Add Member</h3>
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required><br>
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required><br>
    <label for="address">Address:</label>
    <input type="text" name="address" required><br>
    <label for="phone">Phone:</label>
    <input type="text" name="phone" required><br>
    <button type="submit" name="add">Add Member</button>
  </form>

  <hr>

  <form method="POST">
    <h3>Search Member</h3>
    <label for="search_query">Search:</label>
    <input type="text" name="search_query" required><br>
    <button type="submit" name="search">Search Member</button>
  </form>

  <?php if (isset($results) && !empty($results)): ?>
    <h3>Search Results</h3>
    <ul>
      <?php foreach ($results as $index => $member): ?>
        <li>
          <?php
            echo "{$member['first_name']} {$member['last_name']} - {$member['address']} - {$member['phone']}";
          ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php elseif (isset($results)): ?>
    <p>No results found.</p>
  <?php endif; ?>

  <hr>

  <h3>Members</h3>
  <ul>
    <?php foreach ($_SESSION["address_book"] as $index => $member): ?>
      <li>
        <?php
          echo "{$member['first_name']} {$member['last_name']} - {$member['address']} - {$member['phone']}";
        ?>

        <form method="POST" style="display:inline;">
          <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
          <button type="submit" name="delete">Delete</button>
        </form>

        <form method="POST" style="display:inline;">
          <input type="hidden" name="edit_index" value="<?php echo $index; ?>">
          <input type="text" name="edit_first_name" value="<?php echo $member["first_name"]; ?>" required>
          <input type="text" name="edit_last_name" value="<?php echo $member["last_name"]; ?>" required>
          <input type="text" name="edit_address" value="<?php echo $member["address"]; ?>" required>
          <input type="text" name="edit_phone" value="<?php echo $member["phone"]; ?>" required>
          <button type="submit" name="edit">Edit</button>
        </form>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
