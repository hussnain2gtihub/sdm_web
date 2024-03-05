<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    $username = 'Username not received';
}
echo "Username: " . $username;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply Form</title>
</head>
<body>
    <h2>Reply Form for <?php echo $username; ?></h2>
</body>
</html>
