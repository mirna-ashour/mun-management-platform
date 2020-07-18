<?php

$userID = "";
$councilID= "";
$countryID= "";
$labelNum = "";

if(isset($_POST['btnSave']))
{

    $userID= $_POST['selUser'];
    $councilID = $_POST['councilID'];
    $countryID = NULL; //$_POST['countryID'];
    $labelNum = $_POST['labelNum'];
    //echo "<h2>".$labe
    
	if(isset($_POST['countryID']))
	{
   		$countryID = $_POST['countryID'];
	}
	else
	{
		$countryID=null;
    }
    
    $currentUser=NULL;
if($countryID==null)
    {
        $current=$connect->query("Select userID from enrollments where councilID=".$councilID." and labelNum=".$labelNum);
        if($current->num_rows>0)
        {
            $fetched=$current->fetch_assoc();
            $currentUser=$fetched['userID'];
        }
        else
        {
            $currentUser=NULL;
        }
  
        $sql=NULL;
        if($currentUser==NULL)
        {
            $sql = "INSERT INTO enrollments (userID, councilID, labelNum) VALUES
            (".$userID.", ".$councilID.",".$labelNum.")";
        }
        else
        {
            $sql ="UPDATE enrollments set councilID = $councilID, countryID=NULL, labelNum = $labelNum where userID=".$currentUser;
        }

        
        $connect->query($sql);
        /*$connect->query("INSERT INTO enrollments (userID, councilID, labelNum) VALUES
        (".$currentUser.", ".$councilID.",".$labelNum.") ON DUPLICATE KEY UPDATE
        userID = $currentUser, councilID = $councilID, labelNum = $labelNum");*/
        $connect->query("UPDATE user_details set positionStatus=1 where userID=".$userID);
    }
    else
    {
        $current=$connect->query("Select userID from enrollments where councilID=".$councilID." and countryID=".$countryID);
        if($current->num_rows>0)
        {
            $fetched=$current->fetch_assoc();
            $currentUser=$fetched['userID'];
        }
        $connect->query("INSERT INTO enrollments (userID, councilID, countryID) VALUES
        (".$userID.", ".$councilID.",".$countryID.") ON DUPLICATE KEY UPDATE
         userID = $userID, councilID = $councilID, countryID = $countryID");
         $connect->query("UPDATE user_details set positionStatus=1 where userID=".$userID);

    }
    if($currentUser==NULL)
    {
        $connect->query("Update user_details set positionStatus=0 where userID=".$currentUser);
    }
}

if(isset($_POST['btnUnallocate']))
{
    $councilID = $_POST['councilID'];
    $countryID = NULL;
    $labelNum = NULL;

    if(isset($_POST['countryID']))
    {
        $countryID=$_POST['countryID'];
    }
    if(isset($_POST['labelNum']))
    {
        $labelNum = $_POST['labelNum'];
    }
    

    $currentUser=0;
    if($countryID == NULL)
    {
        $current=$connect->query("Select userID from enrollments where councilID=".$councilID." and labelNum=".$labelNum);
        if($current->num_rows>0)
        {
            $fetched=$current->fetch_assoc();
            $currentUser=$fetched['userID'];
        }
    }
    else
    {
        $current=$connect->query("Select userID from enrollments where councilID=".$councilID." and countryID=".$countryID);
        if($current->num_rows>0)
        {
            $fetched=$current->fetch_assoc();
            $currentUser=$fetched['userID'];
        }

    }
    if($currentUser)
    {
        $connect->query("Update user_details set positionStatus=0 where userID=".$currentUser);
        $connect->query("DELETE FROM enrollments WHERE userID=".$currentUser);
        //$connect->query("Update user_details set councilID=NULL, countryID=NULL, LabelNum=NULL where userID=".$currentUser);
        
    }


}











?>