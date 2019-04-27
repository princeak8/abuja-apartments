

<div id="arrow_up" class="arrow_up">
    <span class="fa fa-angle-up"></span>
</div>

<footer class="container-fluid pb-0">
    <div class="footer">
      <div class="footer__left">
        <a href="/privacy">Privacy</a>
        <a href="/terms">Terms of Use</a>
        <a href="/about">About</a>
        <a href="/partner">Partner us</a>
      </div>
      <div class="footer__middle">
        <div class="footer__middle__img">
          <img class="img-responsive" src="{{ asset('images/symbol.png') }}" /> 
        </div>
      </div>
      <div class="footer__right">
          <a href="https://www.facebook.com/zerothgroup/" target="_blank">
            <span class="fab fa-facebook-f"></span>
          </a>
        
          <a href="https://www.twitter.com/zerothweb_group/" target="_blank">
            <span class="fab fa-twitter"></span>
          </a>
        
          <a href="https://www.facebook.com/zerothgroup/" target="_blank">
            <span class="fab fa-linkedin-in"></span>
          </a>
        
          <a href="https://www.instagram.com/zerothgrp/" target="_blank">
            <span class="fab fa-instagram"></span>
          </a>
      </div>

    </div>
    <hr>
    
    <div class="footer__bottom">
        <p>
          Copyright <?php echo date("Y", time()); ?> &copy; <a href="www.zizix6.com">
            Zizix6 Technologies</a> All rights reserved
        </p> 
        <ul>
          <li><span class="fa fa-envelope"></span> &nbsp; info@abujaapartments.com.ng</li>
          <li><span class="fa fa-phone"></span> &nbsp; 07039775298, 08062977023</li>
        </ul>   
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