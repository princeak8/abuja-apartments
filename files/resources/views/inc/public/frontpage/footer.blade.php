</div>   	
<div class="clear"></div>

<div id="arrow_up" class="arrow_up">
            <span class="fa fa-angle-up"></span>
        </div>

<footer class="shadow1">

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
              <p class="text-center">Copyright <?php echo date("Y", time()); ?> &copy; <a href="www.zerothweb.com.ng">Zeroth web</a> All rights reserved
            </div>
                
        </div>
        
    </div>

</footer>   

<script type="application/javascript" src="{{ asset('js/scroll_top.js')}}"></script>
<script type="application/javascript">
if (window.addEventListener) window.addEventListener('DOMMouseScroll', wheel, false);
window.onmousewheel = document.onmousewheel = wheel;

function wheel(event) {
    var delta = 0;
    if (event.wheelDelta) delta = event.wheelDelta / 120;
    else if (event.detail) delta = -event.detail / 3;

    handle(delta);
    if (event.preventDefault) event.preventDefault();
    event.returnValue = false;
}

var goUp = true;
var end = null;
var interval = null;

function handle(delta) {
    var animationInterval = 20; //lower is faster
  var scrollSpeed = 20; //lower is faster

    if (end == null) {
    end = $(window).scrollTop();
  }
  end -= 20 * delta;
  goUp = delta > 0;

  if (interval == null) {
    interval = setInterval(function () {
      var scrollTop = $(window).scrollTop();
      var step = Math.round((end - scrollTop) / scrollSpeed);
      if (scrollTop <= 0 || 
          scrollTop >= $(window).prop("scrollHeight") - $(window).height() ||
          goUp && step > -1 || 
          !goUp && step < 1 ) {
        clearInterval(interval);
        interval = null;
        end = null;
      }
      $(window).scrollTop(scrollTop + step );
    }, animationInterval);
  }
}

</script>
 
</body>

</html>