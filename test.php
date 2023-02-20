<?php
class Card {

    function validate($cardnumber) {
        $c = str_replace(" ","",$cardnumber);
        
        $sum = 0;
        
        $counter = 1;
        $value = 0;
        foreach (str_split($c) as $number) {
            if (($counter % 2) == 0) {
                $value = $number;
                $counter = $counter + 1;
            } else {
                $counter = $counter + 1;
                
                $value = $number * 2;
                if ($value > 9) {
                    $value = $value - 9;
                }
            }
            
            $sum = $sum + $value;
            echo($sum);
        }
        echo($sum);
        if (($sum % 10) == 0) {
            return "Valid";
        } else {
            return "Invalid";
        }
    }

    function emit($cardnumber) {
        $emit = $cardnumber[0] . $cardnumber[1];

        $result = "";
        if ($emit == "62" || $emit == "67" || preg_match("/5[0-5]/",$emit) == 1) {
            $result = "Mastercard";
            return $result;
        } elseif ($emit == "14" || preg_match("/4[0-9]/",$emit) == 1) {
            $result = "VISA";
            return $result;
        }

        return $result;
    }

}


if ($argv[1] == "validate") {
    while (true) {
        echo("Type a card number:");
        $input = preg_replace("/\s+/","",(fgets(STDIN, 1024)));
    
        $instance = new Card();
    
        $valid = $instance -> validate($input);
        $emit = $instance -> emit($input);

        echo($valid . ' ' . $emit . "\n");
    }
}


?>