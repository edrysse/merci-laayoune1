<!DOCTYPE html>
<html lang="en">
@include('client.includes.head')
@include('client.includes.header')

@yield('content')
@include('client.includes.footer')

<div class="btn-back-to-top bg0-hov" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>
<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/jquery/jquery-3.2.1.min.js') }}></script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/animsition/js/animsition.min.js') }}></script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/bootstrap/js/popper.js') }}></script>
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/bootstrap/js/bootstrap.min.js') }}></script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/select2/select2.min.js') }}></script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/daterangepicker/moment.min.js') }}></script>
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/daterangepicker/daterangepicker.js') }}></script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/slick/slick.min.js') }}></script>
<script type="text/javascript" src={{ secure_asset('clientpage/js/slick-custom.js') }}></script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/parallax100/parallax100.js') }}></script>
<script type="text/javascript">
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/countdowntime/countdowntime.js') }}></script>
<!--===============================================================================================-->
<script type="text/javascript" src={{ secure_asset('clientpage/vendor/lightbox2/js/lightbox.min.js') }}></script>
<!--===============================================================================================-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
<script src={{ secure_asset('clientpage/js/map-custom.js') }}></script>
<!--===============================================================================================-->
<script src={{ secure_asset('clientpage/js/main.js') }}></script>
</body>

</html>
