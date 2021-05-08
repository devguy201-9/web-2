var user_info = [{name: "Noobmaster", password: "123456789", state: 0, phoneNumber: "0901407894", address: "Hochiminh", email: "nguyenlehuythang@gmail.com", isBlocked: 0, resetPW: 0}];
var admins = ["Noobmaster"];
var num_of_cus = 1;
var c = 0;
var page = [];
var pant_page = [];
var shirt_page = [];
var num_shirt;
var num_pant;
var num;
var mybutton = document.getElementById("BtnTop");
window.onscroll = function() {scrollFunction()};
	
function scrollFunction() 
{
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
	{
		mybutton.style.display = "block";
	} 
	else 
	{
		mybutton.style.display = "none";
	}
}

function topFunction() 
{
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
}

var MenuItems = document.getElementById("MenuItems");
MenuItems.style.maxHeight = "0px";

function menutoggle()
{
	if  (MenuItems.style.maxHeight == "0px")
	{
		MenuItems.style.maxHeight = "430px";
	}

	else
	{
		MenuItems.style.maxHeight = "0px";
	}
}

function AccountOn()
{
	if (sessionStorage.getItem("call") !== null) {
		let call = sessionStorage.getItem("call");
		if (call == "true") {
			sessionStorage.setItem("call", "false");
			menutoggle();
			document.getElementById("home").style.height = "100px";
			document.getElementById("account").style.display = "none"; 
			document.getElementById("Endorser").style.display = "none";
			document.getElementById("propagation").style.display = "none";
			document.getElementById("bs&na").style.display = "none";
			document.getElementById("all_products").style.display = "block";
		} else if(call == "false") {
			const queryString = window.location.search;
			if (queryString != '') {
				var onlyUrl = window.location.href.replace(window.location.search,'');
				window.location.href=onlyUrl;
			}
		}
	}
	// localStorage.clear();
	if (localStorage['user_info'] == null)
	{
		localStorage.setItem('user_info', JSON.stringify(user_info));
	}

	if (localStorage['admins'] == null)
	{
		localStorage.setItem('admins', JSON.stringify(admins));
	}

	if (localStorage['product_info'] == null)
	{
		var products = [
		{name: "Essentials Pants", img: "../image/product_44.jpg", price: 640000, id: "p42", quantity: 100},
		{name: "Tiro 19 Training Pants", img: "../image/product_45.jpg", price: 800000, id: "p43", quantity: 100},
		{name: "3-Stripes Pants", img: "../image/product_46.jpg", price: 900000, id: "p44", quantity: 100},
		{name: "Arsenal Third Jersey", img: "../image/product_14.jpg", price: 1800000, id: "s14", quantity: 100},
		{name: "Chile 20 Tee", img: "../image/product_15.jpg", price: 900000, id: "s15", quantity: 100},
		{name: "3D Trefoil Graphic Tee", img: "../image/product_16.jpg", price: 600000, id: "s16", quantity: 100},
		{name: "Trefoil Tee", img: "../image/product_17.jpg", price: 600000, id: "s17", quantity: 100},
		{name: "Pride Trefoil Flag Fill Tee", img: "../image/product_32.jpg", price: 600000, id: "s30", quantity: 100},
		{name: "Big Badge of Sport Boxy Tee", img: "../image/product_33.jpg", price: 600000, id: "s31", quantity: 100},
		{name: "Lil Stripe Splash Tee", img: "../image/product_34.jpg", price: 500000, id: "s32", quantity: 100},
		{name: "Adiprene Tee", img: "../image/product_35.jpg", price: 700000, id: "s33", quantity: 100},
		{name: "Juventus 20/21 Third Jersey", img: "../image/product_36.jpg", price: 1800000, id: "s34", quantity: 100},
		{name: "adidas Z.N.E. Pants", img: "../image/product_47.jpg", price: 640000, id: "p45", quantity: 100},
		{name: "Tiro 19 Training Pants", img: "../image/product_48.jpg", price: 800000, id: "p46", quantity: 100},
		{name: "Aeroready Knit Pants", img: "../image/product_55.jpg", price: 860000, id: "p53", quantity: 100},
		{name: "Outline Sweat Pants", img: "../image/product_56.jpg", price: 1240000, id: "p54", quantity: 100},
		{name: "3-Stripes Pants", img: "../image/product_57.jpg", price: 780000, id: "p55", quantity: 100},
		{name: "3-Stripes Tee", img: "../image/product_18.jpg", price: 700000, id: "s18", quantity: 100},
		{name: "Adiprene Tee", img: "../image/product_19.jpg", price: 560000, id: "s19", quantity: 100},
		{name: "Chile 20 Tee", img: "../image/product_20.jpg", price: 800000, id: "s20", quantity: 100},
		{name: "M.U Long Sleeve Tee", img: "../image/product_21.jpg", price: 1400000, id: "s21", quantity: 100},
		{name: "Tiro 19 Training Pants", img: "../image/product_58.jpg", price: 1100000, id: "p56", quantity: 100},
		{name: "Essentials Wind Pants", img: "../image/product_59.jpg", price: 1200000, id: "p57", quantity: 100},
		{name: "Tiro 19 Training Pants", img: "../image/product_60.jpg", price: 1200000, id: "p58", quantity: 100},
		{name: "French Terry Pants", img: "../image/product_61.jpg", price: 1600000, id: "p59", quantity: 100},
		{name: "Alphaskin 2.0 Sport Tights", img: "../image/product_62.jpg", price: 1120000, id: "p60", quantity: 100},
		{name: "Firebird Track Pants", img: "../image/product_63.jpg", price: 1400000, id: "p61", quantity: 100},
		{name: "Essentials Fleece Jogger Pants", img: "../image/product_64.jpg", price: 640000, id: "p62", quantity: 100},
		{name: "Adicolor SST Track Pants", img: "../image/product_65.jpg", price: 800000, id: "p63", quantity: 100},
		{name: "Must Haves Primeblue Pants", img: "../image/product_66.jpg", price: 900000, id: "p64", quantity: 100},
		{name: "Classics Track Pants", img: "../image/product_67.jpg", price: 640000, id: "p65", quantity: 100},
		{name: "ID Pants", img: "../image/product_68.jpg", price: 900000, id: "p66", quantity: 100},
		{name: "Cross Up 365 Pants", img: "../image/product_69.jpg", price: 900000, id: "p67", quantity: 100},
		{name: "Bouclette Pants", img: "../image/product_70.jpg", price: 1000000, id: "p68", quantity: 100},
		{name: "Own the Run Astro Pants", img: "../image/product_71.jpg", price: 640000, id: "p69", quantity: 100},
		{name: "R.Y.V. Sweat Pants", img: "../image/product_72.jpg", price: 900000, id: "p70", quantity: 100},
		{name: "O Shape Pants", img: "../image/product_73.jpg", price: 1120000, id: "p71", quantity: 100},
		{name: "Must Haves Stadium Pants", img: "../image/product_74.jpg", price: 1400000, id: "p72", quantity: 100},
		{name: "3-Stripes Pants", img: "../image/product_75.jpg", price: 900000, id: "p73", quantity: 100},
		{name: "Essentials Tapered Pants", img: "../image/product_76.jpg", price: 1300000, id: "p74", quantity: 100},
		{name: "Brilliant Basics Pants", img: "../image/product_77.jpg", price: 840000, id: "p75", quantity: 100},
		{name: "adidas Z.N.E. Woven Pants", img: "../image/product_78.jpg", price: 1200000, id: "p76", quantity: 100},
		{name: "3-Stripes Tapered Pants", img: "../image/product_79.jpg", price: 1120000, id: "p77", quantity: 100},
		{name: "Camouflage Pants", img: "../image/product_80.jpg", price: 1400000, id: "p78", quantity: 100},
		{name: "Essentials Colorblock Pants", img: "../image/product_81.jpg", price: 840000, id: "p79", quantity: 100},
		{name: "Adventure Track Pants", img: "../image/product_82.jpg", price: 1200000, id: "p80", quantity: 100},
		{name: "Essentials 3-StripesPants", img: "../image/product_83.jpg", price: 1200000, id: "p81", quantity: 100},
		{name: "Adi Primeblue Track Pants", img: "../image/product_84.jpg", price: 1600000, id: "p82", quantity: 100},
		{name: "Tiro 19 Training Pants", img: "../image/product_85.jpg", price: 840000, id: "p83", quantity: 100},
		{name: "3D Trefoil Graphic Sweat Pants", img: "../image/product_86.jpg", price: 1200000, id: "p84", quantity: 100},
		{name: "Trefoil Tee", img: "../image/product_0.jpg", price: 600000, id: "s1", quantity: 100},
		{name: "Short Sleeve Shmoo Tee", img: "../image/product_1.jpg", price: 700000, id: "s2", quantity: 100},
		{name: "Must Haves Stadium Tee", img: "../image/product_2.jpg", price: 560000, id: "s3", quantity: 100},
		{name: "Run It 3-Stripes PB Tee", img: "../image/product_3.jpg", price: 700000, id: "s4", quantity: 100},
		{name: "Own Long Sleeve Tee", img: "../image/product_4.jpg", price: 700000, id: "s5", quantity: 100},
		{name: "Own the Run Tee", img: "../image/product_5.jpg", price: 700000, id: "s6" , quantity: 100},
		{name: "3-Stripes Tee", img: "../image/product_6.jpg", price: 700000, id: "s7", quantity: 100},
		{name: "Chile 20 Tee", img: "../image/product_7.jpg", price: 800000, id: "s8", quantity: 100},
		{name: "Trefoil Tee", img: "../image/product_8.jpg", price: 600000, id: "s9", quantity: 100},
		{name: "Real Madrid Third Jersey", img: "../image/product_9.jpg", price: 1800000, id: "s10", quantity: 100},
		{name: "25/7 Primeblue Tee", img: "../image/product_10.jpg", price: 900000, id: "s11", quantity: 100},
		{name: "3-Stripes Tee", img: "../image/product_11.jpg", price: 800000, id: "s12", quantity: 100},
		{name: "NY Pigeon Tee", img: "../image/product_12.jpg", price: 600000, id: "s13", quantity: 100},
		{name: "R.Y.V. Graphic Tee", img: "../image/product_22.jpg", price: 800000, id: "s22", quantity: 100},
		{name: "New Stacked LA Trefoil Tee", img: "../image/product_23.jpg", price: 600000, id: "s23", quantity: 100},
		{name: "M.U Third Jersey", img: "../image/product_24.jpg", price: 1800000, id: "s24", quantity: 100},
		{name: "Badge of Sport Tee", img: "../image/product_26.jpg", price: 500000, id: "s25", quantity: 100},
		{name: "Own the Run Tee", img: "../image/product_27.jpg", price: 700000, id: "s26", quantity: 100},
		{name: "TAN Logo Tee", img: "../image/product_29.jpg", price: 800000, id: "s27", quantity: 100},
		{name: "Torsion Tee", img: "../image/product_30.jpg", price: 700000, id: "s28", quantity: 100},
		{name: "Big Trefoil Outline Tee", img: "../image/product_31.jpg", price: 600000, id: "s29", quantity: 100},
		{name: "Real Madrid DNA Graphic Tee", img: "../image/product_37.jpg", price: 500000, id: "s35", quantity: 100},
		{name: "Captain Tsubasa Tee", img: "../image/product_38.jpg", price: 800000, id: "s36", quantity: 100},
		{name: "USA Volleyball 1/4 Zip Tee", img: "../image/product_39.jpg", price: 1100000, id: "s37", quantity: 100},
		{name: "Unity Tee", img: "../image/product_40.jpg", price: 800000, id: "s38", quantity: 100},
		{name: "R.Y.V. Tee", img: "../image/product_41.jpg", price: 600000, id: "s39", quantity: 100},
		{name: "Badge of Sport Tee", img: "../image/product_42.jpg", price: 600000, id: "s40", quantity: 100},
		{name: "New Stacked Trefoil Tee", img: "../image/product_43.jpg", price: 600000, id: "s41", quantity: 100},
		{name: "Essentials 3-Stripes Wind Pants", img: "../image/product_49.jpg", price: 1200000, id: "p47", quantity: 100},
		{name: "Sport French Terry Pants", img: "../image/product_50.jpg", price: 1700000, id: "p48", quantity: 100},
		{name: "Woven Tape Pants", img: "../image/product_51.jpg", price: 900000, id: "p49", quantity: 100},
		{name: "Trefoil Essentials Pants", img: "../image/product_52.jpg", price: 640000, id: "p50", quantity: 100},
		{name: "3-Stripes Pants", img: "../image/product_53.jpg", price: 900000, id: "p51", quantity: 100},
		{name: "Run It 3-Stripes Astro Pants", img: "../image/product_54.jpg", price: 1000000, id: "p52", quantity: 100}
		];
		localStorage.setItem('product_info', JSON.stringify(products));
	}

	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < stored_accounts.length; i++)
		if (stored_accounts[i].state == 1)
		{
			if (checkAdmin(stored_accounts[i].name) == 1)
				document.getElementById("admin").style.display = "inline-block";
			else 
				document.getElementById("admin").style.display = "none";
			document.getElementById("acc").innerHTML = '<a id="userName">' + stored_accounts[i].name + '</a>';
			document.getElementById("logOut").style.display = "inline-block";
			document.getElementById("log_out").innerHTML = '<i class="fas fa-sign-out-alt"></i>';
			break;
		}

	// var temp = "";
	// for (var i = 0; i < 4; i++)
	// 	temp += '<div class="col-4"' + 'id="' + product_info[i].id + '">' + '<img src="' + product_info[i].img+ '"><h4>' + product_info[i].name + '</h4><div class="rating"><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span></div><p>' + product_info[i].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="DetailBtn"' + 'id="' + product_info[i].id + '" onclick="showProductDetail(this.id)">Details</button>' + '</div>';
	// document.getElementById("bestSeller").innerHTML = temp;
	// console.log("best" + temp);

	// temp = "";
	// for (var i = product_info.length - 1; i >= product_info.length - 4; i--)
	// 	temp += '<div class="col4"' + 'id="' + product_info[i].id + '">' + '<img src="' + product_info[i].img+ '"><h4>' + product_info[i].name + '</h4><div class="rating"><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span></div><p>' + product_info[i].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="DetailBtn"' + 'id="' + product_info[i].id + '" onclick="showProductDetail(this.id)">Details</button>' + '</div>';
	// document.getElementById("bestSeller").innerHTML = temp;
	// console.log("best" + temp);

	// temp = "";
	// for (var i = product_info.length - 1; i >= product_info.length - 4; i--)
	// 	temp += '<div class="col4"' + 'id="' + product_info[i].id + '">' + '<img src="' + product_info[i].img+ '"><h4>' + product_info[i].name + '</h4><div class="rating"><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span></div><p>' + product_info[i].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="DetailBtn"' + 'id="' + product_info[i].id + '" onclick="showProductDetail(this.id)">Details</button>' + '</div>';

	// document.getElementById("newArrival").innerHTML = temp;
	var c1 = 0;
	var temp = '';
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	// console.log(product_info);
	if (product_info.length%12 != 0)
		num = float2int(product_info.length/12) + 1;
	else 
		num = product_info.length/12;
	var flag = 1;
	for (var i = 0; i < num; i++)
	{
		var products = "";
		for (var j = i*12; j < i*12 + 12; j++)
		{

			temp += '<div class="col4"' + 'id="' + product_info[j].id + '">' + '<img src="' + product_info[j].img+ '"><h4>' + product_info[j].name + '</h4><div class="rating"><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span></div><p>' + product_info[j].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="DetailBtn"' + 'id="' + product_info[j].id + '" onclick="showProductDetail(this.id)">Details</button>' + '</div>';
			c1 += 1;
			if (c1 == 4 || j == product_info.length - 1)
			{
				temp = '<div class="row2">' + temp + '</div>';
				products += temp;
				temp = "";
				c1 = 0;
				if (j == product_info.length - 1)
					flag = 0;
			}
			if (flag == 0)
				break;
		}
		page.push('<h2 class="title">All products' + '/page ' + parseInt(i + 1) + '</h2>' + products);
		if (flag == 0)
			break;
	}
	// var pant = [];
	// for (var i =  product_info.length - 1; i >= 0; i--)
	// 	if (product_info[i].id.indexOf('p') != -1) pant.push(i);

	// num_pant = getNum(pant);
	// createPage(num_pant, pant, pant_page, 'Pants');

	// var shirt = [];
	// for (var i =  product_info.length - 1; i >= 0; i--)
	// 	if (product_info[i].id.indexOf('s') != -1) shirt.push(i);

	// num_shirt = getNum(shirt);
	// createPage(num_shirt, shirt, shirt_page, 'T-shirts');
}

