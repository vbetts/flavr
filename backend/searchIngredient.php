<?php
#Get values for dropboxes from the database
if(!empty($_GET['ingred']))
{
    $list = $_GET['ingred'];
    
    #Need help with sql query
    $qry="SELECT name, rText FROM Recipes INNER JOIN LinkIngRec ON Recipes.id = LinkIngRec.idRec WHERE LinkIngRec.idIng = " . $list;

     
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