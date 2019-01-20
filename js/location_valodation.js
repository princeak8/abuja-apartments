// JavaScript Document

var loc1errormsg = document.getElementById("loc1errormsg");
var loc2errormsg = document.getElementById("loc2errormsg");
var loc3errormsg = document.getElementById("loc3errormsg");
   
  document.getElementById("loc1").onblur = function() {
       var loc1value = document.getElementById("loc1").value;
  	if((loc1value == "")) {
         	loc1errormsg.innerHTML = "Location Field Cannot Be Empty)";
        } else {
        	loc1errormsg.innerHTML = "";
        }
        
 };
  document.getElementById("loc2").onblur = function() {
       var loc2value = document.getElementById("loc2").value;
  	if((loc2value == "")) {
         	loc2errormsg.innerHTML = "Location Field Cannot Be Empty)";
        } else {
        	loc2errormsg.innerHTML = "";
        }
        
 };
 document.getElementById("loc3").onblur = function() {
       var loc3value = document.getElementById("loc3").value;
  	if((loc3value == "")) {
         	loc3errormsg.innerHTML = "Location Field Cannot Be Empty)";
        } else {
        	loc3errormsg.innerHTML = "";
        }
        
 };
 
 document.forms["add_location"].onsubmit = function() {
 	var loc1msg = loc1errormsg.innerHTML;
 	var loc2msg = loc2errormsg.innerHTML;
 	var loc3msg = loc3errormsg.innerHTML;
 //	var emailvalue = document.getElementById("email").value;
 	var loc1value = document.getElementById("loc1").value;
 	var loc2value = document.getElementById("loc2").value;
 	var loc3value = document.getElementById("loc3").value;
 	if (((loc1msg == "") && (loc1value != "")) || ((loc2msg == "")  && (loc2value != "")) || ((loc3msg == "") && (loc3value != ""))) {
 		alert('success');
		return true;
 	}else{
 		return false;
 	}
 }