var login = document.getElementById("login");
var register = document.getElementById("register");
var indicator = document.getElementById("indicator");
var form = document.getElementsByClassName("form-container");

function Register()
{
	register.style.transform = "translate(0px)";
	login.style.transform = "translate(0px)";
	indicator.style.transform = "translate(110px)";
	form[0].style.height = "450px";
}

function Login()
{
	register.style.transform = "translate(298px)";
	login.style.transform = "translate(298px)";
	indicator.style.transform = "translate(0px)";
	form[0].style.height = "300px";
}

function open_login_reg_form()
{
	// menutoggle();
	document.getElementById("Endorser").style.display = "none";
	document.getElementById("account").style.display = "block";
	document.getElementById("propagation").style.display = "none";
	// document.getElementById("pagination").style.display = "none";
	// document.getElementById('product_detail').style.top = "-300%";
	var x = document.getElementById("home");
	{
		document.getElementById("home").style.height = "680px";
	}
}

var current_height = 0;

function close_login_reg_form()
{
	document.getElementById("account").style.display = "none";
	var x = document.getElementById("home");
	console.log(x.offsetHeight, "\t", document.getElementById('bs&na').style.display);
	if (x.offsetHeight == 680 && document.getElementById('bs&na').style.display != 'none')
	{
		document.getElementById("home").style.height = "760px";
		document.getElementById("Endorser").style.display = "block";
		document.getElementById("propagation").style.display = "block";
	}
	else
	{
		console.log("100px");
		document.getElementById("home").style.height = "100px";
	}
}

