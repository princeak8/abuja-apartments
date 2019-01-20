

//var loc = document.getElementById("location");
//locvalue = loc.value;
var price = document.getElementById("price");
pricevalue = price.value;
var locerrormsg = document.getElementById("locerrormsg");
var priceerrormsg = document.getElementById("priceerrormsg");
//var emailerrormsg = document.getElementById("emailerrormsg");
var addresserrormsg = document.getElementById("addresserrormsg");
var agenterrormsg = document.getElementById("agenterrormsg");
var phoneerrormsg = document.getElementById("phoneerrormsg");
   
   	//var msg = "error";
   	/*
  	document.forms["myform"]["location"].onblur = function() {
       var locvalue = document.getElementById("location").value;
  	if((locvalue == "")) {
         	locerrormsg.innerHTML = "Location Cannot Be Empty)";
             msg = "error";
        } else {
        	locerrormsg.innerHTML = "";
        	  msg = "";
        }
        
 };
 */
 document.forms["myform"]["price"].onblur = function() {
       re = /^[,A-Za-z]+$/;
       var pricevalue = document.getElementById("price").value;
  	if(re.test(document.myform.price.value) || (pricevalue == "")) {
         	priceerrormsg.innerHTML = "ERROR(Price Must Be Numbers)";
             msg = "error";
        } else {
        	priceerrormsg.innerHTML = "";
        	  msg = "";
        }
        
 };
 document.forms["myform"]["address"].onblur = function() {
       var addrvalue = document.getElementById("address").value;
  	if((addrvalue == "")) {
         	addresserrormsg.innerHTML = "Address Field Cannot Be Empty)";
        } else {
        	addresserrormsg.innerHTML = "";
        }
        
 };
 document.forms["myform"]["agent"].onblur = function() {
       var agentvalue = document.getElementById("agent").value;
  	if((agentvalue == "")) {
         	agenterrormsg.innerHTML = "Agent Field Cannot Be Empty)";
        } else {
        	agenterrormsg.innerHTML = "";
        }
        
 };
 document.forms["myform"]["phone"].onblur = function() {
       re = /^[,A-Za-z]+$/;
       var phonevalue = document.getElementById("phone").value;
  	if(re.test(document.myform.phone.value) || (phonevalue == "")) {
         	phoneerrormsg.innerHTML = "ERROR(Invalid)";
        } else {
        	phoneerrormsg.innerHTML = "";
        }
        
 };
 /*
 document.forms["myform"]["email"].onblur = function() {
       var emailvalue = document.getElementById("email").value;
       var atpos = emailvalue.indexOf("@");
       var dotpos = emailvalue.lastIndexOf(".");
  	if((atpos < 1) || (dotpos < atpos+2) || (dotpos+2>=emailvalue.length) || (emailvalue == "")) {
         	 msg = "error";
         	emailerrormsg.innerHTML = "The Email Field is either empty or You Have Entered a Wrong Email";
        	  } else {
        	emailerrormsg.innerHTML = "";
             msg = "";
        }
        
 };
 */
 document.forms["myform"].onsubmit = function() {
 	var pricemsg = priceerrormsg.innerHTML;
 	//var emailmsg = emailerrormsg.innerHTML;
 	var addrmsg = addresserrormsg.innerHTML;
 	var agentmsg = agenterrormsg.innerHTML;
 	var phonemsg = phoneerrormsg.innerHTML;
 //	var emailvalue = document.getElementById("email").value;
 	var pricevalue = document.getElementById("price").value;
 	var addressvalue = document.getElementById("address").value;
 	var agentvalue = document.getElementById("agent").value;
 	var phonevalue = document.getElementById("phone").value;
 	if ((pricemsg != "") || (addrmsg != "") || (agentmsg != "") || (phonemsg != "") || (pricevalue == "") || (addressvalue == "") || (agentvalue == "") || (phonevalue == "")) {
 		return false;
 	}else{
 		alert('success');
 		return true;
 	}
 }


//window.onload = function() {
	//validate();
//}
	//var loc = document.getElementById(location);
/*
var locvalue = document.getElementById("location").value;
var locerrormsg = document.getElementById("locerrormsg");
   function validate() {
  	document.forms["myform"].onsubmit = function() {
  		if(locvalue == "") {
        locerrormsg.innerHTML = "Location Field Cannot Be Empty";
        return false;		
	} 
	 re = /^[0-9]+$/;
  	if(re.test(document.myform.location.value)) {
         	locerrormsg.innerHTML = "Location Field Cannot Be Numbers";
         	return false;
         } else {
		locerrormsg.innerHTML = "FAILED";
		return true;
	}
 };
}

window.onload = function() {
	validate();
}
*/
/*
var container = document.getElementById("container");
var ul = document.getElementById("ul");
var li = ul.getElementsByTagName[0];

console.log("This is an element of type: ", container.nodeType );
console.log("The InnerHTML is: ", container.innerHTML );
console.log("Child nodes: ", container.childNodes.length);
container.setAttribute("align", "left");


var myli = document.createElement("li");
var text = document.createTextNode("Javascript generated list");
myli.appendChild(text);
ul.appendChild(myli);



ul.insertBefore(myli, li);

*/


