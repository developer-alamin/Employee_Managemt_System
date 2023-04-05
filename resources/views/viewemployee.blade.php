@extends('layout.app')
@section('title','Employe | Home')
@section('content')
	<div class="addemployeeDiv">
		<div class="card mt-4">
			<div class="card-header employeeCardHeader">
				<strong>Add Employee Managment</strong>
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
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="employeeTbody text-center">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<span class="employeeDisplayLoader"></span>
	<div class="nothingData d-none">
      <img src="{{asset('img/404.avif')}}">
    </div>

  {{-- Employee edit show html code start form here --}}
<div class="modal fade" id="employeeUpdate" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6>Employee Managment Show Data</h6>
        <div class="upemEditIdDiv">
          <h4></h4>
          <img src="" class="UpEmPreviewImg">
        </div>
      </div>
      <div class="uploading">
       <span class="upemanimationloader"></span>
      </div>
      <form id="emupdateForm">
        @csrf
         <div class="container">
         	<input type="hidden" name="emuppreImg" class="emuppreImg">
         	<input type="hidden" name="emupid" class="emupid">
          	<div class="form-row">
                <div class="col-4">
                    <label for="emupimage">Image:</label>
                    <input type="file" name="emupimage" class="emupimage form-control">
                </div> 
                <div class="col-4">
                    <label for="upname">Name:</label>
                    <input type="text" name="upname" class="upname form-control">
                </div> 
                <div class="col-4">
                	<label for="updepart">Department:</label>
				  	<select name="updepart" class="form-control" id="updepart">
					     @foreach($dataKey as $value)
	                    	<option value="{{$value->departName}}">{{$value->departName}}</option>
	                    @endforeach
					 </select>
                </div> 
            </div>
            <br>
            <div class="form-row">
            	<div class="col-4">
                    <label for="upselfid">Self Id:</label>
                    <input type="number" name="upselfid" class="upselfid form-control">
                </div> 
                <div class="col-4">
                	<label for="upphone">Mobile</label>
                	<input type="number" name="upphone" class="upphone form-control">
                </div>
                <div class="col-4">
                	<label for="upemail">Email</label>
                	<input type="email" name="upemail" class="upemail form-control">
                </div>
            </div>
            <br>
            <div class="form-row">
            	<div class="col-4">
                	<label for="upoffice">Office</label>
                	<input type="text" name="upoffice" class="upoffice form-control">
                </div>
                <div class="col-4">
                	<label for="uproad">Road</label>
                	<input type="text" name="uproad" class="uproad form-control">
                </div>
                <div class="col-4 statusCollumnDiv">
                	<label for="upstatus">Status:</label>
                	<input type="radio" name="upstatus" value="Active" class="upstatus active"> Active
                	<input type="radio" name="upstatus" value="Deactive" class="upstatus deactive"> Deactive
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
        </div>
      </form>
      <div class="upnothingData d-none">
        <img src="{{asset('img/404.avif')}}">
      </div>
    </div>
  </div>
</div>
{{-- Employee edit show html code end form here --}}
@endsection()

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		employeeShow();
		employeUpdate()
	})



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
       var action = "<td><i class='fas fa-edit' data-edit="+resData[i].id+"></i> "+" <i class='fas fa-trash' data-delete="+resData[i].id+"></i></td>";
            $("<tr>").html(name+Department+selfid+Phone+Email+Office+Road+Status+img+action).appendTo('.employeeTbody');
          });

          $(".fa-edit").click(function() {
            $("#employeeUpdate").modal('show');
            var id =$(this).data("edit");
            EditShow(id);
          })
          
          $(".fa-trash").click(function() {
            var deleteId = $(this).data("delete");
            employeeDelete(deleteId);
          })

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

function EditShow(id) {
  var url = "/employeeUpShow";
   axios.post(url,{id:id})
    .then(function(response) {
      if (response.status == 200) {
        $('.upemanimationloader').addClass('d-none');
        var jsonShowData = response.data;

        $(".emupid").val(jsonShowData[0].id);
      $(".upname").val(jsonShowData[0].name);
    $("#updepart").val(jsonShowData[0].Department);
    $(".upselfid").val(jsonShowData[0].selfid);
    $(".upphone").val(jsonShowData[0].Phone);
    $(".upemail").val(jsonShowData[0].Email);
    $(".upoffice").val(jsonShowData[0].Office);
    $(".uproad").val(jsonShowData[0].Road);
    var status = jsonShowData[0].Status;
    if (status == "Active") {
      $(".active").attr('checked','checked');
      $(".active").attr('value','Active');
    }else{
      $(".deactive").attr('checked','checked');
      $(".deactive").attr('value','Deactive')
    }

        $('.UpEmPreviewImg').attr('src',jsonShowData[0].img);
    $('.emuppreImg').val(jsonShowData[0].img);


      } else {
        $('.upnothingData').removeClass('d-none');
        $('.upemanimationloader').addClass('d-none');
      }

    })
    .catch(function(error) {
        $('.upnothingData').removeClass('d-none');
        $('.upemanimationloader').addClass('d-none');
    })
}


function employeUpdate() {
  $("#emupdateForm").submit(function(e) {
    e.preventDefault();
    const fd = new FormData(this);

    var uploader = "<span class='employeeAddLoader'></span>";
     $("#updateButton").html(uploader);

    $.ajax({
      url: '/employeeUpdate',
      method: 'post',
      data: fd,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response) {
        swal("Updated", "Updated SuucessFully!", "success");
        employeeShow();
        $('#employeeUpdate').modal('hide');
        $('#updateButton').html('Update');
      },
      error: function(error) {
        swal("Sorry", "Updated Faild!", "error");
        employeeShow();
       $('#employeeUpdate').modal('hide');
        $('#updateButton').html('Update');
      }
    });
  });
}


function employeeDelete(deleteId) {
  var url = "/employeeDelete"
    swal({
        title: "Are you sure?",
        text: "Are You Want To Employee Data Deleted!",
        icon: "warning",
        buttons: true,
        dangerMode: true
   })
    .then((willDelete) => {
      if (willDelete) {
        axios.post(url,{deleteid:deleteId})
          .then(function(response) {
            swal("Success", "Your Data Deleted Success!", "success");
            employeeShow();
          })
          .catch(function(error) {
            swal("Sorry...", "Your Data Not Deleted!", "error");
            employeeShow();
          })
      }
    });
}

</script>
@endsection()