function close_login_reg_form2()
{
	document.getElementById("account").style.display = "none";
	document.getElementById("home").style.height = "760px";
	document.getElementById("Endorser").style.display = "block";
	document.getElementById("propagation").style.display = "block";
}


function getInfo()
{
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	var user_name = document.getElementById("user_name").value;
	var password = document.getElementById("password").value;
	var flag = 0;
	for (var i = 0; i < stored_accounts.length; i++)
	{
		if (user_name == stored_accounts[i].name && password == stored_accounts[i].password)
		{
			flag = 1;
			stored_accounts[i].state = 1;
			break;
		}
	}
	if (flag == 0)
	{
		alert("Wrong login information");
	}
	else
	{
		localStorage.setItem('user_info', JSON.stringify(stored_accounts));
		document.getElementById("acc").innerHTML = '<a id="userName">' + user_name + '</a>';
		if (checkAdmin(user_name))
			document.getElementById("admin").style.display = "inline-block";
		document.getElementById("logOut").style.display = "inline-block";
		document.getElementById("log_out").innerHTML = '<i class="fas fa-sign-out-alt"></i>';
		document.getElementById("user_name").value = null;
		document.getElementById("password").value = null;
		close_login_reg_form();
	}
}

function getInfo1()
{
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	var password = document.getElementById("password1").value;
	var password1 = document.getElementById("password2").value;
	var flag = 1;
	for (var i = 0; i < stored_accounts.length; i++)
		if (document.getElementById("user_name1").value == stored_accounts[i].name)
		{
			alert("This user name has been used.");
			flag = 0;
		}
	if (password == password1 && flag != 0)
	{
		var userName = document.getElementById("user_name1").value;
		var phoneNumber = document.getElementById("phoneNumber").value;
		var address1 = document.getElementById("address").value;
		var email1 = document.getElementById("email").value;
		if ( userName === "" || phoneNumber === "" || address1 === "" || email1 === "")
		{
			alert("You have not insert enough information!!!");
		}
		else
		{
			stored_accounts.push({name: userName, password: password1.toString(), state: 1, phoneNumber: phoneNumber.toString(), address: address1, email: email1, isBlocked: 0, resetPW: 0});
			localStorage.setItem('user_info', JSON.stringify(stored_accounts));
			close_login_reg_form();
			document.getElementById("acc").innerHTML = '<a id="userName">' + document.getElementById("user_name1").value + '</a>';
			document.getElementById("log_out").innerHTML = '<i class="fas fa-sign-out-alt"></i>';
			document.getElementById("logOut").style.display = "inline-block";
			close_login_reg_form();
			document.getElementById("password1").value = null;
			document.getElementById("password2").value = null;
			document.getElementById("user_name1").value = null;
			document.getElementById("email").value = null;
			document.getElementById("phoneNumber").value = null;
			document.getElementById("address").value = null;
		}
	}
}

