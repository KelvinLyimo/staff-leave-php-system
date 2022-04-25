<?php
@include('config.php');

function getRemainLeaveDay($stuffID){
    $sql = "SELECT  *  from tblleaves where tblleaves.empid='{$stuffID}'  ";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $signedLeaveDay =0;
    foreach($results as $result):
        echo  date('Y', strtotime($result->ToDate)) ."===".  date('Y')."<br>";
        if( date('Y', strtotime($result->ToDate)) === date('Y') )
            $signedLeaveDay += $result->num_days ;
    endforeach;
    if($signedLeaveDay >= LEAVE_DAYS):
        return 0;
    else:
        return $signedLeaveDay;
    endif;
}