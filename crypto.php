<?php
function get_nth($string, $index) {
    return substr($string, strlen($string) - $index - 1, 1);
}

function salt($char,$i){
$salt_char = get_nth('100745',$i);
$ord_val = ord($char) + ( ord($salt_char) -48 );
return chr($ord_val);
}



function get_salted_SHA512($password){
$hashstr = '';
$i = 0;
$pass = $password;
foreach (str_split($pass) as $char) {
        $schar = salt($char,$i);
        $hashstr .=  $schar;
        if($i == 5){ $i = 0; }
        else{ $i +=1; }
}
//echo $hashstr;
$passhash = hash("sha512",$hashstr,false);
return $passhash;
}
?>

