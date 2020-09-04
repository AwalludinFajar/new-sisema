<?php
// start and end must be timestamps !!!!

$generate_1 = strtotime();
$generate_2 = strtotime();

$start = 1452658897;  //  Thu 2012-09-06
$end   = 1493180497;  //  Tue 2012-09-26

// generate the weeks 
$weeks = generateweeks($start, $end);

// diaplay the weeks
echo 'From: '.fDate($start).'<br>';
foreach ($weeks as $week){
   echo fDate($week['start']).' '.fDate($week['end']).'<br>';
}
echo 'To: '.fDate($end).'<br>';

// $start and $end must be unix timestamps (any range)
//  returns an array of arrays with 'start' and 'end' elements set 
//  for each week (or part of week) for the given interval
//  return values are also in timestamps
function generateweeks($start,$end){
    $ret = array();
    $start = E2D($start);
    $end = E2D($end);

    $ns = nextSunday($start);

    while(true){
        if($ns>=$end) {
            insert($ret,$start,$end);
            return $ret;
        }
        insert($ret,$start,$ns);
        $start = $ns +1;
        $ns+=7;
    }
}

// helper function to append the array and convert back to unix timestamp
function insert(&$arr, $start, $end) {
    $arr[] = array('start'=>D2E($start), 'end'=>D2E($end));
}
// recives any date on CD format returns next Sunday on CD format
function nextSunday($Cdate) {
    return $Cdate + 6  - $Cdate % 7;
}
// recives any date on CD format returns previous Monday on CD format // finaly not used here
function prevMonday($Cdate) {
    return $Cdate - $Cdate % 7;
}   
// recives timestamp returns CD
function E2D($what) {
    return floor($what/86400)+2;
}     // floor may be optional in some circunstances
// recives CD returns timestamp
function D2E($what) {
    return ($what-2)*86400;
}          // 24*60*60
// just format the timestamp for output, you can adapt it to your needs
function fDate($what) {
    return date('D Y-m-d',$what);
}

?>