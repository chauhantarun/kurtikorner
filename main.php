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


?>