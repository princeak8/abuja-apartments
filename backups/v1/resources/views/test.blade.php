<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<meta http-equiv="refresh" content="60">-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width" />
<meta name="msvalidate.01" content="F40836B3AF0D6B7161FFA103ED54CA38" />
<meta name="yandex-verification" content="7873f4221c789b35" />
<meta name="keywords" content="Abuja, Real Estate Platform, Houses, rent, sale, houses for rent, houses for sale, affordable price, apartments" />
<meta property="og:description" content="Abuja Apartments is an online Real Estate platform that aims to make it easy for anybody within Abuja environs to easily have access to houses either for rent or for sale. " />
<title>Abuja Apartments</title>

<link rel="icon" href="{{env('APP_STORAGE')}}images/abuja_apa_log.png" />

<script type="application/javascript" async src="{{env('APP_URL')}}js/jquery.min.js"></script>
<script type="application/javascript" async src="{{env('APP_URL')}}js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="{{env('APP_URL')}}css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" media="all" href="{{asset('css/font-awesome.min.css')}}"/>

{{--  <script type="application/javascript" src="{{env('APP_URL')}}js/tinymce/tinymce.min.js"></script>  --}}
<script src = "//cdn.tinymce.com/4/tinymce.min.js"> </script> 
    <script >
    var editor_config = {
        path_absolute: "/",
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

tinymce.init(editor_config); 
/*
inymce.init({
    selector:  '.tinymce',
	content_css : "css/bootstrap.min.css",
	relative_urls: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor hr pagebreak', 
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu jbimages',
		'emoticons template paste textcolor'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages |print preview media',    
});
*/
</script>

<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}css/custom_checkbox.css"/>
<link rel="stylesheet" href="{{env('APP_URL')}}css/lightbox.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}css/styles_frontpage.css"/>
<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}css/share.css"/>

</head>
<body>
    <textarea class="content"></textarea>
</body>