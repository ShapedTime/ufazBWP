<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PW3</title>
</head>
<body>
    <h1>Objective N1: PHP mysqli queries</h1>
    <h2>Database connection</h2>
    <? 
        ini_set('display_errors', '1');
        $host="mysql-teymurufaz.alwaysdata.net";
        $user="169542";
        $pass="teymurufaz";
        $db="teymurufaz_bwp";
        $conn=mysqli_connect($host, $user, $pass, $db) or die("Failed to connect to database");
    ?>
</body>
</html>