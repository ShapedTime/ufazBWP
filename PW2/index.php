<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PW2</title>
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
</head>
<body>
    <h1>PW1: Objective 4</h1>
    <h2>Trigonometric Table</h2>
    <table class="trig-table">
        <tr>
            <th>Deg</th>
            <th>Rad</th>
            <th>sin</th>
            <th>cos</th>
            <th>tan</th>
            <th>cotan</th>
        </tr>
        <?
            for ($i=0; $i <= 90; $i++) { 
                echo "<tr>";
                    echo "<td>".$i."</td>";
                    $radi=deg2rad($i);
                    echo "<td>".$radi."</td>";
                    echo "<td>".sin($radi)."</td>";
                    echo "<td>".cos($radi)."</td>";
                    echo "<td>".tan($radi)."</td>";
                    echo "<td>".tanh($radi)."</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <h1>PW2: Objective 1</h1>
    <h2>PHP Date and Time functions</h2>
    <h3>1</h3>
    <p>dd/mm/YYYY: </p>
    <? echo date('d/m/Y'); ?>
    <p>YYYY-mm-dd: </p>
    <? echo date('Y-m-d'); ?>
    <h3>2</h3>
    <p>Current timestamp</p>
    <? echo time(); ?>
    <p>24 hour before's timestamp</p>
    <? echo date('d/m/Y - H:i:s', time()-24*3600); ?>
    <h3>3</h3>
    <p>Timestamp of my next birthday (August 7th 2020)</p>
    <? echo mktime(0, 0, 0, 8, 7, 2020); ?>
    <p>Day of the week will be:</p>
    <? echo date("l", mktime(0, 0, 0, 8, 7, 2020)); ?>
    <h3>4</h3>
    <p>My Birthday: </p>
    <? echo strtotime("2000-08-07"); ?>
    <p>My birthday +1 day + 1 month: </p>
    <? echo strtotime("2000-08-07 + 1 day +1 month"); ?>
    <h3>5</h3>
    <?
        for ($i=1; $i <= 12; $i++) { 
            echo "<p>".$i." month(s) after this day</p>";
            echo strtotime("+".$i." month");
        }
    ?>
    <h3>6</h3>
    <?
        echo date('l, jS F Y');
        setlocale(LC_ALL, 'fr_FR');
        echo "<br>";
        echo strftime('%A, %e %B %Y')
    ?>
    <h2>Objective N2: PHP String functions</h2>
    <h3>1</h3>
    <? $ob1_1 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut vulputate eros. Curabitur aliquam pulvinar tellus. Fusce egestas ac tellus a malesuada. Sed rhoncus turpis libero, id iaculis purus ultrices consectetur. Fusce egestas odio eu tellus sagittis, nec congue mauris dapibus. Ut nec risus ipsum. Nullam eu quam quis sem varius consequat. Curabitur semper porttitor ex. Aenean dictum sed velit id porttitor.";?>
    <p><? echo $ob1_1; ?></p>
    <h3>2</h3>
    <? echo strlen($ob1_1); ?>
    <h3>3</h3>
    <p><? echo strtoupper($ob1_1); ?></p>
    <p><? echo ucwords($ob1_1); ?></p>
    <h3>4</h3>
    <p><? echo substr($ob1_1, 0, 10); ?></p>
    <p><? echo substr($ob1_1, -10); ?></p>
    <p><? echo substr($ob1_1, 10, 20); ?></p>
    <h3>5</h3>
    <? 
        $ob1_1 = sprintf("%s".$ob1_1."%s", "  ", "  ");
        $ob1_1 = ltrim($ob1_1);
        $ob1_1 = rtrim($ob1_1);
        $ob1_1 = trim($ob1_1);
    ?>
    <h3>6</h3>
    <p>md5 hash of the word "password":</p>
    <? echo md5("password"); ?>
    <p>md5 hash of the password "CdV1m_HJ+Sy9VwQAce@2"</p>
    <? echo md5("CdV1m_HJ+Sy9VwQAce@2"); ?>
    <p>Conclusion: reversemd5 found the simple password but it wasn't successful at the complex one.</p>
    <h2>Objective N3: PHP Arrays</h2>
    <h3>1</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut vulputate eros. Curabitur aliquam pulvinar tellus. Fusce egestas ac tellus a malesuada. Sed rhoncus turpis libero, id iaculis purus ultrices consectetur. Fusce egestas odio eu tellus sagittis, nec congue mauris dapibus. Ut nec risus ipsum. Nullam eu quam quis sem varius consequat. Curabitur semper porttitor ex. Aenean dictum sed velit id porttitor.</p>
    <? 
        $obj3_1 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut vulputate eros. Curabitur aliquam pulvinar tellus. Fusce egestas ac tellus a malesuada.";
        $arr1 = explode(' ', $obj3_1);
        print_r($arr1);
        echo "<br>";
        echo count($arr1);
        echo "<br>";
        sort($arr1);
        print_r($arr1);
        echo "<br>";
        rsort($arr1);
        print_r($arr1);
    ?>
</body>
</html>