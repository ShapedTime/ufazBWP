<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PW3: Student Timetable</title>
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
        mysqli_set_charset($conn, "utf8");
    ?>
    <h2>Student timetable query</h2>
    <?
        $query="SELECT classes.class_full_name, subjects.subject, professors.first_name, professors.last_name FROM courses WHERE courses.class_id = classes.class_id AND courses.subject_id = subjects.subject_id AND courses.professor_id = professors.professor_id";
        $procquery = mysqli_query($conn, $query) or die("Error in fetching query");
        echo "Number of rows for the query is: ".mysqli_num_rows($procquery);
    ?>
    <h1>Objective N2: HTML displayed results</h1>
    <h2>HTML table to display the results</h2>

</body>
</html>