function logout()
{
	menutoggle();
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	var userName = document.getElementById('userName').text;
	for (var i = 0; i < stored_accounts.length; i++)
		if (stored_accounts[i].name == userName)
		{
			stored_accounts[i].state = 0;
			break;
		}
	localStorage.setItem('user_info', JSON.stringify(stored_accounts));
	document.getElementById("acc").innerHTML = 	'<a href="#" title = "log in" onclick = "open_login_reg_form()"><i" class="fas fa-user"></i></a>';
	document.getElementById("log_out").innerHTML = " ";
	document.getElementById("admin").style.display = "none";
	document.getElementById("logOut").style.display = "none";
}

function float2int (value) 
{
    return value | 0;
}

function display(a)
{
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	if (a.length == 1)
	{
		var temp = '<div class = "col4"' + 'id="' + product_info[a[0]].id + '">' + '<img src="' + product_info[a[0]].img + '">' + '<h4>' + product_info[a[0]].name +'</h4>' + '<div class="rating"><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span></div>' + '<p>' + product_info[a[0]].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="DetailBtn"' + 'id="' + product_info[a[0]].id + '" onclick="showProductDetail(this.id)">Details</button>' + '</div>';
		temp = '<div class ="row2">' + temp + '</div>';
		document.getElementById("search_result").innerHTML = temp;
	}
	else 
	{
		var search_result = '';
		var temp = '';
		var count = 0;
		for (var i = 0; i < a.length; i++)
		{
			// console.log("run +" + temp);
			count += 1;
			temp += '<div class = "col4"' + 'id="' + product_info[a[i]].id + '">' + '<img src="' + product_info[a[i]].img + '">' + '<h4>' + product_info[a[i]].name +'</h4>' + '<div class="rating"><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span></div>' + '<p>' + product_info[a[i]].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="DetailBtn"' + 'id="' + product_info[a[i]].id + '" onclick="showProductDetail(this.id)">Details</button>' + '</div>';

			if (count == 4 || i == a.length - 1)
			{
				temp = '<div class ="row2">' + temp + '</div>';
				search_result += temp;
				temp = '';
				count = 0;
			}
		}
		document.getElementById("search_result").innerHTML = search_result;
	}
}

