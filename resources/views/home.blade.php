@extends('layout.app')
@section('title','Employe | Home')
@section('content')
<br>
    <div class="adminHomePage">
    	<div class="row">
    		<div class="col-4">
    			<div class="card ">
    				<div class="card-body homeCardBody">
    					<h4>All Department</h4>
                        <h4>{{$departCount}}</h4>
    				</div>
    				<div class="card-footer">
    					<a href="{{url('admin/department')}}">
    						<span class="">Department</span>
    						<span class="fas fa-arrow-right float-right"></span>
    					</a>
    				</div>
    			</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
    				<div class="card-body homeCardBody">
    					<h4>All Employee</h4>
    					<h4>{{$emploCount}}</h4>
    				</div>
    				<div class="card-footer">
    					<a href="{{url('admin/viewemployee')}}">
    						<span class="">Employee</span>
    						<span class="fas fa-arrow-right float-right"></span>
    					</a>
    				</div>
    			</div>
    		</div>
    		<div class="col-4">
    			<div class="card">
    				<div class="card-body homeCardBody">
    					<h4>All Users</h4>
    					<h4>{{$userCooutn}}</h4>
    				</div>
    				<div class="card-footer">
    					<a href="">
    						<span class="">Users</span>
    						<span class="fas fa-arrow-right float-right"></span>
    					</a>
    				</div>
    			</div>
    		</div>
    	</div>
    	<br>
    	<div class="chartDiv">
    		<div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Area Chart Example
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Bar Chart Example
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
@endsection()
@section('chartScript')
<script type="text/javascript">
/*chart bar custom js start form here*/
  var _ychartbardate = JSON.parse('{!! json_encode($departMounts) !!}');
  var _xchartbardate = JSON.parse('{!! json_encode($departMountCount) !!}');
/*chart bar custom js end form here*/
/*chart area custom js start form here*/
 var _ychartareamounts = JSON.parse('{!! json_encode($empmounts) !!}');
  var _xchartareamountcount = JSON.parse('{!! json_encode($empmountCount) !!}');
/*chart area custom js end form here*/


</script>
@endsection()