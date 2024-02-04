<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    require('phpcodes/connection.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    
    <title>Admin Teacher Records</title>
</head>

<body>
  
    <div class="side-menu">
        <div class="brand-name">
            <h1>Brand</h1>
        </div>
        <ul>
            <li><span><a href="admin.php">Dashboard</a></span></li>
            <li><span><a href="studentrecords.php">Students</a></span></li>
            <li><span><a href="teacherrecords.php">Teachers</a></span></li>
            <li><span><a href="parentrecords.php">Parents</a></span></li>
            <li><span><a href="income_link.php">Income</a></span></li>
            <li><span><a href="settings_link.php">Settings</a></span></li>
        </ul>

    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Search..">
                    <button type="submit"><img src="search.png" alt=""></button>
                </div>
                <div class="user">
                    <a href="#" class="btn">Add New</a>
                    <img src="notifications.png" alt="">
                    <div class="img-case">
                        <img src="user.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="content">


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addParentModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Add Parent</button>

            <div class="cards">
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Parent Records</h2>
                    </div>
                    <table id="datatable">
                      <thead>
                        <tr>
                          <td>Parent ID</td>
                          <td>First Name</td>
                          <td>Last Name</td>
                          <td>Mobile Number</td>
                          <td>Email Address</td>
                          <td>Actions</td>
                        </tr>
                      </thead>
                      <tbody>
                                                  <?php
                            $query = "SELECT * FROM parents";
                            $query_run = mysqli_query($conn, $query);

                            if ($query_run) {
                                foreach ($query_run as $row) {
                                    echo "
                                      <tr>
                                        <td>" . $row['parentID'] . "</td>
                                        <td>" . $row['parentFirstName'] . "</td>
                                        <td>" . $row['parentLastName'] . "</td>
                                        <td>" . $row['parentMobileNo'] . "</td>
                                        <td>" . $row['parentEmailAdd'] . "</td>
                                        

                                        <td>
                                          <i style='color:green' class='fi fi-rr-edit editBtn'></i>
                                          <i style='color:red;' class='fi fi-rr-trash deleteBtn'></i>
                                        </td>

                                      </tr>
                                    ";
                                }
                            }
                            ?>
                      </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

<!-- Add modal -->
<div class="modal fade" id="addParentModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Add Parent</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="parentCRUD/create.php" class="needs-validation" novalidate>
                    <input type="hidden" name="facultyID_edit" id="facuiltyID_edit">
                    <div class="mb-3">
                        <label for="fname_edit" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" required>
                        <div class="invalid-feedback">First Name is required</div>
                    </div>
                    <div class="mb-3">
                        <label for="lname_edit" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" required>
                        <div class="invalid-feedback">Last Name is required</div>
                    </div>
                    <div class="mb-3">
                        <label for="mn_edit" class="col-form-label">Mobile Number:</label>
                        <input type="text" class="form-control" id="mn" name="mn" required>
                        <div class="invalid-feedback">Mobile Number is required</div>
                    </div>
                    <div class="mb-3">
                        <label for="ea_edit" class="col-form-label">Email Address:</label>
                        <input type="email" class="form-control" id="ea" name="ea" required>
                        <div class="invalid-feedback">Email Address is required</div>
                    </div>
                    <div class="mb-3">
                        <label for="password_edit" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">Password is required</div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit modal -->
<div class="modal fade" id="editParentModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Add Parent</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="parentCRUD/update.php" class="needs-validation" novalidate>
                    <input type="hidden" name="parentID_edit" id="parentID_edit">
                    <div class="mb-3">
                        <label for="fname_edit" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="fname_edit" name="fname" required>
                    </div>
                    <div class="mb-3">
                        <label for="lname_edit" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lname_edit" name="lname" required>
                    </div>
                    <div class="mb-3">
                        <label for="mn_edit" class="col-form-label">Mobile Number:</label>
                        <input type="text" class="form-control" id="mn_edit" name="mn" required>
                    </div>
                    <div class="mb-3">
                        <label for="ea_edit" class="col-form-label">Email Address:</label>
                        <input type="text" class="form-control" id="ea_edit" name="ea" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_edit" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="password_edit" name="password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Form for deleting a row -->
<form action="parentCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="parentID" id="teacherID_delete">
</form>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
      let table = new DataTable('#datatable');
    </script> 

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
    $(document).ready(function(){
        $('#datatable').on('click', '.editBtn', function(){
          
            $('#editParentModal').modal('show');
            $tr = $(this).closest('tr'); // Fix the typo here: 'closts' to 'closest'
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
        
            // Getting values from table from a specifci row where the edit icon was clicked
            const parentID = data[0];
            const fname = data[1];
            const lname = data[2];
            const mn = data[3];
            const ea = data[4];
            const password = data[5];
          $('#parentID_edit').val(parentID);
          $('#fname_edit').val(fname);
          $('#lname_edit').val(lname);
          $('#mn_edit').val(mn);
          $('#ea_edit').val(ea);
         
          
          console.log($('#password_edit').val());

        });

        $('#datatable').on('click', '.deleteBtn', function(){
          console.log('hi');
          //Get id from table
          $tr = $(this).closest('tr'); // Fix the typo here: 'closts' to 'closest'
          const data = $tr.children("td").map(function() {
              return $(this).text();
          }).get();
          console.log(data);  

          const parentID = data[0];
            //show a prompt message to confirm if they want to delete it 
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
          }).then((result) => {
            if (result.isConfirmed) {
              $('#teacherID_delete').val(parentID);
              $('#deleteForm').submit();
            }
          });
        }); 
    });
</script>



<?php 
  if(isset($_SESSION['status']) && $_SESSION['status'] != ""){
    ?>

    <script>
      Swal.fire({
        icon: '<?php echo $_SESSION['status_code'] ?>',
        title: '<?php echo $_SESSION['status'] ?>',
      })
    </script>
    <?php 
  }
    unset($_SESSION['status']);
     unset($_SESSION['status_code']);
  ?>
?>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
  </body>
</html>