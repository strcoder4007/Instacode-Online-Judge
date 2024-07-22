<?php
include_once '../functions.php';
include_once '../components.php';
function timeformating($a) {
    return gmdate("H:i:s", $a);
}

if (isset($_GET['code'])) {
    $_GET['code'] = addslashes($_GET['code']);
    $query = "select * from contest where code = '$_GET[code]'";
    $contest = DB::findOneFromQuery($query);
    $query = "select value from admin where variable = 'penalty'";
    $admin = DB::findOneFromQuery($query);
    $query = "select * from problems where pgroup = '$_GET[code]' and status != 'Deleted'";
    $problems = DB::findAllFromQuery($query);
    $pidToProbCode = array();
    foreach($problems as $prob){
        $pidToProbCode[$prob['pid']] = $prob['code'];
    }
    ?>
<center><?php if(isset($_SESSION['loggedin']) && $_SESSION['team']['status'] == "Admin"){ ?><?php } ?><h1>Rankings - <?php echo $contest['name'] ?></h1></center>
    <?php
    if($contest['ranktable'] != ""){
        $rank = getrankings($contest['code']);
    } else {
        $rank = null;
    }
    $i = 1;
    $probCells = "";
    foreach($pidToProbCode as $pid=>$code){
        $probCells .= "<th><a target='_blank' href='". SITE_URL . "/problems/$code". "'>".$code."</a></th>";
    }
    echo "<table class='table'><tr><th>Rank</th><th>Teamname</th><th>Score</th>$probCells<th>Final Time</th></tr>";
    foreach ($rank as $val) {
        $finaltime = $val['time'] + $val['penalty'] * $admin['value'] * 60;
        $val['time'] = timeformating($val['time']);
        $finaltime = timeformating($finaltime);
        $probCells = "";
        foreach($pidToProbCode as $pid=>$code){
            $probCells .= "<td style='text-align:center'>". (array_key_exists($pid, $val['solved'])?"<span class='glyphicon glyphicon-ok' style='color: green'></span> (<span style='color:". ($val['solved'][$pid]>0?"red":"green") ."'>". $val['solved'][$pid]. "</span>)":"-") ."</td>";
        }
        echo "<tr><td>$i</td><td><a href='" . SITE_URL . "/teams/$val[teamname]'>$val[teamname]</a></td><td>$val[score] (<span style='color:". ($val['penalty']>0?"red":"green") ."'>$val[penalty]</span>)</td>". $probCells ."<td>$finaltime</td></tr>";
        $i++;
    }
    echo "</table>";
} else {
    echo "<h1>Select a Contest</h1>
        <div class='row'>";
    $query = "select * from contest";
    $res = DB::findAllFromQuery($query);
    foreach ($res as $row) {
        echo "<div class='span2'><a href='" . SITE_URL . "/rank/$row[code]'>$row[name]</a></div>";
    }
    echo "</div>";
}
?>