var pre_height = "";
var price = "";
var type = "";
function search()
{
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	var input = document.getElementById("input").value;
	console.log("input: " + input);
	if (input === "")
	{
		document.getElementById("search_result").style.display = "none";
	}
	else 
	{
		var sel = document.getElementById("search_type");
		price = sel.options[sel.selectedIndex].text;
		if (price == 'less than 1m')
			console.log("dung");
		console.log("price: " + price);
		var sel1 = document.getElementById("product_type");
		type = sel1.options[sel1.selectedIndex].text;
		document.getElementById("search_result").style.display = "block";
		var a = [];
		if (price == 'Price')
			price = 'All';
		if (type == 'Product type')
			type = 'All';
		for (var i = 0; i < product_info.length; i++)
		{
			if (product_info[i].name.toLowerCase().indexOf(input.toLowerCase()) != -1)
			{
				a.push(i);
			}
		}
		
		if (type == 'All' && price == 'All')
		{
			display(a);
		}
		else 
		{
			if (price == 'more than 1m')
				for (var i = 0; i < a.length; i++)
					if (product_info[a[i]].price < 1000000)
					{
						a.splice(i, 1);
						i--;
					}
			if (price == 'less than 1m')
				for (var i = 0; i < a.length; i++)
				{
					if (product_info[a[i]].price > 1000000)
					{
						a.splice(i, 1);
						i--;
					}
				}
			
			if (type == 'All')
			{
				display(a);
				return true;
			}
			else if (type == 'T-shirt')
			{
				for (var i = 0; i < a.length; i++)
					if (product_info[a[i]].id.indexOf('s') == -1)
					{
						a.splice(i, 1);
						i--;
					}
				display(a);
			}
			else
			{
				for (var i = 0; i < a.length; i++)
					if (product_info[a[i]].id.indexOf('p') == -1)
					{
						a.splice(i, 1);
						i--;
					}
				display(a);
			}
		}
	}
}


function changeSearchType()
{
	var sel = document.getElementById("search_type");
	var text = sel.options[sel.selectedIndex].text;
	if (price != text)
	{
		search();
	}

}

function changeProductType()
{
	var sel1 = document.getElementById("product_type");
	var text1 = sel1.options[sel1.selectedIndex].text;
	if (type != text1)
	{
		search();
	}
}

function home()
{
	document.getElementById("pagination").style.display = "none";
	document.getElementById("account").style.display = "none";
	document.getElementById("Endorser").style.display = "block";
	document.getElementById("propagation").style.display = "block";
	document.getElementById("bs&na").style.display = "block";
	document.getElementById("home").style.height = "760px";
	document.getElementById("all_products").style.display = "none";
	AccountOn();
}

function showPagination(){
	sessionStorage.setItem("call", "true");
	document.getElementById("btnSubmit-pagination").click();
}

function showPants() {
	document.getElementById("value-pagination").value = "pants";
	showPagination();
}

function showShirts(){ 
	document.getElementById("value-pagination").value = "shirts";
	showPagination();
}
function showProducts(){
	console.log("showProducts");
	showPagination();
}

function openNav()
{
	document.getElementById("input").disabled = false;
	document.getElementById("search").style.width = "100%";
	//get data from sessionStorage to set value for form
	if (sessionStorage.getItem("inputSearch") != "") {
		$("#input").val(sessionStorage.getItem("inputSearch"));
		$("#search_type").val(sessionStorage.getItem("search_type"));
		$("#product_type").val(sessionStorage.getItem("product_type"));
	}
}

function closeNav() 
{
	console.log("xoa sess");
	sessionStorage.removeItem('inputSearch');
	sessionStorage.removeItem('search_type');
	sessionStorage.removeItem('product_type');
	document.getElementById("search").style.width = "0%";
	document.getElementById("input").disabled = true;
}

function quantitydown()
{
	if(document.getElementById('quantity').value > 1)
	   	document.getElementById('quantity').value--;
}

function quantityup()
{
	document.getElementById('quantity').value++;
}

