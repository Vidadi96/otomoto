<?php
    include"db.php";
    $sql = "SELECT
    a.id AS eid, a.title, a.tarix, a.active, a.price, a.city, a.token,a.user, a.razi, a.curr, a.subcat AS altkat,
    b.ad AS catad,
    c.target, 
    d.id, d.first_name, d.last_name, d.email, d.mobile,
    e.ad AS town
    FROM elanlar a, elancats b, elanimages c, user d, elancities e
    WHERE
    a.active=1 AND
    a.cat=b.id AND
    a.token=c.token AND
    c.manjet=1 AND
    b.active=1 AND
    a.vip = 1 AND
    a.user=d.id AND
    a.city=e.id ".$res1." ".$res2." ".$res3."
    GROUP BY a.token
    ORDER BY a.id DESC
    LIMIT 12";
    $sec=mysqli_query($con,$sql);
    $premiums = array();
    if(mysqli_num_rows($sec)>0){
        while($premium=mysqli_fetch_array($sec)){
            $rsec=mysqli_query($con,"SELECT SUM(reytinq) AS rtnq FROM reytinq WHERE rid='".$qid."'");
            $rsec2=mysqli_query($con,"SELECT * FROM reytinq WHERE rid='".$qid."'");
            $rinfo = mysqli_fetch_assoc($rsec);
            $rcem=$rinfo['rtnq'];
            $rveren=mysqli_num_rows($rsec2);
            $orta=$rcem/$rveren;
            $netice=round($orta);
            if($rveren==0){
                $netice=0;
            }
            $premium['rating'] = $netice;
            array_push($premiums,$premium);
        }
    }
    echo json_encode($premiums);
?>