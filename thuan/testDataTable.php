<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Data table</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
      <div id="container-data-bill" style="margin: 50px 0 50px 200px;">
         <form action="" method="GET" id="BillFormGroup">
            <select id="statusBills" name="status" class="custom-select mb-3" style="width: 200px;" onchange="ClickBtnBill()">
               <option selected value='-2'>>--Select Status--<</option>
               <option value='0'>Chua xu ly</option>
               <option value='1'>Da xu ly</option>
               <option value='2'>Da giao hang</option>
            </select>
            <select id="monthBills" name="month" class="custom-select mb-3" style="width: 280px;" onchange="ClickBtnBill()">
               <option selected value='0'>>--Select Month--<</option>
               <option value='1'>Janaury</option>
               <option value='2'>February</option>
               <option value='3'>March</option>
               <option value='4'>April</option>
               <option value='5'>May</option>
               <option value='6'>June</option>
               <option value='7'>July</option>
               <option value='8'>August</option>
               <option value='9'>September</option>
               <option value='10'>October</option>
               <option value='11'>November</option>
               <option value='12'>December</option>
            </select>
            <select id="yearBills" name="year" class="custom-select mb-3" style="width: 280px;" onchange="ClickBtnBill()">
            </select>
            <button class="btn btn-warning" onclick="funcAllBills()" style="cursor: pointer; margin-left: 20px;">All Bills</button>
            <input type="submit" name="submit" value="Submit-Bill" id="btnSubmitBill"
               style="visibility: hidden; opacity: 0;" />    
         </form>
         <form action="" method="POST" id="formActionBill">
            <input type="hidden" name="statusBill" value="" id="statusBill">
            <input type="hidden" name="idBill" value="" id="idBill">
            <input type="hidden" name="typeActionBill" value="" id="typeActionBill">
            <input type="submit" name="submit" value="Submit-Bill" id="btnActionBill"
               style="visibility: hidden; opacity: 0;" />
         </form>
         <script>
            var start = 2015;
            var end = new Date().getFullYear();
            var options = "<option selected value='0'>>--Select Year--<</option>";
            for(var year = start ; year <=end; year++){
                options += "<option value='"+year+"'>"+ year +"</option>";
            }
            document.getElementById("yearBills").innerHTML = options;
            $(document).ready(function() {
              document.getElementById('btnConfirmNo').onclick = function() {
                setTimeout(function(){
                  document.getElementById('btnConfirm').style="display: block";
                  document.getElementById('btnConfirm').innerHTML="Yes";
                  document.getElementById('message-confirm').innerHTML="Are you sure you want to delete ?";
                  document.getElementById('message-confirm').style.removeProperty("color");
                  document.getElementById('btnConfirmNo').innerHTML="No";
                }, 500);
            }
                //submit form
                $("#BillFormGroup").submit(function(event) {
                    event.preventDefault(); //prevent default action 
                    var post_url = $(this).attr("action"); //get form action url
                    $.get("../thuan/listBills.php", { status:$("#statusBills").val(), month:$("#monthBills").val(), year:$("#yearBills").val()}, function(data){
                        $("#table-result").html(data);
                    });
                });
                $("#formActionBill").submit(function(event) {
                    event.preventDefault(); //prevent default action 
                    var post_url = $(this).attr("action"); //get form action url
                    $.post("../thuan/billsManager.php", { statusBill:$("#statusBill").val(), idBill:$("#idBill").val(), typeActionBill:$("#typeActionBill").val()}, function(data){
                        $("#action-result").html(data);
                        document.getElementById("btnSubmitBill").click();
                    });
                });
            });
         </script>
         <table class="fixed_header">
            <thead>
               <tr>
                  <th style="width: 40px;">MaHD</th>
                  <th style="width: 40px;">MaKH</th>
                  <th>TinhTrang</th>
                  <th>NGAYXUAT</th>
                  <th>ThanhTien</th>
                  <th>Thao tac</th>
               </tr>
            </thead>
            <tbody id="table-result">
               <?php
                  if(!isset($_GET["status"])){
                      require_once('../utils/connect_db.php');	
                      ['findAllBills' => $Bills] = require '../Entities/bill.php';
                      $data = $Bills($conn);
                      require_once('../utils/close_db.php');
                      
                      for($i=0;$i<count($data);$i++) {
                          $price = intval($data[$i]['ThanhTien']);
                          $price1 =  number_format($price, 0, '', '.');
                          $status = "";
                          if($data[$i]['TinhTrang'] == 0) {
                            $status = "Chua xu ly";
                          } else if($data[$i]['TinhTrang'] == 1){
                            $status = "Da xu ly";
                          } else {
                            $status = "Don hang da giao";
                          }
                          echo "<tr><td style=\"width: 75px;\">".$data[$i]['MaHD']."</td><td style=\"width: 75px;\">".$data[$i]['MaKH']."</td><td>".$status."</td><td>".$data[$i]['NGAYXUAT']."</td><td>".$price1." VND</td><td><button data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"infoBill(".$data[$i]['MaHD'].")\" style=\"margin-left:30px;\" class=\"btn btn-sm btn-info btn-info\" data-toggle=\"tooltip\" title=\"Info\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i></button>
                          <button onclick=\"editBill(".$data[$i]['MaHD'].",".$data[$i]['TinhTrang'].")\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-primary btn-edit\" data-toggle=\"tooltip\" title=\"Update\"><i class=\"fa fa-level-up\" aria-hidden=\"true\"></i></button>
                          <button onclick=\"deleteBill(".$data[$i]['MaHD'].")\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-danger btn-delete\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
                          </td></tr>";
                      }
                      if(count($data) == 0) {
                          echo "<tr style=\"border: 1px solid orange;\"><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td><td style=\"border: 0px; width: 100%;\">Khong co du lieu nao duoc tim thay !</td><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td></tr>";
                      }
                  }
                  ?>
            </tbody>
         </table>
         <!-- Button trigger modal -->
         <div class="container-modal">
            <!-- The Modal -->
            <div class="modal" id="myModal">
               <div class="modal-dialog" style="overflow-y: initial !important; max-width: 1000px;">
                  <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title">Detail Bill</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Modal body -->
                     <div class="modal-body" style="height:60vh; overflow-y: auto;">
                        <div id="action-result">
                        </div>
                     </div>
                     <!-- Modal footer -->
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <button type="button" id="btnpopupConfirm" data-toggle="modal" data-target="#exampleModalCenter" style="visibility: hidden; opacity: 0;"></button>
         <!-- Modal -->
         <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body" id="message-confirm">
                     Are you sure you want to delete ?
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnConfirmNo">No</button>
                     <button type="button" class="btn btn-danger" id="btnConfirm">Yes</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="../js/scripts.js"></script>
   </body>
</html>