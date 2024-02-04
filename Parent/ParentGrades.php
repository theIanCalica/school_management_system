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
              <th scope="col">SUBJECT</th>
              <th scope="col">GRADE</th>
            </tr>  
          </thead>
          <tbody>
            <tr>
              <th scope="row">Subject 1</th>
              <td>89.96</td>
            </tr>
            <tr>
              <th scope="row">Subject 2</th>
              <td>99.99</td>
            </tr>
            <tr>
              <th scope="row">Subject 3</th>
              <td>80.90</td>
            </tr>
            <tr>
              <th scope="row">Subject 4</th>
              <td>72.60</td>
            </tr>
            <tr>
              <th scope="row">Subject 5</th>
              <td>75.99</td>
            </tr>
            <tr>
              <th scope="row">Subject 6</th>
              <td>92.88</td>
            </tr>
            <tr>
              <th scope="row">Subject 7</th>
              <td>89.54</td>
            </tr>
            <tr>
              <th scope="row">Subject 8</th>
              <td>100.00</td>
            </tr>
            <tr>
              <th scope="row">Quarterly Average</th>
              <td>100.00</td>
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