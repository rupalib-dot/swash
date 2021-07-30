
<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>{{$title}} | Swash</title>
    @include('admin.inc.styles')
    <style>
        .error-bg{
            background: #f7e6e6;
    padding: 10px;
    border-radius: 5px;
    border: solid 1px #f57b7b;
color:red}
        </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->
    <div class="wrapper">
        @include('admin.inc.navbar')
     
<div class="row">
    <div class="col-lg-2">
        @include('admin.inc.sidebar')
    </div>
    <div class="col-lg-10" style="padding: 40px;">
        @yield('content')
    </div>
</div>
    @include('admin.inc.footer')
    <script>
function payExpert(name,userid,amountLeft){ 
    $("#payexpertModal #amount").val(amountLeft);
    $("#payexpertModal #amount").attr('max',amountLeft);
    $("#payexpertModal #userid").val(userid);
    $("#payexpertModal .name").text(name);
    $("#payexpertModal").modal('show');
}
</script>
<script>
    $(document).ready(function (e) { 
        setInterval(function(){ $("div .alert").hide(); }, 4000); 

        $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        
        $('#payExpert').submit(function(e) { 
            e.preventDefault();
            var formData = new FormData(this);  
            $.ajax({
                type:'POST',
                url: "{{url('admin/payexpert-submit')}}",
                data: formData,
                cache:false,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {     
                    window.location.reload();
                    alert(response.message);  
                },
                error: function(xhr,status,error){  
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    $("#amount-error").text(err.errors.amount); 
                    $("#transaction_id-error").text(err.errors.transaction_id);
                    $("#transaction_date-error").text(err.errors.transaction_date);
                    $("#payment_mode-error").text(err.errors.payment_mode); 
                }
            });
        });
    });
</script>

