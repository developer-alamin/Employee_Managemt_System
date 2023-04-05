@extends('layout.app')
@section('title','Employe | Home')
@section('content')
	  <div class="departmentDiv">
        <div class="card mt-3">
            <div class="card-header departHeader">
               <strong>Department Manage</strong>
                <button class="btn departButton">Add Department</button>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover table-striped departTable d-none">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Department Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="departTbody text-center">
                      
                    </tbody>
                </table>
            </div>
            <div class="nothingData d-none">
              <img src="{{asset('img/404.avif')}}">
            </div>
        </div>
    </div>


    <div class="loading">
      <span class="Spanloader"></span>
    </div>

{{-- add depart modal start form here --}}
<div class="modal fade" id="adddepartModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header adddepartHeader">
        <h5>Add Department Data</h5>
      </div>
      <form id="addDepart">
        @csrf
        <div class="container">
            <div class="form-row">
                <div class="col-12">
                    <label for="depart">DepartMent Name:</label>
                    <input type="text" name="depart" class="depart form-control" placeholder="Enter Your Department Name">
                </div> 
                <div class="col-12">
                    <label for="date">Date:</label>
                    <input type="text" name="date" class="datePicar form-control" placeholder=" Date Name">
                </div> 
            </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Submit</button>
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

       addDepart();
       departShow();
    })

    function addDepart() {
      $(".departButton").click(function() {
          $("#adddepartModal").modal('show');
       })
       $("#addDepart").submit(function(e) {
          e.preventDefault();
          
          var derpartName = $('.depart').val();
          var date = $('.datePicar').val();
          if (derpartName == false) {
            toastr.error("Please Enter Your Department Name");
          }else if(date == false){
            toastr.error("Please Enter Your Department Date");
          }else{
            var addBtnLoader = "<span class='loader'></span>";
            $("#add_employee_btn").html(addBtnLoader);

            var url = "/createDepart";
            axios.post(url,{data:derpartName,date:date})
            .then(function(response) {
             if (response.status == 200) {
               swal("Success!", "Your Department Add Success!", "success");
               $("#adddepartModal").modal('hide');
               departShow();
               $('input').val("");
               $("#add_employee_btn").html('Submit');
             }else{
               swal("Not!", "Your Department Addd Faild!", "error");
               $("#adddepartModal").modal('hide');
                departShow();
               $("#add_employee_btn").html('Submit');
             }
            })
            .catch(function(error) {
               swal("Not!", "Your Department Addd Faild!", "error");
               $("#adddepartModal").modal('hide');
                departShow();
               $("#add_employee_btn").html('Submit');
            })


          }

       })
    }

  function departShow() {
      var url = "/showDepart";
      axios.get(url)
      .then(function(response) {
        if (response.status == 200) {
          $(".departTable").removeClass('d-none');
          $(".Spanloader").addClass('d-none');
          
          $('#dataTable').DataTable().destroy();
            $('.departTbody').empty();

          var resData = response.data;
          $.each(resData,function(i) {
            var id = "<td>"+resData[i].id+"</td>";
            var name = "<td>"+resData[i].departName+"</td>";
            var date = "<td>"+resData[i].date+"</td>";
            $("<tr>").html(id+name+date).appendTo('.departTbody');
          });

          $(".fa-edit").click(function() {
            $('#departUpdate').modal('show');
            var id = $(this).data('edit');
            $(".departEditIdDiv h4").html(id);
            EditShow(id);
          })

          $(".fa-trash").click(function() {
            var id = $(this).data('delete');
            departDelete(id);
          })



          $("#dataTable").DataTable();
          $('.datatablees_length').addClass('bs-select');


        }else{
          $(".nothingData").removeClass('d-none');
          $(".Spanloader").addClass('d-none');
        }
      })
      .catch(function(error) {
          $(".nothingData").removeClass('d-none');
          $(".Spanloader").addClass('d-none');
      })
    }
</script>
@endsection()