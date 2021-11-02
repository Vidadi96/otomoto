 <?php
    include"db.php";
    $response = mysqli_query($con,"SELECT `ad` FROM `elancats` WHERE `maincat`=".$_GET["Id"]." AND `altcat`=0");
    $subCategories = array();
    if(mysqli_num_rows($response)>0){
        while($subcategory=$response->fetch_array()){
            array_push($subCategories,$subcategory[0]);
        }
    }
    echo json_encode($subCategories);
?>