<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    require('../db/config.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    
    <title>Learning Materials Records</title>
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


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo">Add activity</button>

            <div class="cards">
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Course Materials Records</h2>
                    </div>
                    <table id="datatable">
                      <thead>
                        <tr>
                          <td>Work Activity ID</td>
                          <td>Activity Name</td>
                          <td>Activity Description</td>
                          <td>File</td>
                          <td>Duedate</td>
                          <td>Class ID</td>
                          <td>Actions</td>
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                        $query = "SELECT * FROM workactivity";
                        $query_run = mysqli_query($conn, $query);
                        
                        if($query_run) {
                          foreach($query_run as $row){
                            echo "
                              <tr>
                                <td>" . $row['workActivityID'] ."</td>
                                <td>" . $row['actName'] ."</td>
                                <td>" . $row['actDesc'] ."</td>
                                <td>" . $row['actUploadFile'] ."</td>
                                <td>" . $row['actSetDueDate'] ."</td>
                                <td>" . $row['classID'] ."</td>
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


<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Add Activity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="assignmentCRUD/create.php" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Activity Name</label>
                        <input type="text" class="form-control" id="activityname" name="activityname" required>
                        <div class="invalid-feedback">Activity name is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Activity Description</label>
                        <textarea class="form-control" id="activitydescription" name="activitydescription" required></textarea>
                       <div class="invalid-feedback">Activity Description is required</div>
                      </div>
                 
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="uploadfile" name="uploadfile[]" multiple required>
                           <div class="invalid-feedback">Activity File is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Duedate</label>
                        <input type="date" class="form-control" id="duedate" name="duedate" required></input>
                       <div class="invalid-feedback">Duedate is required</div>
                      </div>


                                              <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Assigned Class</label>
              <select name="class" class="form-select" aria-label="Default Select Example" required>
                <option value=""selected disabled>Select a class</option>
                  <?php 
          $query = "SELECT class.*, subject.*, sections.* FROM class INNER JOIN sections ON class.sectionID = sections.sectionID INNER JOIN subject ON class.subjectID = subject.subjectID;";
                                          $query_run = mysqli_query($conn,$query);
                                          
                                          if ($query_run) {
                                              foreach ($query_run as $row) {
                                                  echo "<option value=" . $row['classID'] .">" .  $row['subjecName'] . "-" . $row['sectionName'] ."</option>";
                                              }
                                            }
                  ?>
              </select>
              <div class="invalid-feedback">Class is required.</div>
          </div>

                </div>
                



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

  
<!-- Edit modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Edit Learning Materials</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           <form action="learningmaterialsCRUD/update.php" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
            <input type="hidden" name="learningmaterialid" id="learningmaterialid_edit">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Topic Name</label>
                        <input type="text" class="form-control" id="activityname" name="activityname" required>
                        <div class="invalid-feedback">Topic Name is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="regionNameID" class="form-label">Topic Description</label>
                        <textarea class="form-control" id="activitydescription" name="activitydescription" required></textarea>
                        <div class="invalid-feedback">Topic Description is required</div>
                    </div>

                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="uploadFile_edit" name="uploadfile[]">
                    </div>
                </div>

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Assigned Class</label>
              <select name="class" class="form-select" aria-label="Default Select Example" id="classid_edit" required>
                <option value=""selected disabled>Select a class</option>
                  <?php 
          $query = "SELECT class.*, subject.*, sections.* FROM class INNER JOIN sections ON class.sectionID = sections.sectionID INNER JOIN subject ON class.subjectID = subject.subjectID;";
                                          $query_run = mysqli_query($conn,$query);
                                          
                                          if ($query_run) {
                                              foreach ($query_run as $row) {
                                                  echo "<option value=" . $row['classID'] ." data-classid=".$row['classID'].">" .  $row['subjectName'] . "-" . $row['sectionName'] ."</option>";
                                              }
                                            }
                  ?>
              </select>
              <div class="invalid-feedback">Class is required.</div>
          </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form for deleting a row -->
<form action="assignmentCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="activityname_delete" id="activityname_delete">
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
        //Show modal
        $('#editTeacherModal').modal('show');
        
        //Get the values on the tablex
        $tr = $(this).closest('tr'); 
        const data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        
        //Check mo yong console at yong index nung array na lalabas yan yong pagkakasunod nun
        const learningmaterialid = data[0];
        const title = data[1];
        const desc = data[2];
        const classid = data[4];

        //Diba may input sa edit modal kunin mo id nila at ilagay yong mga values na meron na tayo ngayon
        $('#activityname').val(title);
        $('#activitydescription').val(desc);
        $('#learningmaterialid_edit').val(learningmaterialid);
        
        //Ang laman ng facultyID variable ay yong id nung teacher kung saang row yong clinick. After nun ichecheck yong data attribute ng
        // lahat ng option after nun kapag may match yon yong iseselect
        $('#classid_edit option').each(function () {
            if ($(this).data('classid') == classid) {
              $(this).prop('selected', true);
            }
        });

      });

        $('#datatable').on('click', '.deleteBtn', function(){
        
          //Get id from table
           $tr = $(this).closest('tr'); 
            const data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);  

            //Get the sectionid on the table
            const workActivityID = data[0];

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
              $('#activityname_delete').val(workActivityID);
              $('#deleteForm').submit();
            }
          });
        }); 
    });
</script>

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
  </body>
</html>