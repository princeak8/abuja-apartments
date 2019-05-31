<div class="col-md-10 col-lg-10">    
    <div class="" id="content">
        @include('inc.public.frontpage.houses_components.filtering')
        
        <div id="db-content" class="row">
            @foreach($houses as $house)  
      
                <!-- The House Pix and description starts here -->
                <div class="col-md-3 col-sm-6 px-3">
                    {{-- <a href="house/{{$house->id}}"> --}}
                    <div class="house mouseoverHouse">  
                        <div class="cover">Cover</div>
                        <div class="house__upper"> 
                            <div class="house__upper__location">
                                <span class="fa fa-map-marker-alt"></span> {{$house->location->name}}
                                @if($house->estate_id > 0)
                                    (<span> {{$house->estate->name}} </span>)
                                @endif
                            </div>

                            <div class="house__upper__img_price">
                                @include('inc.public.frontpage.houses_components.house_image')

                                <div class="house__upper__img_price__price">
                                    ₦ {{number_format($house->price)}} 
                                </div>
                            </div>

                            @include('inc.public.frontpage.houses_components.rooms_details')
                        </div>
                        
                        @include('inc.public.frontpage.houses_components.lower_details')
                        
                    </div>
                    {{-- </a> --}}
                </div>
        @endforeach
                
        <div id="loading" style="text-align:center; display:none">
            ...LOADING...
            <img src="{{env('APP_STORAGE')}}images/ajax-loader.gif" width="32" height="32" />
        </div>
    </div>

       
</div>

</div>
    
    <!-- Ajax Control Variables -->
           <input id="total-houses" type="hidden" value="{{count(App\House::all())}}" />
           <input id="displayed-houses" type="hidden" value="{{count($houses)}}" />
           <input id="limit" type="hidden" value="{{$limit}}" />
        <!-- Ajax Control Variables ends here  -->

@section('js')

<script>
	$(document).ready(function(){ 
		$('.mouseoverHouse').each(function(){
			var cover = $(this);
			$(this).find('a').not('a.delete').mouseover(function() {
				cover.find('.cover').css({
					'height': '98%'
				});
				cover.find('.mouseoverDetails a').css({
					'color': 'white'
				})
			})
			$(this).mouseleave(function() {
				$(this).find('.cover').css('height', '0')
				$(this).find('.mouseoverDetails a').css({
					'color': '#636b6f'
				})
				$(this).find('.mouseoverDetails a.delete').css({
					'color': 'rgb(235, 65, 65)'
				})
			})
		})
		
	})
</script>
		


<script type="application/javascript" src="{{asset('js/filter_houses.js')}}"></script>

