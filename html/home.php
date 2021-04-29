<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E COMMERCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
    <script src="../js/jquery.twbsPagination.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
	integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
</head>

<body onload="AccountOn()">
    <div class="container_all" style="width: 100%; position: absolute;">
        <div class="cart" style="width: 100%; height: 100%;" id="cart">
            <a class="closeCart" onclick="closeCart()" style="cursor: pointer;">×</a>
            <h2 style="margin-left:0; font-size: 35px">Your cart <i class="fas fa-shopping-cart"></i></h2>
            <table id="MyCart" class="table table-success table-striped"></table>
            <div class="bottom_right" id="btr"></div>
        </div>
        <div class="order" style="width: 100%; height: 100%; top: -600%;" id="order">
            
            <a class="closeCart" onclick="closeOrder()" style="cursor: pointer;margin-top: -20px; color: black">×</a>
            <h2 style="margin-left: 0%;color: #ff8c00;margin-top: 0%;font-size: 35px;">Your order <i class="fas fa-clipboard-list"></i></h2>
            <!-- <ul id="MyOrder" style="margin-left: 2%; margin-top: 1%; list-style-type: none;"></ul> -->
            <table id="MyOrder" class="table table-success table-striped"></table>
        </div>
        
        <div class="header" id="home">
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                        <a href="home.php">
                            <img src="..\image\logo420.png" width="390px">
                        </a>
                    </div>

                    <form action="" method="GET" id="searchFormGroup">
                        <div class="searchForm" id="search">
                            <input type="text" class="input" placeholder="Search" onkeyup="funcClickBtn()" id="input"
                                name="txtSearch" maxlength="50" autofocus="true">
                            <div class="option" style="margin-top: -4%; height: 0px;">
                                <select id="search_type" onchange="funcClickBtn()" name="priceValue">
                                    <option selected value="">Price</option>
                                    <option value="1">More than 1m</option>
                                    <option value="2">Less than 1m</option>
                                    <option value="">All</option>
                                </select>
                                <select id="product_type" onchange="funcClickBtn()" name="typeId">
                                    <option selected value="">Product type</option>
                                    <?php
				                ['findAllTypes' => $array] = require '../Entities/category.php';
				                require_once('../utils/connect_db.php');
				                $data = $array($conn);
				                for($i=0;$i<count($data);$i++) {
				                    echo "<option value=\"".$data[$i]['MaLo']."\">".$data[$i]['TenLoai']."</option>";
				                }
				            ?>
                                    <option value="">All</option>
                                </select>
                            </div>
                            <div id="search_result" class="small-container">
                            </div>
                            <a class="closebtn" onclick="closeNav()" style="cursor: pointer; color: #FF8C00;">×</a>
                        </div>
                        <input type="submit" name="submit" value="Submit Form" id="btnSubmitSearch"
                            style="visibility: hidden; opacity: 0;" />
                    </form>

                    <script>
                    function funcClickBtn() {
                        document.getElementById("btnSubmitSearch").click();
                    }
                    $(document).ready(function() {
                        document.getElementById("input").disabled = true;
                        document.getElementById("input").focus();
                        //submit form
                        $("#searchFormGroup").submit(function(event) {
                            event.preventDefault(); //prevent default action 
                            var post_url = $(this).attr("action"); //get form action url
                            // var request_method = $(this).attr("method"); //get form GET/POST method
                            // var form_data = $(this).serialize(); //Encode form elements for submission
                            sessionStorage.setItem("inputSearch", $("#input").val());
                            sessionStorage.setItem("search_type", $("#search_type").val());
                            sessionStorage.setItem("product_type", $("#product_type").val());
                            // console.log(form_data);
                            $.get("../thuan/searchsp.php", { txtSearch:$("#input").val(), priceValue:$("#search_type").val(), typeId:$("#product_type").val()}, function(data){
                                $("#search_result").html(data);
                                openNav();
                            });
                        });
                        $.get("../thuan/loadbestprod.php", { }, function(data){
                            $("#load-best-prod").html(data);
                        });

                    });
                    </script>



                    <nav>
                        <ul id="MenuItems">
                            <li><a id="home-page" onclick="home()">HOME</a></li>
                            <li style="width: 114px;">
								<form action="" method="GET" id="formPagination">
									<input type="hidden" name="type" value="all" id="value-pagination">
									<input type="submit" id="btnSubmit-pagination"
                            style="visibility: hidden; opacity: 0;" />
									<a onclick="showProducts()">ALL PRODUCTS</a>
								</form>
							</li>
                            <li><a onclick="showPants()">PANTS</a></li>
                            <li><a onclick="showShirts()">T-SHIRTS</a></li>
                            <li><a title="shopping cart" onclick="openCart()"><i style="width: 80%;"
                                        class="fas fa-shopping-cart"></i></a></li>
                            <li><a title="your order" id="your_order" onclick="yourOrder()"><i
                                        class="fas fa-clipboard-list"></i></a></li>
                            <li><a title="search" onclick="openNav()"><i class="fas fa-search"></i></a></li>
                            <li id="acc"><a title="log in" onclick="open_login_reg_form()"><i
                                        class="fas fa-user"></i></a></li>
                            <li id="logOut" style="display:none;"><a title="log out" id="log_out"
                                    onclick="log()"></a></li>
                        </ul>
                    </nav>
                    <span onclick="menutoggle()" class="menu-icon">&#9776</span>

                </div>

                <div class="row">
                    <div class="col2" id="propagation">
                        <h1>You only live once!</h1>
                        <p>Just stay healthy, keep fit and enjoy this life</p>
                        <a class="btn" onclick="showProducts()">EXPLORE &#10152;</a>
                    </div>

                    <div class="col2">
                        <img src="..\image\endorser.png" id="Endorser">
                    </div>
                </div>
            </div>
            <div class="login-page" id="account">
                <div class="container">
                    <div class="row">
                        <div class="col3">
                            <div class="form-container">
                                <div class="form-btn">
                                    <span onclick="Login()">Log in</span>
                                    <span onclick="Register()">Register</span>
                                    <hr id="indicator">
                                </div>

                                <form id="login">
                                    <input type="text" placeholder="Email" id="user_name">
                                    <input type="password" placeholder="Password" id="password">
                                    <a class="btn" onclick="loginPHP()">Log in</a>
                                    <a onclick="forgotPW()" style="cursor: pointer;">Forgot password |</a>
                                    <a onclick="close_login_reg_form()" style="cursor: pointer;">| Cancel</a>
                                </form>

                                <form id="register">
                                    <input type="text" placeholder="Full name" id="user_name1">
                                    <input type="email" placeholder="Email" id="email">
                                    <input type="password" placeholder="Password" id="password1">
                                    <input type="text" placeholder="Phone number" id="phoneNumber">
                                    <input type="text" placeholder="Address" id="address">
                                    <a class="btn" onclick="registerPHP()">Register</a>
                                    <a onclick="close_login_reg_form()" style="cursor: pointer;">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="small-container" id="bs&na">
            <div id="load-best-prod"></div>
        </div>

        <div class="small-container" id="all_products">
        </div>
        <ul class="pagination" id="pagination" style="margin-top: 100px;"></ul>
        <?php
			if (isset($_GET["type"])) 
            {
                $typePagination = $_GET["type"];
                require_once('../utils/connect_db.php');    
                if($typePagination == "all") {
                        ['countProducts' => $counts] = require '../Entities/product.php';
                        $maxItems = $counts($conn);
                        require_once('../utils/close_db.php');
                        $maxPage = 8;
                        $totalPages = $maxItems/$maxPage;
                        echo "<script type=\"text/javascript\">
                        $(function() {
                                hideHeader();
                                var limit = ".$maxPage."; window.pagObj = $('#pagination').twbsPagination({
                                    totalPages : ".$totalPages.",
                                    visiblePages : 10,
                                    onPageClick : function(event, page) {
                                        var pageEvent = page;
                                        $.get(\"../thuan/phantrangsp.php\", { maxPageItem:limit, page:pageEvent, }, function(data){
                                            $(\"#all_products\").html(data);
                                        });
                                    }
                                }).on('page', function(event, page) {
                                    topFunction();
                                    console.info(page + ' (from event listening)');
                                });
                            });
                    </script>";
                }
                
                else if ($typePagination == "shirts" || $typePagination == "pants") {
                    // echo "check point";
                    $MaLoai = 1;
                    if ($typePagination == "pants") {
                        $MaLoai = 2;
                    }
                    ['countProductsByType' => $counts] = require '../Entities/product.php';
                    $maxItems = $counts($conn,$MaLoai);
                    $maxPage = 8;
                    $totalPages = $maxItems/$maxPage;
                    echo "<script type=\"text/javascript\">
                    $(function() {
                            hideHeader();
                            var limit = ".$maxPage."; window.pagObj = $('#pagination').twbsPagination({
                                totalPages : ".$totalPages.",
                                visiblePages : 10,
                                onPageClick : function(event, page) {
                                    var pageEvent = page;
                                    
                                    $.get(\"../thuan/phantrangsp-type.php\", { maxPageItem:limit, page:pageEvent, typeID: ".$MaLoai."}, function(data){
                                        $(\"#all_products\").html(data);
                                    });
                                }
                            }).on('page', function(event, page) {
                                console.info(page + ' (from event listening)');
                                    
                                topFunction();
                            });
                        });
                </script>";
                }
                require_once('../utils/close_db.php');
            }
		?>
        <section id="banner2" class="banner2">
            <div class="container2">
                <div class="largeee-banner">
                    <img src="..\image/banner.png">
                </div>
                <div class="content-banner2">
                    <p class="dont">DON’T SWEAT GIFTING</p>
                    <p>Order early—for peace of mind, start holiday gift shopping now to avoid shipping delays.</p>
                    <p class="top">SHOP TOP GIFTS</p>
                </div>
            </div>
        </section>
        <div class="website-features">
            <div class="container">
                <div class="row">
                    <div class="col1">
                        <img src="..\image\ft1.png">
                        <div class="feature-text">
                            <p><b>100% Authentic</b></p>
                        </div>
                    </div>

                    <div class="col1">
                        <img src="..\image\ft2.png">
                        <div class="feature-text">
                            <p><b>Return in 30 days</b></p>
                        </div>
                    </div>
                    <div class="col1">
                        <img src="..\image\ft3.png">
                        <div class="feature-text">
                            <p><b>Free shipping fee</b></p>
                        </div>
                    </div>
                    <div class="col1">
                        <img src="..\image\ft4.png">
                        <div class="feature-text">
                            <p><b>Pay online or COD</b></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <button onclick="topFunction()" id="BtnTop" title="Go to top">Top</button>

        <div class="footer">
            <div class="row">
                <div class="col">
                    <h1>
                        Useful link
                    </h1>
                    <p>Privacy policy</p>
                    <p>Terms of use</p>
                    <p>Return policy</p>
                    <p>Discount coupons</p>
                </div>

                <div class="col">
                    <h1>
                        Company
                    </h1>
                    <p>About us</p>
                    <p>Contact</p>
                    <p>Affiliate</p>
                    <p>Enterprise</p>
                </div>

                <div class="col">
                    <h1>
                        Follow us on
                    </h1>
                    <p>Facebook</p>
                    <p>Youtube</p>
                    <p>Instagram</p>
                    <p>Tweeter</p>
                </div>

                <div class="col">
                    <h1>Download app at</h1>
                    <img src="../image/apple.png">
                </div>
            </div>
        </div>
    </div>
    <script src="../js/scripts.js"></script>
    <script src="../login/login.js"></script>
    <script src="../shopping/index.js"></script>
</body>

</html>
