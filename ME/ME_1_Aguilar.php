<!-- Write a PHP script that generates a multiplication table from 1 to 12 using nested loops and a multi-dimensional array. The table should be printed in an HTML table format.

The table should be styled using CSS to highlight the diagonal (1x1, 2x2, etc.) with a different background color. -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multiplication Table</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    .row-head, .col-head {
      background-color: pink;
    }

    .diagonal {
      background-color: lightgray;
    }
  </style>
</head>
<body>
  <h1>Multiplication Table (1 to 12)</h1>

  <table>
    <thead>
      <tr>
        <th></th>
        <?php for ($i = 1; $i <= 12; $i++): ?>
          <th class="col-head"><?php echo $i; ?></th>
        <?php endfor; ?>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 1; $i <= 12; $i++): ?>
        <tr>
          <th class="row-head"><?php echo $i; ?></th>
          <?php for ($j = 1; $j <= 12; $j++): ?>
            <td class="<?php echo ($i == $j) ? 'diagonal' : ''; ?>">
              <?php echo $i * $j; ?>
            </td>
          <?php endfor; ?>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</body>
</html>