function showProductDetail(id)
{
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	var res = -1;
	for (var i = 0; i < product_info.length; i++)
	{
		if (product_info[i].id == id)
		{
			res = i;
			break;
		}
	}

	if (res != -1)
	{
		var temp1 = '<img src="' + product_info[res].img + '">';
		var temp2 = '<h2>' + product_info[res].name + '</h2><div class="rating"><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span><span>&#9733</span></div><p>' + product_info[res].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>';
		document.getElementById('image').innerHTML = temp1;
		document.getElementById('productInfo').innerHTML = temp2;
		document.getElementById('product_detail').style.top = "10%";
		document.getElementById("atc").innerHTML = '<a onclick="addToCart(this.id)"' + 'id="' + id  + '">' + 'add to cart</a>';
	}
}

function closeDetail()
{
	document.getElementById('product_detail').style.top = "-300%";
}

// var cart = [];
// if (localStorage['cartCount'] == null)
// {
// 	localStorage.setItem('cartCount', -1);
// }

function isBlocked(name)
{
	var user_info = JSON.parse(localStorage.getItem('user_info'));
	for (var i = 0; i < user_info.length; i++)
		if (name == user_info[i].name)
			if (user_info[i].isBlocked == 1)
				return 1;
			else
				return 0;
}

function addToCart(id)
{
	var cartCount = parseInt(localStorage.getItem('cartCount')) + 1;
	localStorage.setItem('cartCount', cartCount);
	if (document.getElementById('userName') == null)
		alert("Log in before buying our products !!!!");
	else
	{
		var userName = document.getElementById('userName').text;
		if (isBlocked(userName) == 1)
			alert("Your account is blocked!");
		else 
		{
			var sel = document.getElementById("size");
			var sizE = sel.options[sel.selectedIndex].value;
			var quan = document.getElementById('quantity').value;
			if (localStorage['cart'] == null)
				localStorage.setItem('cart', JSON.stringify(cart));
			var stored_cart = JSON.parse(localStorage.getItem('cart'));
			stored_cart.push({name: userName, product: id, size: sizE, quantity: document.getElementById('quantity').value, state: 0, id: cartCount});
			localStorage.setItem('cart', JSON.stringify(stored_cart));
			document.getElementById('quantity').value = 1;
			closeDetail();
		}
	}
}

function totalBill(userName)
{
	var stored_cart = JSON.parse(localStorage.getItem('cart'));
	var stored_products = JSON.parse(localStorage.getItem('product_info'));
	var choseProduct = [];
	for (var i = 0; i < stored_cart.length; i++)
	{
		if (stored_cart[i].name == userName && stored_cart[i].state != 1)
			for (var j = 0; j < stored_products.length; j++)
				if (stored_products[j].id == stored_cart[i].product)
				{
					choseProduct.push({price: stored_products[j].price, quantity: stored_cart[i].quantity});
					break;
				}
	}
	var total = 0;
	for (var i = 0; i < choseProduct.length; i++)
	{
		total += parseInt(choseProduct[i].price) * parseInt(choseProduct[i].quantity);
	}
	return total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
}

function showCart()
{
	if (document.getElementById('userName') == null)
		document.getElementById("MyCart").innerHTML = "Please, log in before buying our products!!!";
	else
	{
		var userName = document.getElementById('userName').text;
		var stored_cart = JSON.parse(localStorage.getItem('cart'));
		var stored_products = JSON.parse(localStorage.getItem('product_info'));
		var inCart = '';
		for (var i = 0; i < stored_cart.length; i++)
		{
			if (userName == stored_cart[i].name)
			{
				for (var j = 0; j < stored_products.length; j++)
					if (stored_products[j].id == stored_cart[i].product)
					{ 
						inCart += '<li>' + '<p style="font-size: 30px">' + stored_products[j].name + '</p>' + '<div>Size: ' + stored_cart[i].size + 
						'<div class="quantity">' + 'Quantity:' + ' <button class="quantitydown" id="' + stored_cart[i].id + 'a"' + 'onclick="quantitydown2(this.id)">-</button> <input type="text" id="quan" value="' + stored_cart[i].quantity + 
						'"> <button class="quantityup" id="' + stored_cart[i].id + "p" + '" onclick="quantityup2(this.id)">+</button></div>' + 
						'<p>Total amount: ' + (parseInt(stored_cart[i].quantity)*parseInt(stored_products[j].price)).toLocaleString('it-IT', {style : 'currency', currency : 'VND'})  + '</p><a id="' + stored_cart[i].id + 'd' + '" onclick="deleteThisProduct(this.id)" class="btn" style="cursor: pointer;margin-top: 0%;">Delete</a></div></div></li>';
						break;
					}
			}
		}
		inCart += '<div class ="bottom_right">Total:  ' + totalBill(userName) + '<a class="btn" style="cursor: pointer;margin-left: 20px" onclick="sendOrder()">Order</a>' + ' </div>'; 
		document.getElementById("MyCart").innerHTML = inCart;
	}
}



function quantitydown2(id)
{
	var stored_cart = JSON.parse(localStorage.getItem('cart'));
	for (var i = 0; i < stored_cart.length; i++) 
	{
		if(id.slice(0, -1) == stored_cart[i].id)
		{
			if(stored_cart[i].quantity > 0)
				stored_cart[i].quantity--;
		}
	}
	localStorage.setItem('cart',JSON.stringify(stored_cart));
	showCart();
}

function quantityup2(id)
{	
	var stored_cart = JSON.parse(localStorage.getItem('cart'));
	for (var i = 0; i < stored_cart.length; i++) 
	{
		if(id.slice(0, -1) == stored_cart[i].id)
		{
			if(stored_cart[i].quantity >= 0)
				stored_cart[i].quantity++;
		}
	}
	localStorage.setItem('cart',JSON.stringify(stored_cart));
	showCart();
}

