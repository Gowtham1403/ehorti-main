<?php 
function time_elapsed_string($datetime) {
    $startdate=$datetime; 
    date_default_timezone_set("Asia/Calcutta");
    $curdate = date("Y-m-d H:i:s");
    $enddate= $curdate; 

    $diff=strtotime($enddate)-strtotime($startdate); 
    // immediately convert to days 
    $temp=$diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day 

    // days 
    $days=floor($temp); 
    $temp=24*($temp-$days); 
    // hours 
    $hours=floor($temp); 
    $temp=60*($temp-$hours); 
    // minutes 
    $minutes=floor($temp);
    $temp=60*($temp-$minutes); 
    // seconds 
    $seconds=floor($temp); 

    if($hours === 0.00 && $minutes === 0.00){
        return "{$seconds} sec ago";
    }
    elseif($hours === 0.00 && $days === 0.00){
        return "{$minutes}min ago";
    }
    elseif($days === 0.00){
        return "{$hours}h ago";
    }
    else{
        return "{$days}d ago";
    }

    // echo "Result: {$hours}h {$minutes}m {$seconds}s<br/>\n"; 
}
    // $now = new DateTime('Asia/Kolkata');
    // $now->format('Y-m-d H:i:s');

    // $now = new DateTime;
    // print_r($now);
    // $ago = new DateTime($datetime);
    // $diff = $now->diff($ago);
    
    // $diff->w = floor($diff->d / 7);
    // $diff->d -= $diff->w * 7;
    
    // $string = array(
    // 'y' => 'year',
    // 'm' => 'month',
    // 'w' => 'week',
    // 'd' => 'day',
    // 'h' => 'hour',
    // 'i' => 'minute',
    // 's' => 'second',
    // );
    // foreach ($string as $k => &$v) {
    // if ($diff->$k) {
    // $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    // } else {
    // unset($string[$k]);
    // }
    // }
    
    // if (!$full) $string = array_slice($string, 0, 1);
    // return $string ? implode(', ', $string) . ' ago' : 'just now';
    // }
    
?>