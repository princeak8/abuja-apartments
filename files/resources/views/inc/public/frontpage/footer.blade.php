

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