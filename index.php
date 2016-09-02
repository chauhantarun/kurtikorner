<script type="text/javascript" src="js/elements.js"></script>
<script type="text/javascript" src="js/createURLFromMenu.js"></script>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php

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
    $conn = fnConn();
$sqlQuery = 'SELECT * FROM products';

$res = $conn->query($sqlQuery);

//echo $res->num_rows;
echo '<div class="container-fluid">
  <div class="jumbotron" style="background: url(/assets/jumbotron_bg.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <h1 style="color: white; margin-left : 5%">KurtiKorner</h1>
    <p style="color: white; margin-left : 5%">The Best Kurtis In Scarborough.</p>
  </div>
</div>
';

echo '<div class="row">';
while ($row = $res->fetch_object()) {
    $price = round((ceil($row->purchase_price)*2)-0.01,2);
    $productImage = 'http://gdriv.es/kurtikorner/product_images/' . $row->product_code . '/' . $row->product_code . '-Image01.jpg';
    echo '<div class="col-md-3" "col-sm-12">'
    . '<img class="center-block" src=' . $productImage . ' width="auto" height="35%"/>'
    . "<p class=\"col-md-12 text-center\">Product Code: $row->product_code</p>"
    . "<p class=\"col-md-12 text-center\">Price: $ $price</p>"
    . '</div>';
}
echo '</div>';

echo '<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-body" align="right">
    <span class="glyphicon glyphicon-home" style="margin-right:30px"></span>94 Berner Trail<br>
    Scarborough ON M1B 1B3<br><br>
    <span class="glyphicon glyphicon-earphone" style="margin-right:30px"></span>647 855 7680<br>
    <span class="glyphicon glyphicon-phone" style="margin-right:30px"></span>647 707 5801</div>
  </div>
</div>';
?>
