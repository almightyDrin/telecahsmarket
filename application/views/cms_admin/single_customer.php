  <div class="row justify-content-center align-items-center">
    <div class="col-md-6 text-center my-4">
      <div class="customer-icon fa fa-user mb-3"></div>
      <h5><?=ucwords($customer['full_name'])?></h5>
    </div>
    <div class="col-md-6 my-4">
      <table class="table table-customer-information">
        <tbody>
          <tr>
            <td class="border-top-0">Cashmarket:</td>
            <td class="border-top-0"><?=ucfirst($customer['cashmarket'])?></td>
          </tr>
          <tr>
            <td>Registration Date:</td>
            <td><?=date("F j, Y, g:i a", strtotime($customer['created_date']))?></td>
          </tr>
          <tr>
            <td>Telesale Attended:</td>
            <td><?=$customer['ts_attended']?></td>
          </tr>
          <tr>
            <td>Deposited:</td>
            <td><?=($customer['deposit'] === '1') ? 'Yes' : 'No' ?></td>
          </tr>
          <tr>
            <td>Date of Birth</td>
            <td><?=date("F j, Y", strtotime($customer['date_of_birth']))?></td>
          </tr>
          <!-- <tr>
            <td>Gender</td>
            <td>Female</td>
          </tr>
          <tr>
            <td>Home Address</td>
            <td>Kathmandu,Nepal</td>
          </tr>
          <tr> -->
            <td>Email</td>
            <td><a href="mailto:<?=$customer['email']?>"><?=$customer['email']?></a></td>
          </tr>
            <td>Contact Number</td>
            <td><a href="tel:<?=$customer['contact_num']?>"><?=$customer['contact_num']?></a></td>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>