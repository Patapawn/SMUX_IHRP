<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$password = '/f)1c(-JG';
$hash = password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));

if (password_verify($password, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

$string = "{\"objects\":[


        {
            \"fieldname\": \"helmet\",
            \"fieldtype\": \"dropdown\",
            \"fieldoption\": [
                \"XS\",
                \"S\",
                \"M\",
                \"L\",
                \"XL\"
            ]
        }

        ,


        {
            \"fieldname\": \"helmet\",
            \"fieldtype\": \"dropdown\",
            \"fieldoption\": [
                \"XS\",
                \"S\",
                \"M\",
                \"L\",
                \"XL\"
            ]
        }


    ]}";


//echo $string;
$input1 = "helmet";
$input2 = "dropdown";
$input3 = "XS,S,M,L,XL";

//echo $string;
//print_r(json_decode($string));
?>
