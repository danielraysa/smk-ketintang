<?php

function cos_sim(array $array_a, array $array_b, array $array_mean){
    $top = topNumber($array_a, $array_b, $array_mean);
    $div = divNumber($array_a, $array_b, $array_mean);
    if($div == 0){
        return 0;
    }
    return $top / $div;
}

function topNumber(array $arr_a, array $arr_b, array $arr_mean){
    $sum = 0;
    foreach($arr_a as $f => $val){
        $val2 = isset($arr_b[$f]) ? $arr_b[$f] : 0;
        if ($val != 0 && $val2 != 0) {
            $sum += ($val - $arr_mean[$f])*($val2 - $arr_mean[$f]);
        }
    }
    return $sum;
}

function divNumber(array $arr_a, array $arr_b, array $arr_mean){

    $root_sum_square_a = rootSquare($arr_a, $arr_b, $arr_mean);
    $root_sum_square_b = rootSquare($arr_b, $arr_a, $arr_mean);
    // return $div;
    return sqrt($root_sum_square_a) * sqrt($root_sum_square_b);
}

function rootSquare(array $arr_a, array $arr_b, array $arr_mean){
    $sum = 0;
    foreach($arr_a as $f => $val){
        $val2 = isset($arr_b[$f]) ? $arr_b[$f] : 0;
        if ($val != 0 && $val2 != 0) {
            $sum += ($val - $arr_mean[$f])**2;
        }
    }
    return $sum;
}

function weighted_sum(array $arr_a, array $arr_b, $pos_user, $pos_buku){
    $top = topWeighted($arr_a, $arr_b, $pos_user,$pos_buku);
    $div = divWeighted($arr_b, $pos_buku);
    return $top / $div;
}

function topWeighted(array $arr_a, array $arr_b, $pos, $pos_b){
    $sum = 0;
    /* $user = $pos - 1;
    $buku = $pos_b - 1; */
    $user = $pos;
    $buku = $pos_b;
    foreach($arr_a as $f => $val){ 
        // $val2 = isset($arr_b[$f]) ? $arr_b[$f] : 0;
        if($buku != $f){
            $sum += ($arr_a[$f][$user] * $arr_b[$buku][$f]);
        }
    }
    return $sum;
}

function divWeighted(array $arr_a, $pos){
    // $pos = 0
    // $position = $pos - 1;
    $position = $pos;
    $sum_div = 0;
    foreach($arr_a[$position] as $w => $val){
        if($position != $w){
            $sum_div += abs($val);
        }
    }
    return $sum_div;
}

function arr_transpose($array) {
    return array_map(null, ...$array);
}


function array_mean(array $array_1, array $array_2, array $array2d){
    $rata = [];
    for($x = 0; $x < count($array_1); $x++){
        $temp_rata = 0;
        $temp_divider = 0;
        for($y = 0; $y < count($array_2); $y++){
            if($array2d[$x][$y] != 0){
                $temp_rata += $array2d[$x][$y];
                $temp_divider += 1;
            }
        }
        $rata[$x] = $temp_rata/$temp_divider;
    }
    return $rata;
}

function array_sim(array $new_arr, array $mean){
    $arr_w = [];
    for($s = 0; $s < count($new_arr); $s++){
        $arr_w[$s][$s] = null;
        for($d = $s+1; $d < count($new_arr); $d++){
            $sim_ = cos_sim($new_arr[$s],$new_arr[$d], $mean);
            $arr_w[$s][$d] = $sim_;
            $arr_w[$d][$s] = $sim_;
            // echo "sim(b".($s+1).", b".($d+1).") = ".$sim_."<br>";
        }
    }
    return $arr_w;
}

function zero_book(array $array2d, $posisi_user){
    $temp = [];
    foreach($array2d[$posisi_user] as $b => $val){
        if($val == 0){
            array_push($temp, $b);
        }
    }
    return $temp;
}

?>