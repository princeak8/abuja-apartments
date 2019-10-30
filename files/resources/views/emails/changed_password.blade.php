<!doctype html>
<html>
    <head>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!--
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #content {
                text-align: left;
                /*border: outset thin #ccc; */
                margin-right: auto;
                margin-left: auto;
                width: 90%;
                min-height: 200px;
                padding: 5%;
            }
            h2 {
                color: #6262EC;
                font-weight: bold;
                margin-top: 0px;
                padding-top: 0px;
            }
            #body {
                min-height: 350px;
            }
            #footer {
                text-align: center;
            }
            #personal-link {
                font-size:1.2em; 
            }
            @media only screen and (min-width: 768px) {
                #content {
                    margin-left: 20%;
                }
                #header img {
                    width: 300px;
                }
                #personal-link {
                    font-size:1.5em; 
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div id="header" style="margin-bottom: 5%">
                    <img src="{{asset('images/logo.png')}}" width="250" height="150" />
                    <!--<h2 style="display: inline">Abuja Apartments</h2>-->
                </div>

                <div id="content">
                    <div id="body">
                        <h2>PASSWORD CHANGED</h2>
                        <p>
                            Your Password has been changed<br/><br/>
                        </p>
                        <p>
                            If You were not responsible for the password change, contact us 
                            <a href="https://abujaapartments.com.ng/contact">HERE</a>
                        </p>
                    </div>

                        <div id="footer">
                            <a href="https://abujaapartments.com.ng.com" style="text-align: center">Abuja Apartments</a>
                        </div>
                </div>

            </div>
        </div>
    </body>
</html>