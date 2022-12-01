// filter 
<div class="collapse" id="collapseExample">
  <div class="card card-body">
  <form  method="post" id="filter">
                                        <div class="form-row">
                                            <div class="col-2">
                                                <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                                            </div>
                                            <div class="col-2">
                                                <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                            <div class="col-2">
                                                <select id="searchByCat" name="searchByCat" class="form-control form-control-sm" required>
                                                    <option value="">-- Select Category --</option>
                                                    <option value="member_id">MEMBER ID</option>
                                                    <option value="parent">PARENT</option>
                                                    <option value="email">EMAIL</option>
                                                    <option value="phone">PHONE</option>
                                                    <option value="roles_id">User Type</option>
                                                </select>
                                            </div>
              
                                            <div class="col-2">
                                                <input type="text" name="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                                            </div>
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                            <button id='simplefilter'    class="btn btn-primary btn-xs"> <i class="fas fa-search"></i> Search</button>
                                            <button id='clear'    class="btn btn-primary btn-xs"> <i class="fas fa-eraser"></i> Clear</button>
                                        </div>
                                    </form>
  </div>
</div>


<div class="row"  ng-controller="squad">
    <div class="col-xl-3 col-md-6">
      <div class="card card-stats border-0 node" data-info="all">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase mb-0">Total Users</h5>
              <span class="h2 font-weight-bold mb-0">{{all}}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="ni ni-single-02"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card card-stats node border-0" data-info="new">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
              <span class="h2 font-weight-bold mb-0">{{new}}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                <i class="ni ni-circle-08"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card card-stats border-0 node" data-info="active">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Active Users</h5>
              <span class="h2 font-weight-bold mb-0">{{active}}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="ni ni-user-run"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card card-stats border-0 node" data-info="pending">
        <!-- Card body -->
         <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Total Balance</h5>
              <span class="h2 font-weight-bold mb-0" id="balance" style="font-size:14px;"></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                <i class="ni ni-chart-bar-32"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <!--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
            <span class="text-nowrap member"></span>
          </p>
        </div>
      </div>
    </div>
  </div>
<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col-4">
             <div class="form-group">
                              <label class="form-control-label">Select Member</label>
                              <select name="user_role" id="role" class="form-control" required>
                                  <option value="">Select Role</option>
                                  <option value="">All</option>
                              </select>
                          </div>
          </div>
          <div class="col text-right">
            <a href="#!" id="notify" class="btn btn-sm btn-primary export">Export</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush" id="squadlist">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Password</th>
              <th scope="col">STATUS</th>
              <th scope="col">MEMBER ID</th>
              <th scope="col">PARENT</th>
              <?php if (isAdmin($this->session->userdata('user_roles')))
              { ?>
             <th scope="col">BALANCE</th>
               <?php }?>
              <th scope="col">EMAIL</th>
              <th scope="col">PHONE</th>
              <th scope="col">User Type</th>
              <th scope="col">KYC</th>
              <th scope="col">Join Date</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<!--Start Reset Password-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

  function Password(id) {

    var sureDel = confirm("Are you sure want to Change Password");
    if (sureDel == true) {
                        
        
        Swal.fire({
          title: 'Enter Your Password',
          input: 'text',
          showCancelButton: true,
          preConfirm: (value) => {
            if (!value) {
              Swal.showValidationMessage(
                '<i class="fa fa-info-circle"></i>Password is required'
              )
            }else{
                
                    var csrfName = '<?php echo $this->security->get_csrf_token_name();?>',
                    csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
                    var data = { [csrfName]: csrfHash , password: value, user_id: id };
            
                      $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('/user/UserController/resetpass')?>",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                          if (response.status == true) {
            
                            Swal.fire({
                              position: 'top-end',
                              type: 'success',
                              title: 'Password Reset Successfully',
                              showConfirmButton: false,
                              timer: 3500
                              
                            });
                          } else {
                            Swal.fire({
                              position: 'top-end',
                              type: 'error',
                              title: 'Something went wrong',
                              showConfirmButton: false,
                              timer: 3500
                            });
                          }
                        //  location.reload()
                        }
                      });
            }
          }
    })
    

    }

  } 
  
  $(document).ready(function()
  {
     $('.export').click(function()
         {
             var Api = '<?php echo base_url('user/UserController/'); ?>';
             var duid = '<?php echo $this->session->userdata("user_id") ?>';
             $.ajax({
                url: Api +"export?key="+duid,
                type: "get", //send it through get method
                success: function(response) {
               //Do Something
              console.log(response);
               
              window.location=response;
                  },
              error: function(xhr) {
              //Do Something to handle error
            }
              });
         })
      
  })
  
  function block(id,status)
   {
       console.log(id);
       console.log(status);
    //   var member_id=$('#member_id').text();
    //   var status=$('#status').text();
        //  if(status=='active')
        //       {
        //           status1='deactived';
        //       }
        //       else
        //       {
        //          status1='actived';  
        //       }
        //   Swal.fire({
        //       title: 'Are you sure?',
        //       text: "You want "+status1+" of "+member_id+"!",
        //       showCancelButton: true,
        //       confirmButtonColor: '#3085d6',
        //       cancelButtonColor: '#d33',
        //       confirmButtonText: 'Yes, '+status1+' it!'
        //   }).then((result) => {
        //          if (result.value==true) {
        //             console.log("hello");
        //             $.ajax({
        //         url: Api + "staus_change",
        //         type: "get", //send it through get method
        //       data: { 
        //           'id': $id,
        //           'status':status
        //             },
        //       success: function(response) {
        //       if(status=='active')
        //       {
        //           status1='deactived';
        //       }
        //       else
        //       {
        //          status1='actived';  
        //       }
        //         if(response==1)
        //         {
        //             swal({title: "Status Updated", text: "Status is "+status1, type: "success"});
        //         }
        //       //Do Something
        //      location.reload()
        //           },
        //       error: function(xhr) {
        //       //Do Something to handle error
        //     }
        //       });
        //   }
        //          else
        //          {
        //             swal({title: "Sorry!", text: "Status not Updated", type: "dange"}); 
        //          }
        // })
   }
   
</script>

<!--End Reset Password-->
