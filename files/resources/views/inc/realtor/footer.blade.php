<div class="clear"></div>
<div id="arrow_up" class="arrow_up">
  <span class="fa fa-angle-up"></span>
</div>

<footer>

    <div class="container-fluid">
        <div class="row footer_top">
            <div class="col-md-2">
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6">
                <h4>Services</h4>
                
                <ul class="no-padding">
                  <li><span class="fa fa-tag"></span> Web Design/Development</li>
                  <li><span class="fa fa-tag"></span> House Show case</li>
                  
                  
                </ul>
                
            </div>
            <div class="col-sm-2 col-xs-6">
              <h4><span class="fa fa-link"></span> Useful Links</h4>
              <ul class="no-padding">
                <li><a href="privacy.php"><span class="fa fa-caret-right"></span> Privacy </a></li>
                  <li><a href="terms.php"><span class="fa fa-caret-right"></span> Terms of Use </a></li>
                <li><a href="contact.php"><span class="fa fa-caret-right"></span> Contact Form</a></li>
              </ul>
            </div>
            <div class="col-sm-3 col-md-2 col-xs-12 contact_info">
              <h4><span class="fa fa-thumb-tack"></span> Contacts</h4>
              <ul class="no-padding">
                <li><span class="fa fa-envelope"></span> &nbsp; info@abujaapartments.com.ng</li>
                <li><span class="fa fa-phone"></span> &nbsp; 07039775298, 08062977023</li>
                
              </ul>
            </div>

            <div class="col-md-2 col-sm-3 col-xs-12 ffg_ic">
                <h4><span class="fa fa-rss"></span> Follow Us</h4>
                <div class="col-sm-3 col-xs-3 image no-padding">
                  <a href="https://www.facebook.com/zerothgroup/" target="_blank"><img src="{{env('APP_STORAGE')}}images/facebook.png" /></a>
                </div>
                 <div class="col-sm-3 col-xs-3 image no-padding">
                  <a href="https://www.twitter.com/zerothweb_group/" target="_blank"><img src="{{env('APP_STORAGE')}}images/twitter.png" /></a>
                </div>
                 <div class="col-sm-3 col-xs-3 image no-padding">
                  <a href="https://www.facebook.com/zerothgroup/" target="_blank"><img src="{{env('APP_STORAGE')}}images/linkedin.png" /></a>
                </div>
                 <div class="col-sm-3 col-xs-3 image no-padding">
                  <a href="https://www.instagram.com/zerothgrp/" target="_blank"><img src="{{env('APP_STORAGE')}}images/instagram.png" /></a>
                </div>
            </div>
        </div>
        
        <div class="row">
          <div class="col-md-2">
            </div>
          <div class="col-md-8 col-sm-12 foot">
              <ul class="footer-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="partner.php">Partner Us</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                  <li><a href="about.php">About Us</a></li>
              </ul>
          </div>
        </div>
        
        <div class="row bottom_footer">
            <div class="col-md-12">
              <p class="text-center">Copyright <?php echo date("Y", time()); ?> &copy; <a href="https://www.zerothweb.com.ng" target="_blank">Zeroth web</a> All rights reserved
            </div>
                
        </div>
        
    </div>

</footer>  

<script type="application/javascript">
  $(document).ready(function() { 
    CSRF_TOKEN = $('input[name=_token]').val();
    search_val = ''
    $('input[name=search_realtor]').keyup(function() { //alert('working');
      search_val =  $(this).val();
      if(search_val.length > 3) { 
        $.ajax({
          url:"{{url('realtor/search_realtor')}}", 
          data:{val: search_val, _token: CSRF_TOKEN}, 
          type: "post", 
          async: false, 
          error: function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
            alert(xhr.responseText);
          },
          success: function(data) { 
            result = '';
            if(data == '') {
              result += '<h4><b class="h4 h4-xs">No Realtor found by that name</b></h4>';
            }else{ 
              result += '<table class="col-md-6 col-md-offset-3">';
              $.each(data, function(key, val) {
                result += '<tr>';
                result += '<td>';
                result += '<img src="{{env('APP_STORAGE')}}images/profile_photos/'+val.photo+'" width="110" height="80" />';
                result += '</td>';
                result += '<td><h4>'+val.fullname+'</h4></td>';
                if(val.circle==0) {
                  result += '<td class="add-to-circle" data-id="'+val.id+'"><button class="btn btn-primary">Add to Circle</button></td>';
                }else if(val.circle==2) {
                  result += '<td>REQUEST SENT</td>';
                }else if(val.circle==3) {
                  result += '<td>AWAITING MY APPROVAL</td>';
                }
                result += '</tr>';
              })
              result += '</table>';
            }  
          }
        }) //End of ajax
            
        $('#search-results').html(result);
      }else{
        $('#search-results').html('');
        result = '';
      }
    })

    $(document).on('click', '.add-to-circle', function() {
      $(this).html('<img src="{{env('APP_STORAGE')}}images/spinner4.gif" width="30" height="20" />');
      var id = $(this).data('id');
      thisTd = $(this);
      $.ajax({
          url:"{{url('process_circle_request')}}", 
          data:{id: id, action: 'send', ajax: 1, _token: CSRF_TOKEN}, 
          type: "post", 
          async: false, 
          error: function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
            alert(xhr.responseText);
          },
          success: function(data) { //alert(data);
            if(data == 1) {
              thisTd.html('REQUEST SENT');
            }else{
              $(this).html('<button class="btn btn-primary" data-id="'+val.id+'">Add to Circle</button>');
            }  
          }
        }) //End of ajax
    })

  })
</script> 