<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Search Engine - Search</title></head>
    <body>
        <form action='search.php' method='get'>
         <input type='text' name='k' placeholder='Type...' value='<?php echo $_GET['k']; ?>'>
        <input type='submit' name='' value='Search'>
        </form>
        <?php
        $k = $_GET['k'];
        $terms = explode(" ",$k);
        $query = "SELECT * FROM search WHERE";
        
        foreach ($terms as $each){
          $i++;  
            
            if ($i == 1)
                $query .="keywords LIKE '%$each%' ";
            else
                $query .="OR keywords LIKE '%$each%' ";
        } 
 
        mysql_connect("localhost", "root", "password");
        mysql_select_db("search-box");
        
        $query = mysql_query($query);
        $numrows = mysql_num_rows($query);
        if($numrows > 0){
           
            while ($row = mysql_fetch_assoc($query)){
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $keywords = $row['keywords'];
                $link = $row['link'];
                
                echo "<h2><a href='$link'>$title</a></h2> $description<br/><br />";
            }
        }
        else
            echo "No results found for \"<b>$k</b>\"";
        mysql_close();
        
        ?>
    </body>
</html>