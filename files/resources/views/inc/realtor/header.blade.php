
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="APP_URL" value="{{env('APP_URL')}}" />
<input type="hidden" name="APP_STORAGE" value="{{ env('APP_STORAGE') }}" />
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1758712591124868";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="header" class="container-fluid ">
  <div class="row header d-none d-md-flex">      
    <div class="col-lg-3 logo header__img px-0">
      <img class="img-responsive" src="{{ asset('images/logo.png') }}" />
    </div>

    <div class="col-lg-5 mt-4 p-0">
      <div class="header__title text-center">
        <h4 class="m-0">
          <span>
          {{$realtor->type == 'agent' ? "Agent's Page" : "Real Estate Firm's Page"}}
          </span>
        </h4>
      </div>
    </div>
    
    <div class="col-lg-4 search header__search mt-4">
        
        <div class="">
          <form action="../../processes/search_realtor.php" method="post" >
              <input type="hidden" name="active" value="1" />
              <div class="row">
                <div class="col-9 pr-0">
                    <input class="form-control form-control-sm" type="text" name="search_realtor" placeholder="search realtor" />
                </div>
                <div class="col-3 pl-0">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit" value="Search">
                      <span class="fa fa-search"></span>
                    </button>
                </div>
              </div>
          </form>
        </div>
        
        
    </div>
    
  </div>
  
  
  <div class="row header d-flex d-md-none"> 
    <div class="col-4 col-sm-6">
      <button class="btn btn-default px-1 py-1" id="toggleMenu">
        <div class="longBar my-1"></div>
        <div class="shortBar"></div>
        <div class="longBar my-1"></div>
      </button>
    </div>     
    <div class="col-8 col-sm-6 logo header__img px-0">
      <img class="img-responsive" src="{{ asset('images/logo.png') }}" />
    </div>

    <div class="col-12 p-0">
      <div class="header__title text-center">
        <h4 class="m-0">
          <span>
          {{$realtor->type == 'agent' ? "Agent's Page" : "Real Estate Firm's Page"}}
          </span>
        </h4>
      </div>
    </div>
    
    {{-- <div class="col-12 search header__search mt-4">
        
        <div class="">
          <form action="../../processes/search_realtor.php" method="post" >
              <input type="hidden" name="active" value="1" />
              <div class="row">
                <div class="col-9 pr-0">
                    <input class="form-control form-control-sm" type="text" name="search_realtor" placeholder="search realtor" />
                </div>
                <div class="col-3 pl-0">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit" value="Search">
                      <span class="fa fa-search"></span>
                    </button>
                </div>
              </div>
          </form>
        </div>
        
        
    </div> --}}
    
  </div>
        
</div>