// JavaScript Document
			per_page = 5; //initalizing the number of records displayed per page
			page = 1; //initializes the default page to be the page one
			paginations = '';	//initializes the number of pagination links
			data_array = '';   // initializes the array of records that will be paginated
			
			//This function takes the user back to the top of the page
			function back_to_top() 
			{
				var duration = 500;
				/*$('#back_to_top').click(function(e) {
				alert("I'm Clicked");
				e.preventDefault();*/
				jQuery('html, body').animate({scrollTop: 0}, duration);
				return false;
			}
			
			//This function sets the page number for the current page that shuld be displayed
			function set_page(page_num)
			{
				page = page_num; //gets the page number from the function and assigns it to the global page variable
				//alert(page_num);
				paginate(page); //calls the paginate function to load the required records of the page
				back_to_top(); // sends the user back to the top 
			}
			
			//This function sets the next page
			function nxt()
			{
				page_num = (page+1);//increaments the current page by 1
				//alert(page_num);
				set_page(page_num); // calls the set page function to set the new current page and load the required records
			}
			
			//This function sets the previous page
			function prev()
			{
				page_num = page - 1; //decrements the current page by 1
				set_page(page_num); //calls the set page function to set the new current page and load the required records
			}
			
			function stringEscape(s) 
			{
    			return s ? s.replace(/\\/g,'\\\\').replace(/\n/g,'\\n').replace(/\t/g,'\\t').replace(/\v/g,'\\v').replace(/'/g,"\\'").replace(/"/g,'\\"').replace(/[\x00-\x1F\x80-\x9F]/g,hex) : s;
    			function hex(c) 
				{ 
					var v = '0'+c.charCodeAt(0).toString(16); return '\\x'+v.substr(v.length-2); 
				}
			}
			
			//This function loads the required records for the page
			function paginate(page)
			{
					var data = data_array; //gets the records from the global variable
					//console.log(data);
				if(page>1) //show the 'previous' link only when the current page is greater than one
				{
					$('#prev').html('<a href="javascript:void(0)" id="prev" >previous</a> |'); //dynamically creates the 'previous' link
				}else{
					$('#prev').html(''); //if the current page is 1, delete the 'previous' link
				}
				if(page<paginations) //show the 'next' link only when the current page is less than the number of pagination links
				{
					$('#nxt').html(' | <a href="javascript:void(0)" id="nxt" >next</a>');//dynamically creates the 'next' link
				}else{
					$('#nxt').html('');//if the current page is the last page, delete the 'next' link
				}
				var pages = '';
				for(i=1; i<=paginations; i++)
				{
					//create the pagination links i.e 1,2,3...
					pages += ' <a href="javascript:void(0)" class="page"';
					if(page==i) { //if its the current page, make it red
					pages += 'style="color:red"';
					}
					pages += 'id="'+i+'" >'+i+'</a> ';
				}
				$('#pages').html(pages);
						
				var start = (page-1)*per_page; //initializes the start of the record depending on the page number
				var y = 0; var x = 0; // initializes the counters
				var content = '';
				var output = ''; //initializes the output
		
				$.each(data, function(key, val) { //loops theough the records
				y++; //increments the counter in charge of the point in the record where the records should start showing
				if(y > start) //if the counter has reached the start number
				{
					x++; //increment the next counter in charge of controlling the number of records shown per page
					if(x <= per_page) //if this counter has not reached the number of records required to show per page
					{
						//create elements and add it to the 'output' variable
						/*var noslash = '<p>Cute Serviced 4 Bedroom Duplex With Boys Quarters</p>
						 sdf';*/
						 output += '<div id="left">';
						 output += '<div class="list">';
						 output += '<div class="img"><img src="includes/timthumb.php?src=images/houses/'+val.house_id+'/'+val.photo+'&w=160&h=110&zc=0" /></div>';
  					     output += '<b class="right" style="margin-right:10px; font-size:16px;">'+val.status+'</b>';
  						 output += '<div class="price">N'+val.price+'</div><br/><br/>'; 
  						 output += '<span style="color:#006699">'+val.type+'</span><br/>';
   						 output += '<span style="color:#006699">'+val.location+'</span><br/>';
   						 output += val.description;
						 output += '<div class="view"><a href="property.php?house_id='+val.house_id+'">view Details</a></div>';
						 output += '<div class="clear"></div>';
						 output += '</div>';
						 output += '</div>';
					}
				}
			})
			/*alert("I'm working");
			console.log(data);*/
			$('#data').html(output); //show the result in the screen
		}
			
			$(document).ready(function(e) {
				
		$('#pagination').on('click', '.page', function(e) { //when any of the pagination links is clicked
            //alert(e.target.id);
			set_page(e.target.id); //call the set_page function
        });
		$('#pagination').on('click', '#nxt', function() { //when the 'next' link is clicked
            nxt(); //call the 'nxt' function
			//alert(3);
			exit; //exit this function
        });
		$('#pagination').on('click', '#prev', function() {
            prev();
			exit;
        });
		});
			$.getJSON('houses_result.php', function(data) { //gets the results from another page in json format
					data_array = data; //assigns the data from the result to the global variable
				    var total = data.length; //gets the number of records
					 var div = Math.floor(total/per_page); //gets the number og pagination required and approximates it lower
	 				var remainder = total%per_page; //gets the remainder from the division
					if(remainder > 0) //if there is a remainder
					{
						 paginations = div + 1; // add to the number of paginations
					}else{
						paginations = div; //if there is no trmainder, dont add anything
					}
					
					output = ''; //clears the output variable
					paginate(page); //call the pagination function to load the required data/records
				});
				
				
				$(document).on('change', 'select', (function() { //when the user selects any of the filter dropdown parameters
					var locationField = $('#location').val(); //get the value in the location input
					var typeField = $('#type').val(); //get the value in the type input
					var rangeField = $('#range').val(); //get the value in the range input
					
					locationField_length = locationField.replace(/[^A-Z][^0-9]/gi, "").length;
					typeField_length = typeField.replace(/[^A-Z][^0-9]/gi, "").length;
					rangeField_length = rangeField.replace(/[^A-Z][^0-9]/gi, "").length;
					//output = searchField;
					var myExp = new RegExp(locationField, "i");
					var myExp2 = new RegExp(typeField, "i"); //do a regular expression on the type input selected by the user
					var myExp3 = new RegExp(rangeField, "i"); //do a regular expression on the range input selected by the user 
				$.getJSON('houses_result.php', function(data) { //get the reult from the external php file in json format
					var search_data = new Array(); //initialize the array of records that will hold the result from the filter
					/*var parameters = new Array();*/
					var i = 0; //initialize a counter
					$.each(data, function(key, val) {
						locationvallength = val.location_id.replace(/[^A-Z][^0-9]/gi, "").length;
						typevallength = val.type_id.replace(/[^A-Z][^0-9]/gi, "").length;
						rangevallength = val.range_id.replace(/[^A-Z][^0-9]/gi, "").length;
				if((val.location.search(myExp) != -1) && 
				   (val.type_id.search(myExp2) != -1) && 
				   (val.range_id.search(myExp3) != -1))
						{ //if the user selected fields matches the records
						
							/*parameters['location'] = val.location;
							parameters['type'] = val.type;
							parameters['range'] = val.min_range+' - '+val.max_range;*/
						
							 search_data[i] = val; //add to the search data array
							 i++;
						}
					})
					console.log();
					//$('#content').html(output);
					//alert(locationField);
					
					data_array = search_data; //send the result to the global variable
					var total = search_data.length; //get the total number of records of the search
					 var div = Math.floor(total/per_page);
	 				var remainder = total%per_page;
					if(remainder > 0)
					{
						 paginations = div + 1;
					}else{
						paginations = div;
					}
					//var search_info
					/*if(data_array == '') //if the search result is empty
					{
						$('#search_info').html('No Result Found for the search/Filter');
					}*/
					paginate(1);
				});
			}));
			
			
				/*id = 4;
				$.ajax({
					
		url: 'houses_result.php',
		data: {id: id},
		type: 'post',
		dataType: 'json',
		success: function(data){
			alert('data');
			var output = '<ul>';
			$.each(data, function(key, val) {
						 output += '<li>' + val.title + '</li>';
						})
						output += '</ul>';
						console.log(data);
						$('body').html(output);
			}
		});*/
           // });