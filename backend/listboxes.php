<?php
#Get values for dropboxes from the database
if(!empty($_GET['getlist']))
{
    $list = $_GET['getlist'];
    $qry='';
    switch($list)
    {
        case 'ingredients':
        {
            $qry = "SELECT id, name FROM Ingredients";
            break;
        }
        case 'titles':
        {
            $qry = "SELECT id, name FROM Recipes";
            break;
        }
    }
    /*
    Note: Why not send  the table name itself as the 'getlist'
    param (avoiding the switch above)?
    Because it is dangerous! that will enable anyone browse your database!
    */
    if(empty($qry)){ echo "invalid params! "; exit; }
     
    $dbconn = mysql_connect('dbhost' . ':' . 'dbport','username','password') 
            or die("DB login failed!");
     
    mysql_select_db('flavr', $dbconn) 
            or die("Database does not exist! ".mysql_error($dbconn));
     
    $result = mysql_query($qry,$dbconn)
            or die("Query $qry failed! ".mysql_error($dbconn));
     
    $rows = array();
         
    while($rec = mysql_fetch_assoc($result)) 
    {
        $rows[] = $rec;
    }
    mysql_free_result($result);
    mysql_close($dbconn);
     
    echo json_encode($rows);
}
?>