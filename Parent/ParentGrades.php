<?php

require('ParentLayout/header.php');
require('ParentLayout/topbar.php');

?>

<!-- Page Wrapper -->
<div id="wrapper">

<?php
require('ParentLayout/sidebar.php');
?>


<div class="container overflow-hidden" style="margin-top: 50px;"> 
  <div class="row gx-5">
    <div class="col">
      <div class="p-3 border bg-light">

        <table class="table" style="margin-top: 20px;">
          <thead>
            <tr>
              <th scope="col">Written Work</th>
              <th scope="col">Performance Task</th>
              <th scope="col">Assessment</th>
            </tr>  
          </thead>
          <tbody>
            <tr>
              <td>
                <?php
                  $query = "SELECT * FROM studentGrades WHERE writtenWork = ?";
                ?>
              </td>
            </tr>


            <tr>
              <td>
                <?php
                  $query = "SELECT * FROM studentGrades WHERE performanceTask = ?";
                ?>
              </td>
            </tr>


            <tr>
              <td>
                <?php
                  $query = "SELECT * FROM studentGrades WHERE assessment = ?";
                ?>
              </td>
            </tr>

          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>



    </div>
    <!-- End of Page Wrapper -->


<?php

require('ParentLayout/script.php');

?>