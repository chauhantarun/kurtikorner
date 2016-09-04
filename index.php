<script type="text/javascript" src="js/elements.js"></script>
<script type="text/javascript" src="js/createURLFromMenu.js"></script>
<style type="text/css">
    ul{
        padding: 0;
        list-style: none;
        background: #f8f8f8;
        line-height: 20px;
        font-size: 18px;
    }
    ul li{
        display: inline-block;
        position: relative;
        line-height: 30px;
        text-align: left;
    }
    ul li a{
        display: block;
        padding: 10px 25px;
        color: #333;
        text-decoration: none;
    }
    ul li a:hover{
        color: #fff;
        background: #939393;
        text-decoration: none;
        cursor: pointer;
    }
    ul li ul.dropdown{
        min-width: 100%; /* Set width of the dropdown */
        background: #f8f8f8;
        display: none;
        position: absolute;
        z-index: 999;
        left: 0;
    }
    ul li:hover ul.dropdown{
        display: block;	/* Display the dropdown */
        cursor: pointer;
    }
    ul li ul.dropdown li{
        display: block;
    }
</style>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://kurtikorner.onlinewebshop.net/">KurtiKorner</a>
        </div>
        <ul id="main-0">
        <li id="Womens" onclick="myFunction(this)">
            <a>Womens &#9662;</a>
            <ul class="dropdown">
                <li id="Kurti" onclick="myFunction(this)"><a >Kurti</a></li>
                <li id="Jewellery" onclick="myFunction(this)"><a >Jewellery</a></li>
            </ul>
        </li>
        <li id="Contact" onclick="myFunction(this)"><a>Contact</a></li>
    </ul>
    </div>
  </div>
  
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

    
    $conn = fnConn();
    $limit = 8;
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
    $start_from = ($page-1) * $limit;
$sqlQuery = "SELECT * FROM products ORDER BY product_id ASC LIMIT $start_from, $limit";

$res = $conn->query($sqlQuery);
//echo $res->num_rows;
echo '<div class="container-fluid" style="margin-top: 5%;">
  <div class="jumbotron" style="background: url(/assets/jumbotron_bg.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <h1 style="color: white; margin-left : 5%; margin-top: 20%;">KurtiKorner</h1>
    <p style="color: white; margin-left : 5%">The Best Kurtis In Scarborough.</p>
  </div>
</div>
';
echo '<div class="row">';
while ($row = $res->fetch_object()) {
    $price = round((ceil($row->purchase_price)*2)-0.01,2);
    $productImage = 'http://gdriv.es/kurtikorner/product_images/' . $row->product_code . '/' . $row->product_code . '-Image01.jpg';
    echo '<div class="col-md-3" "col-sm-12">'
    . '<a  href=' . $productImage. '> <img class="center-block" src=' . $productImage . ' width="auto" height="35%"/></a>'
    . "<p class=\"col-md-12 text-center\">Product Code: $row->product_code</p>"
    . "<p class=\"col-md-12 text-center\">Price: $ $price</p>"
    . '</div>';
}
echo '</div>';

$sqlQuery1 = "SELECT * FROM products";
$res1 = $conn->query($sqlQuery1);
$total_records = $res1->num_rows;
$total_pages = ceil($total_records / $limit);

$pagLink = '
  <div class="panel panel-default" align="center" style="border: none">
    <div class="panel-body pagination">';  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<li class=\"pagination\"><a href='?page=".$i."'>".$i."</a></li>";  
} 
echo $pagLink . "</div></div>";  
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