function closeCart()
{
	document.getElementById('cart').style.top = "-600%";
}

function deleteThisProduct(id)
{
	id = id.slice(0, -1);
	var userName = document.getElementById('userName').text;
	var stored_cart = JSON.parse(localStorage.getItem('cart'));
	for (var i = 0; i < stored_cart.length; i++)
	{
		if (id == stored_cart[i].id && userName == stored_cart[i].name && stored_cart[i].state == 0)
		{
			stored_cart.splice(i, 1);
			break;
		}
	}
	localStorage.setItem('cart',JSON.stringify(stored_cart));
	showCart();
}

if (localStorage['orderCount'] == null)
{
	localStorage.setItem('orderCount', -1);
}

function saveOrder()
{
	var userName = document.getElementById('userName').text;
	var client_order = [];
	var id_client_order = [];
	var stored_order = JSON.parse(localStorage.getItem('order'));
	for (var i = 0; i < stored_order.length; i++)
	{
		if (userName == stored_order[i].name)
		{
			client_order.push(stored_order[i]);
			if (checkIdClient(stored_order[i].id, id_client_order) == false)
				id_client_order.push({id: stored_order[i].id, date: stored_order[i].date, state: stored_order[i].state});
		}
	}

	var sort_client_order = [];
	for (var i = 0; i < id_client_order.length; i++)
	{
		sort_client_order.push({id: id_client_order[i].id, order: [], name: userName, date:  id_client_order[i].date, state: id_client_order[i].state});
	}

	for (var i = 0; i < sort_client_order.length; i++)
	{
		for (var j = 0; j < client_order.length; j++)
			if (client_order[j].id == id_client_order[i].id)
				sort_client_order[i].order.push([client_order[j].product, client_order[j].size, client_order[j].quantity]);
	}

	if (localStorage['save_order'] == null)
		localStorage.setItem('save_order', JSON.stringify(sort_client_order));
	else 
	{
		var save_order = JSON.parse(localStorage.getItem('save_order'));
		for (var i = 0; i < sort_client_order.length; i++)
		{
			var flag = true;
			for (var j = 0; j < save_order.length; j++)
				if (save_order[j].id == sort_client_order[i].id)
					flag = false;
			if (flag == true)
				save_order.push(sort_client_order[i]);
		}
		localStorage.setItem('save_order', JSON.stringify(save_order));
	}
	var save_order = JSON.parse(localStorage.getItem('save_order'));
	// console.log(save_order, "haahah");
}

function checkQuantity(productId, quantity)
{
	var stored_products = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < stored_products.length; i++)
		if (stored_products[i].id == productId)
			if (stored_products[i].quantity >= quantity)
			{
				stored_products[i].quantity -= quantity;
				localStorage.setItem('product_info', JSON.stringify(stored_products));
				return true;
			}
	return false;
}

function sendOrder()
{
	var orderCount = parseInt(localStorage.getItem('orderCount')) + 1; 
	localStorage.setItem('orderCount', orderCount);
	var today = new Date();
	var order = [];
	if (localStorage['order'] == null)
	{
		// console.log("run duj mas mayf");
		localStorage.setItem('order', JSON.stringify(order));
	}
	var stored_order = JSON.parse(localStorage.getItem('order'));
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();
	today = mm + '/' + dd + '/' + yyyy;
	var userName = document.getElementById('userName').text;
	var stored_cart = JSON.parse(localStorage.getItem('cart'));
	for (var i = 0; i < stored_cart.length; i++)
	{
		if (userName == stored_cart[i].name && stored_cart[i].state == 0)
		{
			if (checkQuantity(stored_cart[i].product, stored_cart[i].quantity) == true)
			{
				stored_order.push({date: today, name: userName, product: stored_cart[i].product, size: stored_cart[i].size, quantity: stored_cart[i].quantity, id: orderCount, state: 0});
				stored_cart[i].state = 1;
			}
			else
			{
				alert(getProductName(stored_cart[i].product) + " is out of stock");
			}
		}
	}

	for (var i = 0; i < stored_cart.length; i++)
	{
		if (stored_cart[i].state == 1)
		{
			stored_cart.splice(i, 1);
			i--;
		}
	}

	localStorage.setItem('cart',JSON.stringify(stored_cart));
	localStorage.setItem('order', JSON.stringify(stored_order));
	showCart();
	alert("Go to order section to see your order!!!");
	// console.log('order: ',  JSON.parse(localStorage.getItem('order')));
	saveOrder();
}

function checkIdClient(id, id_array)
{
	if (id_array == [])
		false;
	for (var i = 0; i < id_array.length; i++)
		if (id == id_array[i].id)
			return true;
	return false;
}

function getProductName(id)
{
	var stored_products = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < stored_products.length; i++)
		if (stored_products[i].id == id)
			return stored_products[i].name;
}

function getState(state)
{
	if (state == 0)
		return "Your order is being processed.";
	return "Your order is being delivered.";
}

