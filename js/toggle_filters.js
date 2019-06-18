$('#house-types h4').click(function(){
    // $('.filter__body__house-types__body').slideToggle();
    
    $('#fold').slideToggle(function () {
        if($(this).is(":hidden")){
            $('#house-types h4 span.hi').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
        }else{
            $('#house-types h4 span.hi').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
        }
    });
    
});

$('#location-types h4').click(function(){
    $('#location').slideToggle(function(){
        if($(this).is(":hidden")){
            $('#location-types h4 span.hi').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
        }else{
            $('#location-types h4 span.hi').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
        }
    });
});
$('#bedrooms h4').click(function(){
    $('#no_room').slideToggle(function(){
        if($(this).is(":hidden")){
            $('#bedrooms h4 span.hi').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
        }else{
            $('#bedrooms h4 span.hi').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
        }
    });
});
$('#price-ranges h4').click(function(){
    $('.fold_range').slideToggle(function(){
        if($(this).is(":hidden")){
            $('#price-ranges h4 span.hi').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
        }else{
            $('#price-ranges h4 span.hi').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
        }
    });
});