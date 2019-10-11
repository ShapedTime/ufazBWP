<?

    $num = intval($_REQUEST["num"]);
    $change = "";
    while($num != 0){
        if(intval($num/200)>0){
            $change = $change." 200M";
            $num -= 200;
        }
        if(intval($num/100)>0){
            $change =  $change." 100M";
            $num -= 100;
        }
        if(intval($num/50)>0){
            $change =  $change." 50M";
            $num -= 50;
        }
        if(intval($num/20)>0){
            $change =  $change." 20M";
            $num -= 20;
        }
        if(intval($num/10)>0){
            $change =  $change." 10M";
            $num -= 10;
        }
        if(intval($num/5)>0){
            $change =  $change." 5M";
            $num -= 5;
        }
        if(intval($num/1)>0){
            $change =  $change." 1M";
            $num -= 1;
        }
    }
    echo $change;

?>