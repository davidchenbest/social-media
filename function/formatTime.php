<?php 

    function formatTime($str){
        date_default_timezone_set("America/New_York");
        $date = substr($str,0,10);
        $year = substr($date,0,4);
        $month = substr($date,-5,-3);
        $day = substr($date,-2);        
        $hr = substr($str,-8,-6);
        if((int)date('Y') > (int)"{$year}") return numToMonth($month)." {$day}/{$year}";
        if((int)date('md') > (int)"{$month}{$day}") return numToMonth($month) . " {$day}";

        if($hr > 12){
            $hr = $hr-12;
            return $hr . substr($str,-6,-3). ' PM';

        }
        return $str . ' AM';
        return date('Y');
}

function numToMonth($n){
    if($n==1)return 'Jan';
    if($n==2)return 'Feb';
    if($n==3)return 'Mar';
    if($n==4)return 'Apr';
    if($n==5)return 'May';
    if($n==6)return 'Jun';
    if($n==7)return 'July';
    if($n==8)return 'Aug';
    if($n==9)return 'Sep';
    if($n==10)return 'Oct';
    if($n==11)return 'Nov';
    return 'Dec';

}

    

?>