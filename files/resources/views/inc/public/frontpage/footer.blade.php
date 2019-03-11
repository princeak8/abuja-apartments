

<div id="arrow_up" class="arrow_up">
    <span class="fa fa-angle-up"></span>
</div>

<footer class="container-fluid pb-0">

    <div class="row footer__top">
        <div class="col-md-4 offset-lg-2 col-lg-3">
          <h4>Useful Links</h4>
          <ul class="p-0">
            <li><a href="privacy.php"><span class="fa fa-caret-right"></span> Privacy </a></li>
            <li><a href="terms.php"><span class="fa fa-caret-right"></span> Terms of Use </a></li>
            <li><a href="contact.php"><span class="fa fa-caret-right"></span> Contact Form</a></li>
          </ul>
        </div>

        <div class="col-md-4 col-lg-3 contact_info">
          <h4>Contacts</h4>
          <ul class="p-0">
            <li><span class="fa fa-envelope"></span> &nbsp; info@abujaapartments.com.ng</li>
            <li><span class="fa fa-phone"></span> &nbsp; 07039775298, 08062977023</li>
          </ul>
        </div>
        
        <div class="col-md-4 col-lg-3 footer__top__socials">
            <h4><span class="fa fa-rss"></span> Follow Us</h4>
            
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
    
    <div class="row footer__bottom">
      
      <div class="col-lg-8">
          <ul class="footer-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="partner.php">Partner Us</a></li>
              <li><a href="contact.php">Contact Us</a></li>
              <li><a href="about.php">About Us</a></li>
          </ul>
      </div>
    </div>
    
    <div class="row footer__bottom__2">
        <div class="col-lg-12">
          <p class="text-center">
            Copyright <?php echo date("Y", time()); ?> &copy; <a href="www.zerothweb.com.ng">
              Zizix6</a> All rights reserved
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