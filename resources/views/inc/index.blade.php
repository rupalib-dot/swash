<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js" integrity="sha512-QMUqEPmhXq1f3DnAVdXvu40C8nbTgxvBGvNruP6RFacy3zWKbNTmx7rdQVVM2gkd2auCWhlPYtcW2tHwzso4SA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tiny.cloud/1/i6i6aki8vkxt19vlfxol49qa6zukk6lry8hgtzka6agthn0x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.22/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.22/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.22/dist/js/uikit-icons.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <title>{{ $title }}</title>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/60fda9c3d6e7610a49acefde/1fbfdua8t';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</head>

<body>
    <div class="header-full" id="header-full">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul>
                            <li><span><i class="fas fa-envelope"></i></span>info@upgradeassignmenthelp.com.au</li>
                            <li><span><i class="fas fa-phone-alt"></i></span> +61-6-8005-6600</li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('freeassignment') }}" class="btn green-btn top-btn">Get Assistance</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 main-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('public/images/logo.png') }}"></a>
                    </div>
                    <div class="col-md-8 menu-list">
                        <ul>
                            <li><a href="{{ route('home') }}">Home
                            <li><a href="{{ route('services') }}">Services <i class="fas fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="#">Iteam 1</a></li>
                                    <li><a href="#">Iteam 2 <i class="fas fa-angle-right"></i></a>
                                        <ul>
                                            <li><a href="#">Iteam 1</a></li>
                                            <li><a href="#">Iteam 2 <i class="fas fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Iteam 1</a></li>
                                                    <li><a href="#">Iteam 2</a></li>
                                                    <li><a href="#">Iteam 3</a></li>
                                                    <li><a href="#">Iteam 4</a></li>
                                                    <li><a href="#">Iteam 5</a></li>
                                                    <li><a href="#">Iteam 6</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Iteam 3</a></li>
                                            <li><a href="#">Iteam 4</a></li>
                                            <li><a href="#">Iteam 5</a></li>
                                            <li><a href="#">Iteam 6</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Iteam 3</a></li>
                                    <li><a href="#">Iteam 4</a></li>
                                    <li><a href="#">Iteam 5</a></li>
                                    <li><a href="#">Iteam 6</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('reviews') }}">Reviews</a></li>
                            <li><a href="{{ route('samples') }}">Samples</a></li>
                            <li><a href="{{ route('essaytyper') }}">Essay Typer</a></li>
                            <li><a href="{{ route('free_resources') }}">Resources</a></li>
                            <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ route('login') }}" class="btn green-btn">Login/Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="section section-padding common-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="#"><img src="{{ asset('public/images/logo.png') }}"></a>
                    <p class="font-14">upgrade assignment help is an online assignment help service available in 9
                        countries. Our local operations span across Australia, US, UK, South east Asia and the Middle
                        East. With extensive experience in academic writing, Total assignment help has a strong track
                        record delivering quality writing at a nominal price that meet the unique needs of students in
                        our local markets.</p>
                    <a href="#" class="footer-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="footer-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-icon"><i class="fab fa-pinterest-p"></i></a>
                </div>
                <div class="col-md-3 col-padding-left">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">How it Works</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Refer And Earn</a></li>
                        <li><a href="#">Experts</a></li>
                        <li><a href="#">Survival Guide</a></li>
                        <li><a href="#">Legit Essay</a></li>
                        <li><a href="#"> Resume</a></li>
                        <li><a href="#"> Books</a></li>
                        <li><a href="#"> Features</a></li>
                        <li><a href="#"> Reviews</a></li>
                        <li><a href="#">Resources</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#"> Blog</a></li>
                        <li><a href="#"> FAQ's</a></li>
                        <li><a href="#"> Privacy Policy</a></li>
                        <li><a href="#"> Terms of Use</a></li>
                        <li><a href="#"> Refund Policy</a></li>
                        <li><a href="#"> Write For Us</a></li>
                        <li><a href="#"> Scholarships</a></li>
                        <li><a href="#"> Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Corporate Office</h4>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> 59 Street, B4 Appartment, Australia</li>
                        <li><i class="fas fa-phone-alt"></i> +0410 031122</li>
                        <li><i class="fas fa-envelope"></i> info@upgradeassignmenthelp.com.au</li>
                    </ul><br>
                    <h4>Payment Options</h4>
                    <div class="footer-img-list">
                        <img src="{{ asset('public/images/footer/paypal.jpg') }}">
                        <img src="{{ asset('public/images/footer/visa.jpg') }}">
                        <img src="{{ asset('public/images/footer/master-card.jpg') }}">
                        <img src="{{ asset('public/images/footer/bank_transfer.jpg') }}">
                        <img src="{{ asset('public/images/footer/american_express.jpg') }}">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center">
        <p>© © 2021. upgradeassignmenthelp.com. All Rights Reserved. Design by i4 consulting</p>
    </div>

    <script>
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            //>=, not <=
            if (scroll >= 200) {
                //clearHeader, not clearheader - caps H
                $("#header-full").addClass("active");
            } else {
                $("#header-full").removeClass("active");
            }
        }); //missing );
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function showpossword(id) {
            var x = document.getElementById(id);
            var y = document.getElementById(id + '-show');
            if (x.type === "password") {
                x.type = "text";
                y.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
            } else {
                x.type = "password";
                y.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
            }
        }

    </script>
</body>

</html>

