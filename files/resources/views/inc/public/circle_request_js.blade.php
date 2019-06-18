<script type="application/javascript">
    $(document).ready(function() {
        $('#add-to-circle-btn').click(function() {
            if(confirm('Are You Sure You Want to send Circle Request to this realtor?')) {
                CSRF_TOKEN = $('input[name=_token]').val();
                var accepter = $(this).data('accepter');
                var loading = $(this).data('loading');
                var action = 'send';
                var btn = $(this);
                //alert('Requester: '+requester+' Accepter: '+accepter);
                var loading_gif = '<img src="{{env('APP_STORAGE')}}images/spinner1.gif" height="35" width="40" />';
                if(loading==0) {
                    //alert(loading_gif);
                    $(this).html(loading_gif);
                    var postFields = {ajax: 1, id: accepter, action: action, _token: CSRF_TOKEN};
                    var postUrl = "{{url('process_circle_request')}}";
                    $.ajax({
                        url: postUrl,
                        data: postFields,
                        type: 'post',
                        async: false,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                        },
                        success: function(data){
                            console.log(data.status);
                            if(data.status=='success') { 
                                $('#circle-request').html('<b class="green">Circle Request Sent | </b>');
                            }else{
                                $('#circle-request').prepend('<i style="color:red">Circle Request was not succesfull</i>')
                                btn.html('<span class="fa fa-rss"></span> Add to Circle');
                            }
                        }
                    });
                }else{
                    $(this).data('loading', '1');
                    $(this).html('<span class="fa fa-rss"></span> Add to Circle');
                }
            }
        })
    })
</script>