<?php

/** 
 * @param $file - The file created via the perl script
 * 
 * @return $board - the randomly generated board
*/
function get_board($file)
{
    $board = [];
    $file_lines = file($file);

    // print_r($file_lines);
    
    foreach($file_lines as $line) {
        $board[] = $line;
    }
    return $board;
}


function check_size($board, $i, $j) {
    $is_square = true;
    $size = 0;
    
    while($is_square){
        for($x = $i; $x <= $i + $size; $x++) {
            for($y = $j; $y <= $j + $size; $y++) {
                if($x >= count($board) || $y >= strlen(trim($board[0])) || !is_dot($board[$x][$y])){
                    $is_square = false;
                }
            }
        }
        if($is_square) {
            $size++;
        }
    }
    return $size;
}

/**
 * @param string $char - the current position's character
 * 
 * @return bool - true if its a dot, false otherwise 
 */
function is_dot($char){
    if($char === ".") {
        return true;         
    }
    return false;
}

/**
 * @param array $board - the current board
 */
function parse_array($board) {

    $line_length = strlen(trim($board[0]));

    $x = 0;
    $y = 0;
    $bsq = 0;

    echo "valeur de count board : \n";
    echo count($board) . "\n";
    for($i = 0; $i < count($board); $i++) {
        for($j = 0; $j < $line_length; $j++) {
            //print($board[$i][$j]);
            $square_size = check_size($board, $i, $j);
            if($square_size > $bsq){
                $bsq = $square_size;
                $x = $i;
                $y = $j;
            }
        }
        //print("\n");
    }
    $final_board_lines = fill_bsq($board, $bsq, $x, $y);

    foreach($final_board_lines as $final_lines) {
        echo $final_lines . "\n";
    }
    
}

function fill_bsq($board, $bsq, $x, $y) {

    for($i = $x; $i < $x + $bsq; $i++) {
        for($j = $y; $j < $y + $bsq; $j++) {
            $board[$i][$j] = "x";
        }
    }
    return $board;
}

parse_array(get_board("board_file"));