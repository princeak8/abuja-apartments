var mistake = "";

var email = document.getElementById("email");
var email_msg = document.getElementById("email_msg");

email.onblur = function() {
	if(email.value == "") {
	email_msg.innerHTML = "Email Cannot be Empty";
	$('#email_id').addClass('has-error');
    mistake = "exist";
   } 
   if (!validemail(email.value)) {
   	email_msg.innerHTML = "Invalid Email";
	$('#email_id').addClass('has-error');
      mistake = "exist";
   } else {
	$('#email_id').removeClass('has-error');
   	mistake = "";
   	email_msg.innerHTML = "";
   }  
   
   function validemail(email) {
   	var invalidchars = " /:,;";
   	
   	for (var k=0; k<invalidchars.length; k++) {
   		var badchar = invalidchars.charAt(k);
   		if (email.indexOf(badchar) > -1) {
   			return false;
   		}
   	}
   	var atpos = email.indexOf("@", 1);
   	if (atpos == -1) {
   		return false;
   	}
   	if(email.indexOf("@",atpos+1) != -1) {
   		return false;
   	}
   	var periodpos = email.indexOf(".",atpos);
   	if (periodpos == -1) {
   		return false;
   	}
   	if (periodpos+4 > email.length) {
   		return false;
   	}
   	return true;
   }
};

var phone = document.getElementById("phone");
var phone_msg = document.getElementById("phone_msg");

phone.onblur = function() {
   re = /^[,A-Za-z]+$/;
   if (re.test(phone.value)) {
   	phone_msg.innerHTML = "Invalid Phone Number";
	$('#phone_id').addClass('has-error');
      mistake = "exist";
   }else {
	$('#phone_id').removeClass('has-error');
   	mistake = "";
   	phone_msg.innerHTML = "";
   } 
};


document.forms["signup"].onsubmit = function() {
   var warning = document.getElementById("error");
   if (mistake == "exist") {
      warning.innerHTML = "THERE ARE ERRORS IN THE FORM";
      return false;
   }else{
   	  warning.innerHTML = "";
      return true;
   }
 }

