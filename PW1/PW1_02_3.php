<?
    function checkLuhn($card){
        $checkdig = $card % 10;
        $card = intval($card/10);
        $sum=0;
        while($card != 0){
            $modulo=$card%10;
            $modulo = $modulo*2;
            if($modulo>9) $modulo -= 9;
            $sum += $modulo;
            $card = intval($card/10);
            $modulo=$card%10;
            $sum += $modulo;
            $card = intval($card/10);
        }
        if((($sum+$checkdig)%10) == 0) {return "Valid";}
        else{return "Invalid";}
    }

    echo checkLuhn(intval($_REQUEST["num"]));

?>