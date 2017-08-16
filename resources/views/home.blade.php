@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8  col-sm-8 col-lg-8">
            
            <div class="panel panel-default">
                 

                <div class="panel-heading">Dashboard</div>


                <passport-clients></passport-clients>
<passport-authorized-clients></passport-authorized-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">

            <mobile-money></mobile-money>   
        </div>
    </div>
    <div class="row">
        
        <div class="col-sm-12 col-md-6 col-lg-6">

            <transaction-money></transaction-money>  
        </div>

    </div>
</div>
@endsection

@section('script')
<!-- <script  src="js/vue.min.js"></script>

<script type="text/javascript" src="js/samplevue.js"></script>
 -->@endsection