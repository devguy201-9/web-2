<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E COMMERCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
	integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\style.css">
    <script>sessionStorage.setItem("call", "true");</script>
</head>

<body onload="AccountOn()">
    <div class="container_all" style="width: 100%; position: absolute;">
        <div class="cart" style="width: 100%; height: 100%;" id="cart">
            <a class="closeCart" onclick="closeCart()" style="cursor: pointer;">×</a>
            <h2 style="margin-left:0; font-size: 35px">Your cart <i class="fas fa-shopping-cart"></i></h2>
            <table id="MyCart" class="table table-success table-striped"></table>
            <div class="bottom_right" id="btr"></div>
        </div>
        <div class="order" style="width: 100%; height: 100%;" id="order">
            <a class="closeCart" onclick="closeOrder()" style="cursor: pointer;margin-top: -20px; color: black">×</a>
            <h2 style="margin-left: 0%;color: #ff8c00;margin-top: 0%;font-size: 35px;">Your order <i class="fas fa-clipboard-list"></i></h2>
            <!-- <ul id="MyOrder" style="margin-left: 2%; margin-top: 1%; list-style-type: none;"></ul> -->
            <table id="MyOrder" class="table table-success table-striped"></table>
        </div>
        <div class="header" id="home" style="height: 100px">
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                        <a href="index.php">
                            <img src="..\image\logo420.png" width="380px">
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
                            <li><a id="home-page" href="index.php" style="text-decoration: none;">HOME</a>
							</li>
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
                    <div class="col2" id="propagation"></div>
                    <div class="col2" id="Endorser"></div>
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
                                    <input type="text" placeholder="User name" id="user_name">
                                    <input type="password" placeholder="Password" id="password">
                                    <a class="btn" onclick="loginPHP()">Log in</a>
                                    <!-- <a onclick="forgotPW()" style="cursor: pointer;">Forgot password |</a> -->
                                    <a onclick="close_login_reg_form()" style="cursor: pointer;">| Cancel</a>
                                </form>

                                <form id="register">
                                    <input type="text" placeholder="Full name" id="user_name1" pattern="^[a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ ]{2,30}(?: [a-zA-ZàáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ ]+){1,2}$" required="required" autofocus required title="Full name only contains normal character">
                                    <input type="email" placeholder="Email" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required="required" autofocus required title="Email must have character '@', '.', normal ones">
                                    <input type="password" placeholder="Password" id="password1" autofocus required title="Password must have lower, upper character, number, special characters, the length at least 8 chars">
                                    <input type="text" placeholder="Phone number" id="phoneNumber" pattern="(0[1-9])+([0-9]{8})\b" required="required" autofocus required title="Phone number only contains digits">
                                    <input type="text" placeholder="Address" id="address" pattern="^[a-zA-Z0-9/\,àáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ ](?: [a-zA-Z0-9/\,àáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ ]+){1,2}$" required="required">
                                    <a class="btn" onclick="registerPHP()">Register</a>
                                    <a onclick="close_login_reg_form()" style="cursor: pointer;">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="small-container" id="bs&na" style="display: none">
        </div>
        <div class="small-container" id="all_products">
        </div>
            <?php
                if (isset($_GET['idProduct'])) {
                    $idProduct = $_GET['idProduct'];
                    require_once('../utils/connect_db.php');
                    ['findProductById' => $product] = require '../Entities/product.php';
                    $data = $product($conn,$idProduct);
                    $res = '<div class="row2"><div class="col4v2" id="image" style="margin-right: -25%;"><img src="'.$data['Hinh'].'" style="width:140%"></div><div class="col4v2"><div class="info"><div id="productInfo"><h2>'.$data['Ten'].'</h2></div><p id="'.$data['MaSP'].'p">'.$data['GiaBan'].' VND</p></div><b>Description: </b><p> Unisex, comfortable for everyone in all age ranges, <br>make you warm in winter, cool in summer, one of the best sellers in our shop. </p><b>Size : </b><div><select id="size"><option>XS</option><option>S</option><option>M</option><option selected="">L</option><option>XL</option><option>XXL</option></select></div><b>Quantity: </b><div class="quantity"> <button class="quantitydown" onclick="quantitydown()">-</button> <input type="text" id="quantity" value="1"> <button class="quantityup" onclick="quantityup()">+</button></div><div id="atc" class="addToCart" style="cursor: pointer;"><a onclick="addPHP(this.id)" id="'.$data['MaSP'].'">add to cart</a></div></div></div></div>';
                    $result = "<script>document.getElementById('all_products').innerHTML='".$res."'</script>";
                    echo($result);
                }
            ?>

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


        <div class="footer" >
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
