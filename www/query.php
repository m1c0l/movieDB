<!DOCTYPE html>
<html>
<head>
  <title>CS143 Project 1A</title>
  <style>
    input[type=submit] {
      padding: 10px;
      margin: 10px;
    }
  </style>
</head>
<body>
  <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $mysqli = new mysqli('localhost', 'cs143', '', 'CS143');

    if (isset($_GET['query'])) {
      $query = $_GET['query'];
    }
    else {
      $query = '';
    }
  ?>

  <form method="GET">
    <textarea rows="10" cols="80" name="query"><?php echo $query ?></textarea>
    <br>
    <input type="submit" value="Submit">
  </form>

  <?php
    if ($query) {
      $result = $mysqli->query($query);
      if ($result) {
        if ($result->num_rows == 0) {
          echo '<p>No Results</p>';
        }
        else {
          ?>
          <br>
          <table border="1" cellspacing="1" cellpadding="2">
            <tr>
            <?php
              // result schema
              $fields = $result->fetch_fields();
              foreach ($fields as $f) {
              echo '<th>' . $f->name . '</th>';
              }
            ?>
            </tr>

            <?php
              // result records
              while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                  foreach ($row as $key => $val) {
                    if (!$val) $val = 'N/A';
                    echo '<td>' . $val . '</td>';
                  }
                echo '</tr>';
              }
            ?>

          </table>

        <?php
        }
      }
      else {
        echo '<p>Invalid Query</p>';
      }
    }
  ?>
  </body>
</html>
