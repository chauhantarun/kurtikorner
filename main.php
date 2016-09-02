<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/createURLFromMenu.js"></script>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php

$conn;
echo '<script>
        var urlLink = "";
        function myFunction(e) {
            var parentUL = e.parentNode;
            //alert(e.id + e.parentElement.nodeName + parentUL.id);
            if (parentUL.id == "main-0") {
                urlLink += e.id;
                //alert(urlLink);
                var arrLink = urlLink.split(\'/\');
                //alert(arrLink.length);
                urlLink = "";
                for (i = arrLink.length - 1; i >= 0; i--) {
                    if (i == 0) {
                        urlLink += arrLink[i];
                    } else {
                        urlLink += arrLink[i] + "/";
                    }
                    //alert(arrLink[i]);
                }
                //alert("New Pathname: " + "/" + urlLink);
                //alert("Current Pathname: " + window.location.pathname);
                window.location.pathname = "/" + urlLink;
                window.location.assign("/" + urlLink);
                urlLink = "";
            } else {
                urlLink += e.id + "/";
            }
        }
        </script>';

echo "main" . filter_input(INPUT_GET, 'category') . filter_input(INPUT_GET, 'product_line') . filter_input(INPUT_GET, 'product');

function fnConn() {
    //Credentials for AwardSpace Database
$servername = "fdb12.awardspace.net";
$username = "2012930_tarun";
$password = "Opera123!";
$database = "2012930_tarun";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
    return $conn;
}

display_children(0, 1);
    function display_children($parent, $level) {
        $conn = fnConn();
        $sqlQuery = "SELECT a.id, a.menu_description, Deriv1.Count FROM `menu` a"
                . " LEFT OUTER JOIN (SELECT parent_menu_id, COUNT(*) AS Count FROM `menu` GROUP BY parent_menu_id) Deriv1"
                . " ON a.id = Deriv1.parent_menu_id WHERE a.parent_menu_id=" . $parent;
        //echo $sqlQuery;
        $result = $conn->query($sqlQuery);
        if (!isset($main_menu)) {
            $menu_id = $level - 1;
            echo "<ul id=\"main-$menu_id\">";
            $main_menu = 0;
        } else {
            echo "<ul>";
        }
        $main_menu++;
        while ($row = $result->fetch_object()) {
            if ($row->Count > 0) {
                echo "<li id=$row->menu_description onclick=\"myFunction(this)\"><a>" . $row->menu_description . "</a>";
                display_children($row->id, $level + 1);
                echo "</li>";
            } elseif ($row->Count==0) {
                echo "<li id=$row->menu_description onclick=\"myFunction(this)\"><a>" . $row->menu_description . "</a></li>";
            } else;
        }
        echo "</ul>";
    }
    
?>