<?php 
  require('phpcodes/connection.php');+
  require('layout/header.php');
  require('layout/sidebar.php');
?>
<div class="container">
  <?php 
    require('layout/navbar.php');
  ?>
<div class="content">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo" style="margin-left: 20px; margin-bottom: 2px; background-color: red; border: 0; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.10),0 17px 50px 0 rgba(0,0,0,0.10); ">Add work activity</button>
    <div class="cards">
    </div>
      <div class="content-2">
        <div class="recent-payments">
          <div class="title">
              <h2>Work Activity Records</h2>
          </div>
          <table id="datatable">
            <thead>
              <tr>
                <th>Work Activity ID</th>
                <th>Class ID</th>
                <th>Activity Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Score</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $query = "SELECT w.* FROM workActivity w INNER JOIN class c ON(c.classID = w.class_id)";
              $query_run = mysqli_query($conn, $query);
              
              if($query_run) {
                foreach ($query_run as $row) {
                  echo "
                      <tr>
                          <td>" . $row['sectionID'] . "</td>
                          <td>" . $row['sectionName'] . "</td>
                          <td>" . $row['gradelevel'] . "</td>
                          <td>" . $row['facultyName'] . "</td>
                          <td>
                              <i style='color:green' class='fi fi-rr-edit editBtn' data-facultyid='" . $row['facultyID'] . "'></i>
                              <i style='color:red;' class='fi fi-rr-trash deleteBtn'></i>
                          </td>
                      </tr>";
              }

              }
              ?>
            </tbody>
            <tfoot>
              <tr>
              <th>Work Activity ID</th>
                <th>Class ID</th>
                <th>Activity Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Score</th>
                <th>Actions</th>
              </tr>
            </tfoot>
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
          <h1 class="modal-title fs-5" id="modalHeader">Create Section</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="workActivityCRUD/create.php" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="col-form-label">Work activity title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div class="invalid-feedback">Title is required.</div>
            </div>
            <div class="mb-3">
                <label for="desc" class="col-form-label">Description</label>
                <textarea name="desc" id="desc" cols="15" rows="4" class="form-control" required></textarea>
                <div class="invalid-feedback">Description is required</div>
            </div>
            <div class="mb-3">
              <label for="classID" class="col-form-label">Class</label>
              <select name="classID" id="classID" class="form-select" aria-label="Default Select Example" required>
                <option value="" selected disabled>Select a class</option>
                  <?php 

                  $query = "SELECT c.*,st.sectionName, st.gradeLevel,s.subjectName FROM class c INNER JOIN subject s ON(s.subjectID = c.subjectID) INNER JOIN sections st ON(st.sectionID = c.sectionID)";
                  $query_run = mysqli_query($conn, $query);
                  if($query_run){
                      foreach ($query_run as $row) {
                      echo "<option value=" . $row['classID'] . ">" . $row['subjectName'] . "-".  $row['sectionName']. "-".$row['gradeLevel'] . "</option>";
                    }
                  }
                  ?>
              </select>
              <div class="invalid-feedback">Class is required</div>
            </div>
            <div class="mb-3">
              <label for="dueDate" class="col-form-label">Due Date </label>
              <input type="date" name="dueDate" id="dueDate" class="form-control" required>
              <div class="invalid-feedback">Due Date is required</div>
            </div>
            <div class="mb-3">
              <label for="score" class="col-form-label">Score</label>
              <input type="number" name="score" id="score" class="form-control" step="1" required oninput="validateNumberInput()" />
              <div class="invalid-feedback">Score is required</div>
            </div>
            <div class="mb-3">
              <label for="score" class="col-form-label">Files</label>
              <input type="file" name="files[]" id="files" class="form-control" multiple>
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
<form action="workActivity/delete.php" id="deleteForm" method="POST">
  <input type="hidden" name="workActivityID_delete" id="workActivityID_delete">
</form>
<?php 
  require('layout/scripts.php');
?>
<script>
  function validateNumberInput() {
    var inputElement = document.getElementById('score');
    var inputValue = inputElement.value;

    // Remove non-numeric characters and decimals using a regular expression
    inputValue = inputValue.replace(/[^0-9]/g, '');

    // Update the input value with the cleaned numeric value
    inputElement.value = inputValue;
}

</script>
    
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
        const sectionID = data[0];
        const sectionName = data[1];

        //yong data ay galing sa editbtn may data attribute siya
        const facultyID = $(this).data("facultyid");
       
        //nasa table lang to check mo console at index 2 yon
        const gradeLvl = data[2];
        console.log(gradeLvl);
        //Diba may input sa edit modal kunin mo id nila at ilagay yong mga values na meron na tayo ngayon
        $('#sectionEdit').val(sectionName);
        $('#sectionIDedit').val(sectionID);
        //Ang laman ng facultyID variable ay yong id nung teacher kung saang row yong clinick. After nun ichecheck yong data attribute ng
        // lahat ng option after nun kapag may match yon yong iseselect
        $('#facultyID_edit option').each(function () {
            if ($(this).data('facultyid') === facultyID) {
              $(this).prop('selected', true);
            }
        });

        $('#gradeLvl_edit option').each(function () {
            if ($(this).data('grd') == gradeLvl) {
              $(this).prop('selected', true);
            } else {
              console.log('mali');
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
            const sectionID = data[0];

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
              $('#sectionID_delete').val(sectionID);
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
  </body>
</html>