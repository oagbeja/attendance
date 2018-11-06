<?php

 
 if(mysql_select_db("$dbname",$link)) 
  {
        
         $table="create table $tablename(id int(10),xvalue varchar(20),yvalue int(20))"; 
          $tab=mysql_query($table);
         if($tab)
         {
         $fields="insert into $tablename values(1,'2006',100),(2,'2007',200),(3,'2008',300),(4,'2009',400)";
          $res=mysql_query($fields);
           
         
         }
  }


?>
