/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Global Variable
var urlLink = "";

//Function to create URLs from Menu Click.
function myFunction(e) {
    
    //Get the parentNode Object of the List Item Clicked into a variable
    var parentUL = e.parentNode;
    
    alert(e.id + e.parentElement.nodeName + parentUL.id);
    
    //Check the id of the parentUL object
    if (parentUL.id === "main-0") { //If the List Item that is clicked falls under the Main List
        urlLink += e.id;
        
        //Split the URL created based on / and get an array. The steps now are needed as the URL is created in the reverse order
        var arrLink = urlLink.split('/');
        
        //empty the Global Variable for reuse
        urlLink = "";
        
        //Loop throug the array and put the URL items in the correct sequence
        for (i = arrLink.length - 1; i >= 0; i--) {
            if (i === 0) {
                urlLink += arrLink[i];
            } else {
                urlLink += arrLink[i] + "/";
            }
        }
        
        window.location.pathname = urlLink;
        
        //Update the current window with the new url
        window.location.assign(urlLink);
        
        //empty the Global Variable for next click
        urlLink = "";
    } else {
        urlLink += e.id + "/";
    }
}


