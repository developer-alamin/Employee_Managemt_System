@extends('layout.app')
@section('title','Employe | Home')
@section('content')
    <div class="departmentDiv">
        <div class="card mt-3">
            <div class="card-header departHeader">
               <strong>Department Manage</strong>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover table-striped departTable d-none">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Department Name</th>
                            <th>Date</th>
                            <th>Action</th>
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




{{-- depart edit show html code start form here --}}
<div class="modal fade" id="departUpdate" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h6>Employee Department Managment Show Data</h6>
        <div class="departEditIdDiv">
          <h4></h4>
        </div>
      </div>
      <div class="uploading">
        <span class="upSpanloader"></span>
      </div>
      <form id="updateForm">
        @csrf
         <div class="container">
          <input type="hidden" id="upid" name="upid">
            <div class="form-row">
                <div class="col-12">
                    <label for="updepart">DepartMent Name:</label>
                    <input type="text" name="updepart" class="updepart form-control">
                </div> 
                <div class="col-12">
                    <label for="updepartdate">Date:</label>
                    <input type="text" name="update" id="updepartdate" class="form-control">
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
{{-- depart edit show html code end form here --}}

   
@endsection()
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
       departShow();
       departUpdate()
    })
    
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
            var edit = "<td><i class='fas fa-edit' data-edit="+resData[i].id+"></i> "+" <i class='fas fa-trash' data-delete="+resData[i].id+"></i></td>";
            $("<tr>").html(id+name+date+edit).appendTo('.departTbody');
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


function EditShow(id) {
  var url = "/departUpShow";
   axios.post(url,{id:id})
    .then(function(response) {
      if (response.status == 200) {
        $('.uploading').addClass('d-none');
        var jsonShowData = response.data;

        $("#upid").val(jsonShowData[0].id);
    $(".updepart").val(jsonShowData[0].departName);

        $('#updepartdate').val(jsonShowData[0].date);
      } else {
        $('.upnothingData').removeClass('d-none');
        $('.uploading').addClass('d-none');
      }

    })
    .catch(function(error) {
      $('.upnothingData').removeClass('d-none');
        $('.uploading').addClass('d-none');
    })
}


function departUpdate() {
  $("#updateForm").submit(function(e) {
    e.preventDefault();
    const fd = new FormData(this);

    var uploader = "<span class='loader'></span>";
     $("#updateButton").html(uploader);


    $.ajax({
      url: '/departUpdated',
      method: 'post',
      data: fd,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response) {
        swal("Updated", "Updated SuucessFully!", "success");
        departShow();
        $('#departUpdate').modal('hide');
        $('#updateButton').html('Update');
        addDepart();
      },
      error: function(error) {
        swal("Sorry", "Your Data Updated Faild");
        departShow();
       $('#departUpdate').modal('hide');
        $('#updateButton').html('Update');
        addDepart();
      }
    });
  });
}


function departDelete(id) {
  var url = "/departDelete"
  swal({
      title: "Are you sure?",
      text: "Are You Want To Department Data Deleted!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        axios.post(url,{deleteid:id})
          .then(function(response) {
            swal("Success", "Your Data Deleted Success!", "success");
            departShow();
          })
          .catch(function(error) {
            swal("Sorry...", "Your Data Not Deleted!", "error");
          })
      }
    });
}

   
</script>
@endsection()
