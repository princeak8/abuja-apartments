// JavaScript Document
// JavaScript Document

var cat1errormsg = document.getElementById("cat1errormsg");
var cat2errormsg = document.getElementById("cat2errormsg");
var cat3errormsg = document.getElementById("cat3errormsg");
   
  document.getElementById("cat1").onblur = function() {
       var cat1value = document.getElementById("cat1").value;
  	if((cat1value == "")) {
         	cat1errormsg.innerHTML = "Category Field Cannot Be Empty)";
        } else {
        	cat1errormsg.innerHTML = "";
        }
        
 };
  document.getElementById("cat2").onblur = function() {
       var cat2value = document.getElementById("cat2").value;
  	if((cat2value == "")) {
         	cat2errormsg.innerHTML = "Category Field Cannot Be Empty)";
        } else {
        	cat2errormsg.innerHTML = "";
        }
        
 };
 document.getElementById("cat3").onblur = function() {
       var cat3value = document.getElementById("cat3").value;
  	if((cat3value == "")) {
         	cat3errormsg.innerHTML = "Category Field Cannot Be Empty)";
        } else {
        	cat3errormsg.innerHTML = "";
        }
        
 };
 
 document.forms["add_category"].onsubmit = function() {
 	var cat1msg = cat1errormsg.innerHTML;
 	var cat2msg = cat2errormsg.innerHTML;
 	var cat3msg = cat3errormsg.innerHTML;
 //	var emailvalue = document.getElementById("email").value;
 	var cat1value = document.getElementById("cat1").value;
 	var cat2value = document.getElementById("cat2").value;
 	var cat3value = document.getElementById("cat3").value;
 	if (((cat1msg == "") && (cat1value != "")) || ((cat2msg == "")  && (cat2value != "")) || ((cat3msg == "") && (cat3value != ""))) {
 		alert('success');
		return true;
 	}else{
 		return false;
 	}
 }


