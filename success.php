<?php
if (!empty($_GET['tid'] && !empty($_GET['product']))) {
  $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

  $tid = $GET['tid'];
  $product = $GET['product'];
} else {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Thank you!</title>
</head>

<body>
  <div class="container mt-4">
    <h2>Thank you for being with us, asshole!</h2>
    <h3>Your <?php echo $product; ?> will be delivered never.</h3>
    <p>Your transaction ID is <?php echo $tid ?></p>
    <p>Check you email for more details.</p>
    <p><a href="index.php" class="btn btn-light mt-2">Go to hell</p>
  </div>
</body>

</html>