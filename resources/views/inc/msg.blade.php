@if(Session::has('Failed'))
<style>
    .text-danger {
    color: red;
    border: 1px solid red;
    padding: 5px 10px;
    border-radius: 3px;
    box-shadow: 0px 0px 5px;
}
</style>
<p class="text-danger">{{Session::get('Failed')}}</p>
@endif

@if(Session::has('Success'))
<style>
    .text-success {
    color: #3c763d;
    border: 1px solid #3c763d;
    padding: 5px 10px;
    border-radius: 3px;
    box-shadow: 0px 0px 5px;
}
</style>
<p class="text-success">{{Session::get('Success')}}</p>
@endif
