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

    <title>Admin Student Records</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Brand</h1>
        </div>
        <ul>
            <li><span class="links"><a href="admin.php">Dashboard</a></span></li>
            <li><span class="links"><a href="studentrecords.php">Students</a></span></li>
            <li><span class="links"><a href="teacherrecords.php">Teachers</a></span></li>
            <li><span class="links"><a href="parentrecords.php">Parents</a></span></li>
            <li><span class="links"><a href="section.php">Sections</a></span></li>
            <li><span class="links"><a href="subject.php">Subjects</a></span></li>
            <li><span class="links"><a href="class.php">Classes</a></span></li>
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

        
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Open modal for @mdo</button>
           
<div class="cards">
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Class Records</h2>
                    </div>
                    <table id="datatable">
                        
                      <thead>
                        <tr>
                          <td>Class ID</td>
                          <td>Section Name</td>
                          <td>Subject Name</td>
                       
                          <td>Actions</td>
                        </tr>
                      </thead>
                      <tbody>
                       
                       <?php 
                        $query = "SELECT c.*, sj.subjectName,s.sectionName FROM class c INNER JOIN sections s ON c.sectionID = s.sectionID INNER JOIN subject sj ON sj.subjectID = c.subjectID";

                        $query_run = mysqli_query($conn, $query);
                        
                        if($query_run) {
                          foreach($query_run as $row){
                            echo "
                              <tr>
                                <td>" . $row['classID'] ."</td>
                                <td>" . $row['sectionName'] . "</td>
                                <td>" . $row['subjectName'] ."</td>
                                
                                <td>
                                  <i style='color:green' class='fi fi-rr-edit updateBtn' ></i>
                                  <i style='color:red;' class='fi fi-rr-trash deleteBtn' data-id=" . $row['classID'] . "'></i>
                                  
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

    
   
<!--create modal-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHeader">Assign Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="classCRUD/create.php">
    <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Subject Name</label>
    <select name="subjectname" class="form-select" aria-label="Default Select Example">
        <?php 

        $query = "SELECT * FROM subject";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            foreach ($query_run as $row) {
            echo "<option value=" . $row['subjectID'] . ">" . $row['subjectName'] . "</option>";
          }
        }
      
        ?>
    </select>
</div>

    <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Section Name</label>
    <select name="sectionname" class="form-select" aria-label="Default Select Example">
<?php 

        $query = "SELECT * FROM sections";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            foreach ($query_run as $row) {
            echo "<option value=" . $row['sectionID'] . ">" . $row['sectionName'] . "</option>";
          }
        }
      
        ?>
    </select>
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


<!-- Edit -->
  <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Class</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="classCRUD/update.php" class="needs-validation" novalidate>
           <div class="modal-body">
            <input type="hidden" name="classID" id="classID" value="">
    <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Subject Name</label>
    <select name="edit_subjectid" class="form-select" aria-label="Default Select Example" required id="edit_subjectid">
        <?php 

        $query = "SELECT * FROM subject";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            foreach ($query_run as $row) {
            echo "<option value=" . $row['subjectID'] . ">" . $row['subjectName'] . "</option>";
          }
        }
      
        ?>
    </select>
</div>
          <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Assigned Section</label>
              <select name="edit_sectionid" class="form-select" aria-label="Default Select Example" required id="edit_sectionid">
                <option value=""selected disabled>Select a section</option>
                  <?php 
               $query = "SELECT * FROM sections";
        $query_run = mysqli_query($conn, $query);
        if($query_run){
            foreach ($query_run as $row) {
            echo "<option value=" . $row['sectionID'] . ">" . $row['sectionName'] . "</option>";
          }
        }
                  ?>
              </select>
              <div class="invalid-feedback">Section is required.</div>
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
<form action="classCRUD/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="classid_delete" id="classid_delete">
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
    $('#datatable').on('click', '.updateBtn', function(){
       var classID = $(this).data('id'); // Assuming the data attribute is 'data-id'
        $('#classID').val(classID);
        $('#editSubjectModal').modal('show');
           
        $tr = $(this).closest('tr');
        const data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
       
        console.log(data);
        const subjectName = data[2];
        const facultyID = $(this).data('facultyid');
        const subjectID = $(this).data('subjectid');
        console.log(facultyID);
        console.log(subjectID);
        $('#subjID_edit').val(subjectID);
        $('#edit_subject').val(subjectName);
        $('#ha option').each(function () {
            if ($(this).data('facultyid') == facultyID) {
                $(this).prop('selected', true);
            }
        });
    });

        $('#datatable').on('click', '.deleteBtn', function(){
               const id = $(this).data("id");
            console.log(id);  //show a prompt message to confirm if they want to delete it 
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
             $('#classid_delete').val(id);
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