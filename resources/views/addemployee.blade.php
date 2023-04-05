@extends('layout.app')
@section('title','Employe | Home')
@section('content')
	<div class="addemployeeDiv">
		<div class="card mt-4">
			<div class="card-header employeeCardHeader">
				<strong>Add Employee Managment</strong>
				<button class="btn addEmployee">Add Employee</button>
			</div>
			<div class="card-body">
				<table id="dataTable" class="employeeTbale table table-bordered table-hover table-striped d-none">
					<thead>
						<tr>
							<th>Name</th>
							<th>Department</th>
							<th>Self Id</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Office</th>
							<th>Road</th>
							<th>Status</th>
							<th>Image</th>
						</tr>
					</thead>
					<tbody class="employeeTbody">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<span class="employeeDisplayLoader"></span>
	<div class="nothingData d-none">
      <img src="{{asset('img/404.avif')}}">
    </div>
	

{{-- add Employee modal start form here --}}
<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Add Employee Managment</h5>
        <div class="employeePreviewImg">
        	<img src="">
        </div>
      </div>
      <form id="addemployeeForm" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="form-row">
                <div class="col-4">
                    <label for="image">Image:</label>
                    <input type="file" name="image" class="image form-control" required>
                </div> 
                <div class="col-4">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="name form-control" placeholder="Enter Your Name">
                </div> 
                <div class="col-4">
                	<label for="depart">Department:</label>
				  	<select name="depart" class="form-control" id="depart" required>
					    <option value="">--Select Department--</option>
					     @foreach($dataKey as $value)
	                    	<option value="{{$value->departName}}">{{$value->departName}}</option>
	                    @endforeach
					 </select>
                </div> 
            </div>
            <br>
            <div class="form-row">
            	<div class="col-4">
                    <label for="selfid">Self Id:</label>
                    <input type="number" name="selfid" class="selfid form-control" placeholder="Please Your id">
                </div> 
                <div class="col-4">
                	<label for="phone">Mobile</label>
                	<input type="number" name="phone" class="phone form-control" placeholder="Enter Your Phone">
                </div>
                <div class="col-4">
                	<label for="email">Email</label>
                	<input type="email" name="email" class="email form-control" placeholder="Enter Your Email">
                </div>
            </div>
            <br>
            <div class="form-row">
            	<div class="col-4">
                	<label for="office">Office</label>
                	<input type="text" name="office" class="office form-control" placeholder="Enter Your Office">
                </div>
                <div class="col-4">
                	<label for="road">Road</label>
                	<input type="text" name="road" class="road form-control" placeholder="Enter Your Road">
                </div>
                <div class="col-4 statusCollumnDiv">
                	<label for="status">Status:</label>
                	<input type="radio" name="status" value="Active" class="status"> Active
                	<input type="radio" name="status" value="Deactive" class="status"> Deactive
                </div>
            </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="submit" id="addEmployeeBtn" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add depart modal end form here --}}



@endsection()


@section('script')
<script type="text/javascript">
$(document).ready(function() {

	$('.addEmployee').click(function() {
		$('#addEmployee').modal('show');
	})

	$("#addemployeeForm").submit(function(e) {
		e.preventDefault();

		var name = $(".name").val();
		var selfid = $(".selfid").val();
		var phone = $(".phone").val();
		var email = $(".email").val();
		var office = $(".office").val();
		var road = $(".road").val();
		var status = $(".status").val();

		
		if (name == false) {
			toastr.error('Please Enter Your Name');
		}else if(selfid == false){
			toastr.error('Please Enter Your Self Id');
		}else if (phone == false) {
			toastr.error('Please Enter Your Mobile');
		}else if (email == false) {
			toastr.error('Please Enter Your Email');
			 
		}else if (office == false) {
			toastr.error('Please Enter Your Office');
		}else if(road == false) {
			toastr.error('Please Enter Your Road');
		}else {

			var addloader = "<span class='employeeAddLoader'></span>";
			$("#addEmployeeBtn").html(addloader);

			var url = "/createEmployee";
			var formData = new FormData(this);
			axios.post(url,formData)
			.then(function(response) {
				if (response.status == 200) {
					swal("Sucess!", "Employee Data Add Successfully", "success");
					employeeShow();
					$('#addEmployee').modal('hide');
					$("#addEmployeeBtn").html('Submit');
				}else{
					swal("Sorry!", "Employee Data Add Faild", "error");
					employeeShow();
					$('#addEmployee').modal('hide');
					$("#addEmployeeBtn").html('Submit');
				}
			})
			.catch(function(error) {
				swal("Sorry!", "Employee Data Add Faild", "error");
				employeeShow();
				$('#addEmployee').modal('hide');
				$("#addEmployeeBtn").html('Submit');
			})
		}
	})

})

employeeShow();

function employeeShow() {
	  var url = "/showEmployee";
      axios.get(url)
      .then(function(response) {
        if (response.status == 200) {
          $(".employeeTbale").removeClass('d-none');
          $(".employeeDisplayLoader").addClass('d-none');
          
          $('.employeeTbale').DataTable().destroy();
            $('.employeeTbody').empty();

          var resData = response.data;
          $.each(resData,function(i) {
            var id = "<td>"+resData[i].id+"</td>";
            var name = "<td>"+resData[i].name+"</td>";
            var Department = "<td>"+resData[i].Department+"</td>";
			      var selfid = "<td>"+resData[i].selfid+"</td>";
            var Phone = "<td>"+resData[i].Phone+"</td>";
            var Email = "<td>"+resData[i].Email+"</td>";
			      var Office = "<td>"+resData[i].Office+"</td>";
            var Road = "<td>"+resData[i].Road+"</td>";
           if (resData[i].Status == "Active") {
              var Status = "<td><p class='statusactive'>"+resData[i].Status+"</p></td>";
            } else {
              var Status = "<td><p class='statusdeactive'>"+resData[i].Status+"</p></td>";
            }
			      var img = "<td><img src='"+resData[i].img+"' style='width:50px;height:50px;'></td>";
            $("<tr>").html(name+Department+selfid+Phone+Email+Office+Road+Status+img).appendTo('.employeeTbody');
          });


          $(".employeeTbale").DataTable();
          $('.datatablees_length').addClass('bs-select');


        }else{
          $(".nothingData").removeClass('d-none');
          $(".employeeDisplayLoader").addClass('d-none');
        }
      })
      .catch(function(error) {
          $(".nothingData").removeClass('d-none');
          $(".employeeDisplayLoader").addClass('d-none');
      })
}
</script>
@endsection()