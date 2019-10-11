<html>

    <head>
        <title>PW1</title>
    </head>
    <script>
        function calcChange(balance) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("response").innerHTML = this.responseText;
                }
            };
            //var balance = document.getElementById("balance").value;
            if(isNaN(balance)){
                document.getElementById("response").innerHTML = balance + " is not a number";
            }else{
                xhttp.open("GET", "PW1_02_2.php?num=" + balance, true);
                xhttp.send();
            }
        }
        function calcLuhn(luhnreq) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("luhnres").innerHTML = this.responseText;
                }
            };
            //var luhnreq = document.getElementById("luhnreq").value;
            if(isNaN(luhnreq)){
                document.getElementById("luhnres").innerHTML = luhnreq + " is not a number";
            }else{
                xhttp.open("GET", "PW1_02_3.php?num=" + luhnreq, true);
                xhttp.send();
            }
        }
    </script>
    <body>
        <h1>PW1</h1>
        <h2>Objective N2</h2>
        <h3>Variables, Constants, Operators(arithmetic and assignment, concatenation and modulo operators)</h3>
        <h4>1.</h4>
        <?
            $a = 8;
            $b = 2;
            echo $a." + ".$b." = ".$a+$b;
            echo "<br>";
            echo $a." - ".$b." = ".$a-$b;
            echo "<br>";
            echo $a." * ".$b." = ".$a*$b;
            echo "<br>";
            echo $a." / ".$b." = ".$a/$b;
            echo "<br>";
        ?>
        <h4>2.</h4>
        <?
            $a = 7;
            $b = 3;
            echo $a." % ".$b." = ".$a%$b;
            echo "<br>";
        ?>
        <h4>3.</h4>
        <?
            $a = 8;
            echo $a."^2"." = ".$a*$a;
            echo "<br>";
            echo $a."^3"." = ".$a*$a*$a;
            echo "<br>";
        ?>
        <h4>4.</h4>
        <?
            $L = 8;
            $l = 2;
            echo "Perimeter of square with length ".$L." and width ".$l." is ".(2*($a+$b));
            echo "<br>";
            echo "Area of square with length ".$L." and width ".$l." is ".$a*$b;
            echo "<br>";
        ?>
        <h4>5.</h4>
        <?
            $R = 8;
            echo "Area of circle with radius ".$R." is ".$R*$R*$M_PI;
            echo "<br>";
            echo "Perimeter of circle with radius ".$R." is ".$R*$R*$M_PI;
            echo "<br>";
            echo "Diameter of circle with radius ".$R." is ".$R*2;
            echo "<br>";
        ?>
        <h4>6.</h4>
        <?
            $VAT = 10000;
            echo "Amount excluding VAT is ".$VAT;
            echo "<br>";
            echo "VAT is ".($VAT*20)/100;
            echo "<br>";
            echo "Amount including VAT".($VAT*120)/100;
            echo "<br>";
        ?>
        <h4>7.</h4>
        <?
            $days = 7;
            echo "Days: ".$days;
            echo "<br>";
            echo "Hours: ".$days*24;
            echo "<br>";
            echo "Minutes: ".$days*24*60;
            echo "<br>";
            echo "Seconds: ".$days*24*60*60;
            echo "<br>";
        ?>
        <h4>8.</h4>
        <?
            $seconds = 1000000;
            echo "Seconds: ".$seconds;
            echo "<br>";
            echo "Minutes: ".intval($seconds/60);
            echo "<br>";
            echo "Hours: ".intval($seconds/60/60);
            echo "<br>";
            echo "Seconds: ".intval($days/60/60/24);
            echo "<br>";
        ?>
        <h3>Loops for doing repetitive tasks</h3>
        <h4>1.</h4>
        <?
            $a=1;
            $b=10;
            echo "Starting value: ".$a;
            echo "<br>";
            echo "Ending value: ".$b;
            echo "<br>";
            echo "For loop: ";
            for ($i=$a; $i <= $b; $i++) { 
                echo $i." ";
            }
            echo "<br>";
            echo "While loop: ";
            while ($a <= $b) {
                echo $a." ";
                $a++;
            }
            echo "<br>";
        ?>
        <h4>2.</h4>
        <?
            $a=2;
            $b=10;
            echo "Starting value: ".$a;
            echo "<br>";
            echo "Ending value: ".$b;
            echo "<br>";
            echo "For loop: ";
            for ($i=$a; $i <= $b; $i+=2) { 
                echo $i." ";
            }
            echo "<br>";
            echo "While loop: ";
            while ($a <= $b) {
                echo $a." ";
                $a+=2;
            }
            echo "<br>";
        ?>
        <h4>3.</h4>
        <?
            $a=8;
            echo "Number is: ".$a;
            echo "<br>";
            for ($i=1; $i <= 10; $i++) { 
                echo $a." * ".$i." = ".$a*$i;
                echo "<br>";
            }
        ?>
        <h4>4.</h4>
        <?
            $a=8;
            echo "Number is: ".$a;
            echo "<br>";
            $sum = 0;
            $fact = 1;
            for ($i=1; $i <= $a; $i++) { 
                $sum+=$a;
                $fact*=$a;
            }
            echo "Sum from 1 to ".$a." is ".$sum." and factorial is ".$fact;
        ?>
        <h4>5.</h4>
        <?
            $sum = 0;
            for ($i=1; $i <= 1000; $i++) { 
                $sum+=1/($i*$i);
            }
            echo "Approximate with first 1000 terms is ".sqrt($sum)*6;
            echo "<br>";
            for ($i=1001; $i <= 10000; $i++){
                $sum+=1/($i*$i);                
            }
            echo "Approximate with first 10000 terms is ".sqrt($sum)*6;
            echo "<br><br><small>P.S. I don't know why it went terribly wrong.</small>"
        ?>
        <h3>Making decision: conditional testing</h3>
        <h4>1.</h4>
        <?
            $a=90;
            if($a>100){
                echo $a." is bigger than 100.";
            }elseif($a == 100){
                echo $a." is equal to 100.";
            }else{
                echo $a." is smaller than 100.";
            }
        ?>
        <h4>2.</h4>
        <?
            $a=14;
            if($a==8||$a==9){
                echo $a." is Microbe.";
            }elseif($a==10||$a==11){
                echo $a." is Poussin.";
            }elseif($a==12||$a==13){
                echo $a." is Benjamin-e.";
            }elseif($a==14||$a==15){
                echo $a." is Minime.";
            }elseif($a==16||$a==17){
                echo $a." is Cadet-te.";
            }elseif($a==18||$a==19){
                echo $a." is Junior.";
            }elseif($a>=20&&$a<=39){
                echo $a." is Senior";
            }elseif($a<39){
                echo $a." is Vétéran-e";
            }else{
                echo $a." is undefined.";
            }
        ?>
        <h2>Objective N3</h2>
        <h3>1. Equality</h3>
        <?
            for ($a=1; $a < 10; $a++) { 
                for ($b=1; $b < 10; $b++) { 
                    for ($c=1; $c < 10; $c++) { 
                        if (($a*$a*$a + $b*$b*$b + $c*$c*$c) == (100*$a + 10*$b + $c)) {
                            echo (100*$a + 10*$b +$c)."<br/>";
                        }
                    }
                }
            }
        ?>
        
        <h3>2. Give Change back</h3>
            <input type="number" id="balance" onkeyup="calcChange(this.value)"> 
            <div id="response"></div>
        <h3>3. Luhn algorithm</h3>
        <input type="number" id="luhnreq" onkeyup="calcLuhn(this.value)"> 
        <div id="luhnres"></div>
    </body>

</html>