// function yourOrder()
// {
// 	menutoggle()
// 	document.getElementById('order').style.top = "0%";
	// var save_order = JSON.parse(localStorage.getItem('save_order'));
	// var temp = "";
	// if (document.getElementById('userName') == null)
	// 	document.getElementById("MyOrder").innerHTML = "You have not ordered anything, yet.";
	// else
	// {
	// 	var userName = document.getElementById('userName').text;
	// 	var flag = false;
	// 	for (var i = 0; i < save_order.length; i++)
	// 	{
	// 		if (userName == save_order[i].name)
	// 		{
	// 			temp += '<li style="margin-bottom: 1.5%;"><p>Order ID: ' + save_order[i].id + '</p>' + '<p>Date: ' + save_order[i].date + '</p><p> State: ' + getState(save_order[i].state) + '</p> <ul>';
	// 			for (var j = 0; j < save_order[i].order.length; j++)
	// 			{
	// 				temp += '<li style="display: inline-block; margin-right: 5%;border-radius: 10px;border: 2px solid black; padding: 5px; margin-bottom: 5px"> <p style="font-size: 28px;">' + getProductName(save_order[i].order[j][0]) + "</p>" + "<p> Size: " + save_order[i].order[j][1] + '</p> <p> Quantity: ' + save_order[i].order[j][2] + '</p></li>';
	// 			}
	// 			temp += '</ul></li>';
	// 			flag = true;
	// 		}
	// 	}
	// 	// console.log('sort_client_order', save_order);
	// 	document.getElementById("MyOrder").innerHTML = temp;
	// }
// }

function closeOrder()
{
	document.getElementById('order').style.top = "-600%";
}

function gotoAdmin()
{
	var admin = document.getElementById("userName").text;
	localStorage.setItem('current_admin', admin);
}

function checkAdmin(name)
{
	// console.log("run check admin");
	var admins = JSON.parse(localStorage.getItem("admins"));
	for (var i = 0; i < admins.length; i++)
		if (name == admins[i])
			return 1;
	return 0;
}

function checkName(name)
{
	console.log("name: " + name);
	var user_info = JSON.parse(localStorage.getItem('user_info'));
	for (var i = 0; i < user_info.length; i++)
		if (user_info[i].name == name)
			return true;
	return false;
}

function forgotPW()
{
	var user_info = JSON.parse(localStorage.getItem('user_info'));
	var userName = document.getElementById('user_name').value;
	// console.log(userName);
	var flag = checkName(userName);
	if (flag == true)
	{
		for (var i = 0; i < user_info.length; i++)
		{
			// console.log(user_info[i].name);
			if (userName == user_info[i].name)
			{
				// console.log("check f");
				user_info[i].resetPW = 1;
				localStorage.setItem('user_info', JSON.stringify(user_info));
				break;
			}
		}
		alert("Try to log in after 3 days and new password is '12345'");
	}
	else 
	{
		alert("This name is not existed !!");
	}
}

function hideHeader() 
{
	document.getElementById("Endorser").style.display = "none";
	document.getElementById("propagation").style.display = "none";
	document.getElementById("bs&na").style.display = "none";
	document.getElementById("home").style.height = "100px";
	document.getElementById("all_products").style.display = "block";
}

function editBill(idBill, statusBill) {
	if (statusBill >= 2){
		document.getElementById('btnConfirm').style="display: none";
		document.getElementById('message-confirm').innerHTML="The order has been shipped !";
		document.getElementById('btnConfirmNo').innerHTML="Close";
		document.getElementById('btnpopupConfirm').click();
		return;
	}
	document.getElementById('message-confirm').innerHTML="Do you want to change the status of the order ?";
	document.getElementById('btnpopupConfirm').click();
	document.getElementById('btnConfirm').onclick = function() {
		statusBill++;
		document.getElementById('statusBill').value = statusBill;
		document.getElementById('idBill').value = idBill;
		document.getElementById('typeActionBill').value = "edit";
		document.getElementById("btnActionBill").click();
	}
}

function infoBill(idBill) {
	document.getElementById('idBill').value = idBill;
	document.getElementById('typeActionBill').value = "info";
	document.getElementById('action-result').innerHTML="";
	document.getElementById("btnActionBill").click();
}

function deleteBill(idBill){
	document.getElementById('btnpopupConfirm').click();
	document.getElementById('btnConfirm').onclick = function() {
		document.getElementById('idBill').value = idBill;
		document.getElementById('typeActionBill').value = "delete";
		document.getElementById("btnActionBill").click();
	}
}

function ClickBtnBill() {
	if($("#monthBills").val() != 0 && $("#yearBills").val() == 0){
		document.getElementById('btnConfirm').style="display: none";
		document.getElementById('message-confirm').innerHTML="Please select the number of years !";
		document.getElementById('btnConfirmNo').innerHTML="Close";
		document.getElementById('btnpopupConfirm').click();
		$("#monthBills").val(0);
		return;
	}
	document.getElementById("btnSubmitBill").click();
}

function ClickBtnBill2() {
	if($("#monthBills2").val() != 0 && $("#yearBills2").val() == 0){
		document.getElementById('btnConfirm').style="display: none";
		document.getElementById('message-confirm').innerHTML="Please select the number of years !";
		document.getElementById('btnConfirmNo').innerHTML="Close";
		document.getElementById('btnpopupConfirm').click();
		$("#monthBills2").val(0);
		return;
	}
	document.getElementById("btnSubmitBill2").click();
}

function ClickBtnBill3() {
	if($("#monthBills3").val() != 0 && $("#yearBills3").val() == 0){
		document.getElementById('btnConfirm').style="display: none";
		document.getElementById('message-confirm').innerHTML="Please select the number of years !";
		document.getElementById('btnConfirmNo').innerHTML="Close";
		document.getElementById('btnpopupConfirm').click();
		$("#monthBills3").val(0);
		return;
	}
	document.getElementById("btnSubmitBill3").click();
}

function funcAllBills(){
	$("#statusBills").val('-2');
	$("#monthBills").val('0');
	$("#yearBills").val('0');
	ClickBtnBill();
}
