<?php

$num_cells = 5;

$arrayIni = array();
for ($i = 0; $i < $num_cells; $i++) {
    $randCell = rand(1, 0);
    $randCell == 1 ? $arrayIni[$i] = "o" : $arrayIni[$i] = "x";
}

function printArray($arrayToPrint){

    $array2 = "";
    for($i = 0; $i < count($arrayToPrint); $i++){
        $array2.= $arrayToPrint[$i];
    }
    return $array2;
}

function start($array, $steps){
    $x = 0;
    $newArray = $array;

    echo printArray($array) . "</br>";
    while($x < $steps){
        for($j = 0; $j < count($array); $j++){
    
            if($j == 0){
                if(($array[count($array)-1] == "o" && $array[$j+1] == "x") || ($array[count($array)-1] == "x" && $array[$j+1] == "o")) 
                    $newArray[$j] = "o";
                
                else
                    $newArray[$j] = "x";
            }

            elseif($j == count($array)-1){
                if(($array[$j-1] == "o" && $array[0] == "x") || ($array[$j-1] == "x" && $array[0] == "o"))
                    $newArray[$j] = "o";
                
                else
                    $newArray[$j] = "x";
            }

            else{
                if(($array[$j-1] == "o" && $array[$j+1] == "x") || ($array[$j-1] == "x" && $array[$j+1] == "o"))
                    $newArray[$j] = "o";

                else
                    $newArray[$j] = "x";
            }
        }

        $x++;
        $array = $newArray;
        echo printArray($array) . "</br>";
    }
}

start($arrayIni, 5);

?>


