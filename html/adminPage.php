<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style2.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
</style>

<body onload="loadPage()">
    <div class="header2">
        <div id="order_detail">
            <a class="closeDetail2" onclick="closeDetail()"
                style="cursor: pointer;margin-top: -25px;margin-right: -1px;">×</a>
            <ul id="detail"></ul>
        </div>
        <div class="logo">
            <a>
                <img src="..\image\logo420.png" width="300px" id="logo">
            </a>
        </div>
        <div id="admin"></div>
    </div>

    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
    <label for="openSidebarMenu" class="sidebarIconToggle" onclick="openSidebar()">
        <div class="spinner diagonal part-1"></div>
        <div class="spinner horizontal"></div>
        <div class="spinner diagonal part-2"></div>
    </label>
    <div id="sidebarMenu">
        <ul class="sidebarMenuInner">
            <li onclick="showBill()">BILLS</li>
            <li onclick="statisticBestProd()">Hot Selling Products Statistics</li>
            <li onclick="statisticBestProdByType()">Product Statistics By Type</li>
            <li onclick="openDelForm()">MANAGE PRODUCTS</li>
            <li onclick="openManageAccForm()" id="ffa">MANAGE ACCOUNTS</li>
        </ul>
    </div>
	<div id='center' class="main_center">
        <ul id="client_bill"></ul>
    </div>
    <div id="container-data-bill" style="margin-left: 24%;margin-top: 50px;">
        <form action="" method="GET" id="BillFormGroup">
            <select id="statusBills" name="status" class="custom-select mb-3" style="width: 200px;"
                onchange="ClickBtnBill()">
                <option selected value='-2'>>--Select Status--< </option>
                <option value='0'>Has n't been settled</option>
                <option value='1'>Has been settled</option>
                <option value='2'>Has been shipped</option>
            </select>
            <select id="monthBills" name="month" class="custom-select mb-3" style="width: 280px;"
                onchange="ClickBtnBill()">
                <option selected value='0'>>--Select Month--< </option>
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
            <select id="yearBills" name="year" class="custom-select mb-3" style="width: 280px;"
                onchange="ClickBtnBill()">
            </select>
            <button class="btn btn-warning" onclick="funcAllBills()" style="cursor: pointer; margin-left: 20px;margin-top: -1.5%;">All
                Bills</button>
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
        <table class="fixed_header">
            <thead>
                <tr>
                    <th style="width: 40px;">Bill's Code</th>
                    <th style="width: 40px;">Customer's Code</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-result">
                <?php
                  if(!isset($_GET["status"])){
                      require_once('../utils/connect_db.php');	
                      ['findAllBills' => $Bills] = require '../Entities/bill.php';
                      $data = $Bills($conn);                      
                      for($i=0;$i<count($data);$i++) {
                          $price = intval($data[$i]['ThanhTien']);
                          $price1 =  number_format($price, 0, '', '.');
                          $status = "";
                          if($data[$i]['TinhTrang'] == 0) {
                            $status = "Has n't been settled";
                            } else if($data[$i]['TinhTrang'] == 1){
                                $status = "Has been settled";
                            } else {
                                $status = "Has been shipped";
                            }
                          echo "<tr><td style=\"width: 85px;\">".$data[$i]['MaHD']."</td><td style=\"width: 85px;\">".$data[$i]['MaKH']."</td><td>".$status."</td><td>".$data[$i]['NGAYXUAT']."</td><td>".$price1." VND</td><td><button data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"infoBill(".$data[$i]['MaHD'].")\" style=\"margin-left:30px;\" class=\"btn btn-sm btn-info btn-info\" data-toggle=\"tooltip\" title=\"Info\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i></button>
                          <button onclick=\"editBill(".$data[$i]['MaHD'].",".$data[$i]['TinhTrang'].")\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-primary btn-edit\" data-toggle=\"tooltip\" title=\"Update\"><i class=\"fa fa-level-up\" aria-hidden=\"true\"></i></button>
                          <button onclick=\"deleteBill(".$data[$i]['MaHD'].")\" style=\"margin-left:1px;\" class=\"btn btn-sm btn-danger btn-delete\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
                          </td></tr>";
                      }
                      if(count($data) == 0) {
                          echo "<tr style=\"border: 1px solid orange;\"><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td><td style=\"border: 0px; width: 100%;\">No data was found !</td><td style=\"border: 0px;\"></td><td style=\"border: 0px;\"></td></tr>";
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
        <button type="button" id="btnpopupConfirm" data-toggle="modal" data-target="#exampleModalCenter"
            style="visibility: hidden; opacity: 0;"></button>
        <!-- Modal -->
    </div>
	<div id="chart-product">
		<form action="" method="GET" id="ChartFormGroup" style="margin-left: 24%; margin-top: 30px">
            <select id="monthBills2" name="month" class="custom-select mb-3" style="width: 280px;"
                onchange="ClickBtnBill2()">
                <option selected value='0'>>--Select Month--< </option>
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
            <select id="yearBills2" name="year" class="custom-select mb-3" style="width: 280px;"
                onchange="ClickBtnBill2()">
            </select>
            <input type="submit" name="submit" value="Submit-Bill" id="btnSubmitBill2"
                style="visibility: hidden; opacity: 0;" />
        </form>
		<div id="result-chart"></div>
		<div class="row-chart">
			<div class="col-6 chart" id="result-statistic-product">
				<canvas id="myChart2" width="500" height="400"></canvas>
			</div>
		</div>
	</div>

    <div id="container-data-product" style="margin-left: 24%;margin-top: 50px;">
        <form action="" method="GET" id="ProductFormGroup">
            <select id="typeProductBill" name="typeProductBill" class="custom-select mb-3" style="width: 200px;"
                onchange="ClickBtnBill3()">
                <option selected value='0'> >--Product Type--< </option>
                <?php
                    ['findAllTypes' => $array] = require '../Entities/category.php';
                    $data = $array($conn);
                    for($i=0;$i<count($data);$i++) {
                        echo "<option value=\"".$data[$i]['MaLo']."\">".$data[$i]['TenLoai']."</option>";
                    }
                    require_once('../utils/close_db.php');
                ?>
            </select>
            <select id="monthBills3" name="month" class="custom-select mb-3" style="width: 280px;"
                onchange="ClickBtnBill3()">
                <option selected value='0'>>--Select Month--< </option>
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
            <select id="yearBills3" name="year" class="custom-select mb-3" style="width: 280px;"
                onchange="ClickBtnBill3()">
            </select>
            <input type="submit" name="submit" value="Submit-Product" id="btnSubmitBill3"
                style="visibility: hidden; opacity: 0;" />
        </form>
        <table class="fixed_header">
            <thead>
                <tr>
                    <th style="width: 40px;">Product's Code</th>
                    <th style="width: 40px;">Category's Code</th>
                    <th>Product's Name</th>
                    <th>Category's Name</th>
                    <th>Amount</th>
                    <th>Total Transaction Value</th>
                </tr>
            </thead>
            <tbody id="table-result2">
            </tbody>
        </table>
    </div>

	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="btnConfirmNo">No</button>
                        <button type="button" class="btn btn-danger" id="btnConfirm">Yes</button>
                    </div>
                </div>
            </div>
        </div>
	<div class="form-container" id="EditProductForm"></div>
    <div id="deleteProForm">
        <h2 class="title" style="margin-top: -1px">MANAGE PRODUCTS</h2>
        <form action="" method="get" id="formSearchProd">
            <input type="text" class="input" placeholder="Search by product ID" id="inputSearch" name="inputSearch" onkeyup="searchProduct()">
            <a class="closebtn" onclick="closeDelForm()" style="cursor: pointer;">×</a>
            <select id="kind" name="kind" onchange="changeSearchProduct()">
                <option selected value="idProduct">ID</option>
                <option value = "nameProduct">Name</option>
            </select>
            <a class="addProduct" onclick="openForm()">ADD PRODUCT</a>
            <input type="submit" name="submit" value="Submit Form" id="submitSearchProd"
                            style="visibility: hidden; opacity: 0;" />
        </form>
        <div class="form-container" id="addProductForm">
            <a class="closeDetail2" onclick="closeDetail()" style="cursor: pointer;color: #ff8c00;">×</a>
            <form action="" method="POST" id="formAddOrUpdateProduct">
                <h2 id="title-AddOrUp">UPDATE PRODUCT</h2>
                <input type="text" class="inputForm" placeholder="Product name" id="product-name" name="product-name" required>
                <input type="number" min="1" class="inputForm" placeholder="Price" id="product-price" name="product-price" required>
                <input type="number" min="1" class="inputForm" placeholder="Quantity in stock" id="quantity-in-stock" name="quantity-in-stock" required>
                <select class="inputForm" id="updateType" name="updateType">
                </select>
                <p style="margin-top: -4px; margin-bottom: -4px">Product image:</p>
                <input type="file" class="inputForm" placeholder="Image" id="product-image" name="product-image" required accept="image/*">
                <button class="btn2" id="btnAddOrUpdate" onclick="() => {document.getElementById('btnAddOrUpdateProduct').click();}" style="width: 64%;margin-left: 5%;">Update</button>
                <input type="hidden" name="idAddOrUpdateProd" id="idAddOrUpdateProd">
                <input type="submit" name="submitProduct" value="Submit-Product" id="btnAddOrUpdateProduct" style="visibility: hidden; opacity: 0;" />
            </form>
        </div>
        <div id="search_result" class="small_container"></div>
        <form action="" method="POST" id="formActionProduct">
            <input type="hidden" name="idProd" value="" id="idProd">
            <input type="hidden" name="typeActionProd" value="" id="typeActionProd">
            <input type="submit" name="submit" value="Submit-Bill" id="btnActionProd"
                style="visibility: hidden; opacity: 0;" />
        </form>
    </div>
    <div id="manageAccount">
        <h2 class="title" style="margin-top: -1px">MANAGE ACCOUNTS</h2>

        <form action="" method="get" id="searchCMM">
            <input type="text" class="input" placeholder="Search account" id="input2" onkeyup="search2()"
            style="margin-bottom: 10px">
            <a class="closebtn" onclick="closeDelForm()" style="cursor: pointer;">×</a>
            <a class="addAcc" onclick="openForm2()">ADD ACCOUNT </a>
            <input type="submit" name="submit" value="Submit Form" id="submitSearchUser"
                            style="visibility: hidden; opacity: 0;" />
        </form>

        
        <div id="search_result1" class="small_container"></div>

        <div id="addAccount" class="form-container" style="height: 480px">
            <form id="register">
                <a class="closeDetail2" onclick="closeAddForm()" style="cursor: pointer;">×</a>
                <h2 id="formName"></h2>
                <input type="text" placeholder="User name" id="user_name1">
                <input type="email" placeholder="Email" id="email">
                <input type="password" placeholder="Password" id="password1">
                <input type="text" placeholder="Address" id="address">
                <select id="priority">
                    <option value="1">Manager</option>
                    <option value="2">Saleman</option>
                </select>
                <select id="status">
                    <option value="1">Normal</option>
                    <option value="0">Blocked</option>
                </select>
                <a class="btn3" onclick="addNV()" style="display: none; margin-left: 18%; width: 64%"
                    id="add">ADD</a>
                <a class="btn3" onclick="editUser()" style="display: none; margin-left: 18%; width: 64%"
                    id="save">SAVE</a>
                <a onclick="closeAddForm()" style="cursor: pointer;">Cancel</a>
            </form>
        </div>
    </div>
    <script src="../js/scripts.js"></script>
    <script src="../login/loginAdmin.js"></script>
    <script src="../js/script.js"></script>
    <script src="../edit/index.js"></script>
	<script>
        $(document).ready(function() {
            document.getElementById('btnConfirmNo').onclick = function() {
                setTimeout(function() {
                    document.getElementById('btnConfirm').style = "display: block";
                    document.getElementById('btnConfirm').innerHTML = "Yes";
                    document.getElementById('message-confirm').innerHTML =
                        "Are you sure you want to delete ?";
                    document.getElementById('message-confirm').style.removeProperty("color");
                    document.getElementById('btnConfirmNo').innerHTML = "No";
                }, 500);
            }
            //submit form
            $("#BillFormGroup").submit(function(event) {
                event.preventDefault(); //prevent default action 
                var post_url = $(this).attr("action"); //get form action url
                $.get("../thuan/listBills.php", {
                    status: $("#statusBills").val(),
                    month: $("#monthBills").val(),
                    year: $("#yearBills").val()
                }, function(data) {
                    $("#table-result").html(data);
                });
            });
            $("#formActionBill").submit(function(event) {
                event.preventDefault(); //prevent default action 
                var post_url = $(this).attr("action"); //get form action url
                $.post("../thuan/billsManager.php", {
                    statusBill: $("#statusBill").val(),
                    idBill: $("#idBill").val(),
                    typeActionBill: $("#typeActionBill").val()
                }, function(data) {
                    $("#action-result").html(data);
                    document.getElementById("btnSubmitBill").click();
                });
            });

			$("#ChartFormGroup").submit(function(event) {
				event.preventDefault(); //prevent default action 
				var post_url = $(this).attr("action"); //get form action url
				$.get("../thuan/statisticBestProd.php", {
					typeProducts: 0,
					month: $("#monthBills2").val(),
					year: $("#yearBills2").val()
				}, function(data) {
					$("#result-chart").html(data);
                    delete labels2;
                    delete data2;
                    delete colors2;
                    delete myChart2;
                    delete chart2;
				});
			});

            $("#ProductFormGroup").submit(function(event) {
                event.preventDefault(); //prevent default action 
                var post_url = $(this).attr("action"); //get form action url
                $.get("../thuan/statisticBestProdByType.php", {
                    typeProductBill: $("#typeProductBill").val(),
                    month: $("#monthBills3").val(),
                    year: $("#yearBills3").val()
                }, function(data) {
                    $("#table-result2").html(data);
                });
            });

            $("#formSearchProd").submit(function(event) {
                event.preventDefault(); //prevent default action 
                $.get("../thuan/searchProductAdmin.php", { kind:$("#kind").val(), inputSearch:$("#inputSearch").val()}, function(data){
                    $("#search_result").html(data);
                });
            });

            $("#searchCMM").submit(function(event) {
                event.preventDefault(); //prevent default action 
                $.get("../thuan/loadUser.php", {inputSearch:$("#input2").val()}, function(data){
                    $("#search_result1").html(data);
                });
            });

            $("#formActionProduct").submit(function(event) {
                event.preventDefault(); //prevent default action 
                $.post("../thuan/productsManager.php", {
                    typeActionProd: $("#typeActionProd").val(),
                    idProd: $("#idProd").val(),
                }, function(data) {
                    $("#action-result").html(data);
                });
            });

            $("#formAddOrUpdateProduct").submit(function(event) {
                event.preventDefault(); //prevent default action 
                $.post("../thuan/productsManager.php", {
                    idAddOrUpdateProd: $("#idAddOrUpdateProd").val(),
                    productName: $("#product-name").val(),
                    productPrice: $("#product-price").val(),
                    quantityInStock: $("#quantity-in-stock").val(),
                    updateType: $("#updateType").val(),
                    // productImage: $("#product-image").val(),
                }, function(data) {
                    $("#action-result").html(data);
                    searchProduct();
                });
            });

        });
        </script>
</body>
</html>