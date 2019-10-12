<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PW3: Student Timetable</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.20/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
    <style>
        .trig-table{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .trig-table th{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .trig-table td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
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
        $query="SELECT classes.class_full_name, subjects.subject, professors.first_name, professors.last_name, courses.course_date, courses.start_time, courses.end_time, courses.course_duration FROM courses, classes, subjects, professors WHERE courses.class_id = classes.class_id AND courses.subject_id = subjects.subject_id AND courses.professor_id = professors.professor_id";
        $procquery = mysqli_query($conn, $query) or die("Error in fetching query");
        echo "Number of rows for the query is: ".mysqli_num_rows($procquery);
    ?>
    <h1>Objective N2: HTML displayed results</h1>
    <h2>HTML table to display the results</h2>
        <table class="trig-table" id="myTable">
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
                while($res=mysqli_fetch_assoc($procquery)){
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

</body>
</html>