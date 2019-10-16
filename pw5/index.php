<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PW5: Student Timetable</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.20/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</head>
<body>
    <h1>Objective N1: PHP mysqli object</h1>
    <? 
        ini_set('display_errors', '1');
        $host="mysql-teymurufaz.alwaysdata.net";
        $user="169542";
        $pass="teymurufaz";
        $db="teymurufaz_bwp";
        $conn=new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    ?>
    <?
        $query="SELECT classes.class_full_name, subjects.subject, professors.first_name, professors.last_name, courses.course_date, courses.start_time, courses.end_time, courses.course_duration FROM courses, classes, subjects, professors WHERE courses.class_id = classes.class_id AND courses.subject_id = subjects.subject_id AND courses.professor_id = professors.professor_id";
        $procquery = $conn->query($query);
        echo "Number of rows for the query is: ".$procquery->num_rows;
    ?>
    <table id="myTable">
        <thead>
            <tr>
                <th>Date of course</th>
                <th>Starting Time</th>
                <th>Ending Time</th>
                <th>Course duration</th>
                <th>Class name</th>
                <th>Subject name</th>
                <th>Professor name</th>
            </tr>
        </thead>
        <tbody>
        <?
            while($res=$procquery->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$res["course_date"]."</td>";
                echo "<td>".$res["start_time"]."</td>";
                echo "<td>".$res["end_time"]."</td>";
                echo "<td>".$res["course_duration"]."</td>";
                echo "<td>".$res["class_full_name"]."</td>";
                echo "<td>".$res["subject"]."</td>";
                echo "<td>".$res["first_name"]." ".$res["last_name"]."</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>

    <h1>Objective N2: importing CSV data with mysqli object prepared statement and bind parameters</h1>
    <?
        $query = "SELECT * FROM customers";
        $procquery = $conn->query($query);
        if($procquery->num_rows = 0){
            $datagen = fopen("./datagen.csv", "r");
            $d=fgetcsv($datagen, 1000, ';');
            while($d=fgetcsv($datagen, 1000, ';')){
                $query = "INSERT INTO customers (customer_id, customerTitle, customerLastname, customerFirstname, customerStreetAddress, customerStreetAddress2, customerZipCode, customerCity, customerPhone, customerEmail, customerRegisterDate) VALUES ($d[0], $d[1], $d[2], $d[3], $d[4], $d[5], $d[6], $d[7], $d[8], $d[9], $d[10])";
                $procquery = $conn->query($query);
            }
        }
    ?>

</body>
</html>