<script type="application/javascript">
function showLoading() {
            $('#loading').css('display', 'block');
        }
        function hideLoading() {
            $('#loading').css('display', 'none');
        }

        loadingDone = true;
        CSRF_TOKEN = $('input[name=_token]').val();
        $(window).scroll(function() {
            
            //if($(window).scrollTop() == $(document).height() - $(window).height()) {
            if(Math.ceil($(window).scrollTop()) == Math.ceil($(document).height() - $(window).height())) {
                //alert('load');
                if(loadingDone) {
                    loadingDone = false;

                var total = $('#total-houses').val();
                var displayed = parseInt($('#displayed-houses').val()); 
                //alert(total);
                /*if(displayed=='') {
                    displayed = limit;
                }*/
                if(displayed < total) { //alert('start loading');
                    showLoading();
                    var postUrl = "{{env('APP_URL').'/load_houses'}}";
                    var postFields = {displayed: displayed, _token: CSRF_TOKEN};
                    //alert(displayed);
                    //alert(total);
                    $.ajax({
                        url: postUrl,
                        data: postFields,
                        type: 'post',
                        //async: false,
                        error: function(xhr, textStatus, errorThrown) {
                          console.log(xhr.responseText);
                          //alert(xhr.responseText);
                        },
                        success: function(data){ //alert(data);
                            var output = '';
                            /*output += '<div class="container-fluid no-padding">';*/
                            if(data.house == '') {
                                output += '<h4><b class="h4 h4-xs">No Results for the Selected Filter</b></h4>';
                            }else{
                                //alert(data.house);
                                $.each(data.house, function(key, val) {
                                    if(val.bathrooms == undefined){
                                        val.bathrooms = '';
                                    }
                                    if(val.bedrooms == undefined){
                                        val.bedrooms = '';
                                    }
                                    if(val.toilets == undefined){
                                        val.toilets = '';
                                    }
                                    output += '<div class="col-xs-6 col-md-3 col-sm-4 cont_xs2">';
                                        output += '<div class="house_cont cont_xs1">';
                                            //Location On Top of the pictures
                                            output += '<div class="locat">';
                                                output += '<span class="fa fa-map-marker"></span> '+val.location;
                                                if(val.estate != '') { 
                                                    output += ' <span>('+val.estate+' Estate</span>)';
                                                } 
                                            output += '</div>';
                                            //The image div
                                            output += '<div class="col-sm-12 col-xs-12 no-padding">';
                                                output += '<a href="index.php?page=view house&house_id='+val.house_id+'">';
                                                    output += '<div class="img">';
                                                        output += '<img src="{{env('APP_STORAGE')}}images/houses/'+val.house_id+'/thumbnails/'+val.photo+'" />';
                                                    output += '</div>';
                                                output += '</a>'; 
                                            output += '</div>';
                                            
                                            //The Price tag
                                            output += '<div class="price">';
                                                output += 'N '+val.price;
                                            output += '</div>';

                                            // The div below the Pictures
                                            output += '<div class="no-padding bath">';
                                                output += '<ul class="no-margin no-padding">';
                                                    output += '<li><span class="fa fa-bed"></span> ';
                                                        output += val.bedrooms;
                                                            if(val.bedrooms <= 1){
                                                                output += ' bedroom';
                                                            }else{
                                                                output += ' bedrooms';
                                                            }
                                                    output += '</li>';
                                                    output += '<li><span class="fa fa-shower"></span> '+val.bathrooms;
                                                            if(val.bathrooms <= 1){
                                                                output += ' bathroom';
                                                            }else{
                                                                output += ' bathrooms';
                                                            }
                                                    output += '</li>';
                                                    output += '<li><span class="fa fa-shower"></span> '+val.toilets;
                                                            if(val.toilets <= 1){
                                                                output += ' toilet';
                                                            }else{
                                                                output += ' toilets';
                                                            }
                                                    output += '</li>';
                                                    output += '<div class="clear"></div>';
                                                output += '</ul>';
                                            output += '</div>';

                                            //Description of the house starts here 
                                            output += '<div class="col-md-12 col-xs-12 cont_descript">';
                                                output += '<div class="descript">';
                                                    
                                                    output += '<ul class="no-padding">';
                                                        output += '<li><span class="fa fa-tag"></span> '+val.title+'</li>';
                                                        output += '<li><span class="fa fa-clone"></span> '+val.house_type+'</li>';
                                                        if(val.estate != '') { 
                                                            output += '<li><span class="fa fa-list-ul"></span> '+val.estate+' Estate';
                                                            output += '<span>('+val.units+' Units)</span>';
                                                            output += '</li>';
                                                        } 
                                                        
                                                    output += '</ul>';

                                                    output += '<a href="index.php?page=view house&house_id='+val.house_id+'"><span class="fa fa-external-link"></span> View details <span class="fa fa-angle-double-right"></span> </a>';
                                                output += '</div>';//end of Descript

                                                //Cont_lik starts
                                                output += '<div class="cont_lik col-sm-12 col-xs-12">';
                                                    output += '<hr/>';
                                                    output += '<p class="pull-left">';  
                                                        output += 'For '+val.status;
                                                    output += '</p>';
            
                                                    output += '<div class="pull-right">';
                                                        output += '<i><span class="fa fa-thumbs-up"></span> Likes['+val.house_likes+']</i> ';
                                                        output += ' <i><span class="fa fa-comments"></span> Comments['+val.comments+']</i>';
                                                    output += '</div>';
                                                output += '</div>';//end of cont_lik

                                            output += '</div>';//end of cont_descript
        
                                            output += '<div class="clear"></div>';
        
                                        output += '</div>';//End of house_cont
        
                                    output += '</div>'; //End of cont_xs2
                                })
        
                            }
                                /*output += '<div class="clear">';
                                output += '</div>'; 
                            output += '</div>';*/   
                            //alert(output);
                            hideLoading();
                            $('#db-content').append(output);
                            displayed = displayed + data.total_houses;
                            $('#displayed-houses').val(displayed);
                            loadingDone = true;
                            //alert(displayed);
                        }
                    });
                }
              }//loading done
            }
        });
    </script>
@endsection