// JavaScript Document
<script type="text/javascript">
function hide() {
	 <?php foreach($loc as $key=>$score) { ?>
	 document.getElementById("check_<?php echo $score; ?>").onclick = function() {
		 if(document.getElementById("check_<?php echo $score; ?>").checked) {
			 // Use CSS style to show it
			 document.getElementById("loc_<?php echo $score; ?>").style.display = "block";
			 document.getElementById("change_<?php echo $score; ?>").style.display = "block";
		 } else {
			 // Hide it
			 document.getElementById("loc_<?php echo $score; ?>").style.display = "none";
			 document.getElementById("change_<?php echo $score; ?>").style.display = "none";
		 }
	 };
	 //now hide it on the initial page load
	 document.getElementById("loc_<?php echo $score; ?>").style.display = "none";
	 document.getElementById("change_<?php echo $score; ?>").style.display = "none";
	 <?php } ?>
 }
 window.onload = function() {
	 hide();
 }
 </script>