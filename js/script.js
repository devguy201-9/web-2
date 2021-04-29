document.getElementById('container-data-bill').style.display= "none";

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
		return "Unprocessed.";
	return "Processed.";
}

function getPrice(quantity, productID)
{
	var stored_products = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < stored_products.length; i++)
		if (productID == stored_products[i].id)
			return stored_products[i].price * quantity;
}


function totalPrice(OrderID)
{ 
	var save_order = JSON.parse(localStorage.getItem('save_order'));
	var total_price = 0;
	for (var i = 0; i < save_order.length; i++)
		if (save_order[i].id == OrderID)
			for (var j = 0; j < save_order[i].order.length; j++)
				total_price += parseInt(getPrice(save_order[i].order[j][2], save_order[i].order[j][0]));
	return total_price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
}

function changeState(id)
{
	var save_order = JSON.parse(localStorage.getItem('save_order'));
	for (var i = 0; i < save_order.length; i++)
	{
		if (id == save_order[i].id)
		{
			save_order[i].state = 1;
			document.getElementById("state").innerHTML = "State: Processed";
			var temp = "state" + save_order[i].id;
			console.log(temp);
			document.getElementById(temp).innerHTML = "State: Processed";
			break;
		}
	}
	localStorage.setItem('save_order', JSON.stringify(save_order));
}

function showDetail(id)
{
	document.getElementById('order_detail').style.top = "0%";
	var save_order = JSON.parse(localStorage.getItem('save_order'));
	var temp = "";
	for (var i = 0; i < save_order.length; i++)
	{
		if (id == save_order[i].id)
		{
			temp += '<li style="margin-bottom: 1.5%; list-style-type: none;"><p>Name: ' + save_order[i].name + '</p><p>Order ID: ' + save_order[i].id + '</p>' + '<p>Date: ' + save_order[i].date + '</p><p>Total: ' + totalPrice(save_order[i].id) + '</p><p id="state">State: ' + getState(save_order[i].state) + '</p> <ul class="BillDetail">';
			for (var j = 0; j < save_order[i].order.length; j++)
			{
				temp += '<li style="display: inline-block; margin-right: 10px;margin-left: 5px; margin-bottom: 10px;border-radius: 10px;border: 2px solid black; padding: 5px;"> <p style="margin-top: 3px;margin-bottom: -5px">' + getProductName(save_order[i].order[j][0]) + "</p>" + '<p style="margin-top: 3px;margin-bottom: -10px"> Size:'  + save_order[i].order[j][1] + '</p> <p style="margin-top: 3px;margin-bottom: 10px"> Quantity: ' + save_order[i].order[j][2] + '</p></li>';
			}
			temp += '</ul></li>';
			temp += '<button class="detail" id="' + save_order[i].id + '" onclick="changeState(this.id)"style="margin-left: 7%">Process</button>';
			break;
		}
	}
	document.getElementById("detail").innerHTML = temp;
}

function showBill()
{
	document.getElementById('chart-product').style.display="none";
	document.getElementById('container-data-product').style.display="none";
	document.getElementById('container-data-bill').style.display= "block";
	document.getElementById('statusBills').value=-2;
	document.getElementById('monthBills').value=0;
	changeYears("yearBills");
	ClickBtnBill();
	document.getElementById("center").innerHTML = '<h2 class="title">BILLS</h2>';
	closeSideBar(); 
	closeDetail();
}

function closeDetail()
{
	document.getElementById('order_detail').style.top = "-300%";
	document.getElementById('addProductForm').style.top = "-300%";
	document.getElementById('EditProductForm').style.top = "-300%";
}

// function createPage(product_info)
// {
// 	for (var i = 0; i < product_info.length - 1; i++)
// 		for (var j = i + 1; j < product_info.length ; j++)
// 			if (product_info[j].quantity < product_info[i].quantity)
// 			{
// 				var temp = product_info[j];
// 				product_info[j] = product_info[i];
// 				product_info[i] = temp;
// 			}
// 	var NumPage = '';
// 	for (var i = 0; i < getNum(product_info); i++)
// 		NumPage += '<li><button>' + (i + 1) + '</button></li>';

// 	var saleReport = [];
// 	for (var i = 0; i < getNum(product_info); i++)
// 	{
// 		var temp = '', c = 0, products = '';
// 		for (var j = 12*i; j < 12*i + 12; j++)
// 		{
// 			if (product_info[j] != null)
// 			{
// 				temp += '<div class="col-4"' + 'id="' + product_info[j].id + '">' + '<img src="' + product_info[j].img+ '"><h4 style="font-size: 20px; margin-top:2%">' + product_info[j].name + '</h4><div class="rating"><span style="color: black">&#9733</span><span style="color: black">&#9733</span><span style="color: black">&#9733</span><span style="color: black">&#9733</span><span style="color: black">&#9733</span></div><p>Price: ' + product_info[j].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p><p style="margin-top: -15px">Sold: ' + (100 - product_info[j].quantity) + '</p><p style="margin-top: -15px">In stock: ' + product_info[j].quantity + '</p>' + '</div>';
// 				c += 1;
// 				if (c == 4 || j == product_info.length - 1)
// 				{
// 					temp = '<div class="row2">' + temp + '</div>';
// 					products += temp;
// 					temp = "";
// 					c = 0;
// 				}
// 			}
// 		}
// 		products = '<h2 class="title">' + 'SALE REPORT/' + (i + 1) + '</h2>' + products;
// 		saleReport.push(products);
// 	}
// 	return saleReport;
// }

// function changePage(id)
// {
// 	var product_info = JSON.parse(localStorage.getItem('product_info'));
// 	var saleReport = createPage(product_info);
// 	var temp = '';
// 	for (var i = 0; i < getNum(product_info); i++)
// 		temp += '<li><button id="' + i + '" onclick="changePage(this.id)">' + (i + 1) + '</button></li>';
// 	temp = '<ul class = "page-num" id = "page-num">' + temp + '</ul>';
// 	var result = saleReport[id] + temp;

// 	if (parseInt(id) == 0)
// 	{
// 		var d = new Date();
// 		var m = d.getMonth() + 1;
// 		result = '<canvas id="myChart"></canvas>' + '<div id="monthOfChart"><p style="display: inline-block; font-size: 32px;">Best seller in </p><input class="input" id="month" placeholder="Month" style="margin-left: 5px;width: 73px;margin-bottom: 30px; text-align: center; padding-left: 0" value="' + m + '" onkeyup="reDrawChart()"></div>' + result;
// 		document.getElementById("center").innerHTML = result;
// 		drawChart();
// 	}
// 	else{
// 		document.getElementById("center").innerHTML = result;
// 	}
// }


// function saleReport(){changePage(0); closeSideBar(); closeDetail();}

function changeYears(idNAme){
	var start = 2015;
	var end = new Date().getFullYear();
	var options = "<option selected value='0'>>--Select Year--<</option>";
	for (var year = start; year <= end; year++) {
		options += "<option value='" + year + "'>" + year + "</option>";
	}
	document.getElementById(idNAme).innerHTML = options;
}

function statisticBestProd(){
	document.getElementById('container-data-product').style.display="none";
	document.getElementById('container-data-bill').style.display="none";
    document.getElementById('chart-product').style.display="block";
	document.getElementById('monthBills2').value=0;
	document.getElementById('result-statistic-product').innerHTML='';
    document.getElementById('center').innerHTML="<h2 class=\"title\">Best-selling product statistics over time</h2>";
	changeYears("yearBills2");
	closeSideBar();
}
function statisticBestProdByType(){
	document.getElementById('container-data-bill').style.display="none";
    document.getElementById('chart-product').style.display="none";
	document.getElementById('container-data-product').style.display="block";
	document.getElementById('typeProductBill').value=0;
	document.getElementById('monthBills3').value=0;
	document.getElementById('table-result2').innerHTML='';
	document.getElementById('center').innerHTML="<h2 class=\"title\">Product statistics over time and type</h2>";
	changeYears("yearBills3");
	closeSideBar();
}

function deleteProduct(id)
{
	document.getElementById('message-confirm').innerHTML="Are you sure you want to delete ?";
	document.getElementById('btnpopupConfirm').click();
	document.getElementById('btnConfirm').onclick = function() {
		document.getElementById('idProd').value=id;
		document.getElementById('typeActionProd').value="delete";
		document.getElementById('btnActionProd').click();
	}
}

function getNum(arr)
{
	var num = 0;
	if (arr.length%12 != 0)
		num = float2int(arr.length/12) + 1;
	else 
		num = arr.length/12;
	return num;
}

function float2int (value) 
{
    return value | 0;
}

function isInt(value) 
{
	if (isNaN(value))
    	return false;
	var x = parseInt(value);
	return (x | 0) === x;
}

function AddProduct()
{
	var product_name = document.getElementById("product_name").value;
	var ID = document.getElementById('id').value;
	var price = document.getElementById('price').value;
	var image = document.getElementById('image').value;
	var type = getPrefix(document.getElementById("type").value);

	if (product_name === "" || ID === "" || price === "" || image === "" || isInt(price) == false)
		alert("insert not enough information and/or wrong data.");
	else 
	{
		price = parseInt(price);
		image = '../image/' + image.substr(12, image.length - 12);
		var product_info = JSON.parse(localStorage.getItem('product_info'));
		product_info.push({name: product_name, img: image, price: price, id: type + ID, quantity: 100});
		localStorage.setItem('product_info', JSON.stringify(product_info));
	}
	closeDetail();
	document.getElementById("product_name").value = null;
	document.getElementById('id').value = null;
	document.getElementById('price').value = null;
	document.getElementById('image').value = null;
}

function openForm()
{
	document.getElementById('typeActionProd').value="create";
	document.getElementById('btnActionProd').click();
}

function openFormEdit(id)
{
	document.getElementById('idProd').value=id;
	document.getElementById('typeActionProd').value="findProd";
	document.getElementById('btnActionProd').click();
}

function saleAccordingToMonth()
{
	var d = new Date();
	var m = d.getMonth() + 1;
	console.log("month: ", m);
	var save_order = JSON.parse(localStorage.getItem('save_order'));
	var save_order_2 = [];
	for (var i = 0; i < save_order.length; i++)
	{
		var temp = save_order[i].date.split("/");
		var order_month = temp[0];
		if (order_month == m)
			save_order_2.push(save_order[i]);
	}
	console.log("test");
	console.log(save_order_2);
	return save_order_2;
}

function saleAccordingToMonth2()
{
	var m = document.getElementById("month").value;
	var save_order = JSON.parse(localStorage.getItem('save_order'));
	var save_order_2 = [];
	for (var i = 0; i < save_order.length; i++)
	{
		var temp = save_order[i].date.split("/");
		var order_month = temp[0];
		if (order_month == m)
			save_order_2.push(save_order[i]);
	}
	return save_order_2;
}

function getTotal(product_id, save_order)
{
	var total = 0;
	for (var i = 0; i < save_order.length; i++)
	{
		for (var j = 0; j < save_order[i].order.length; j++)
			if (save_order[i].order[j][0] == product_id)
				total += parseInt(save_order[i].order[j][2]);
	}
	//console.log("total: ", total, product_id);
	return total;
}

function isExitInTop10(product_id, top10)
{
	for (var i = 0; i < top10.length; i++)
		if (product_id == top10[i].id)
			return 1;
	return 0;
}

function getTop10(flag)
{
	var bestSeller;
	if (flag == true)
		bestSeller = saleAccordingToMonth();
	else 
		bestSeller = saleAccordingToMonth2();
	var top10 = [];
	for (var i = 0; i < bestSeller.length; i++)
	{
		for (var j = 0; j < bestSeller[i].order.length; j++)
			if (isExitInTop10(bestSeller[i].order[j][0], top10) == 0)
				top10.push({id: bestSeller[i].order[j][0],Sold: getTotal(bestSeller[i].order[j][0], bestSeller)});
	}

	for (var i = 0; i < top10.length - 1; i++)
		for (var j = i + 1; j < top10.length; j++)
			if (parseInt(top10[j].Sold) > parseInt(top10[i].Sold))
			{
				var temp = top10[i];
				top10[i] = top10[j];
				top10[j] = temp;
			}
	return top10;
}

function getProductName(id)
{
	var stored_products = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < stored_products.length; i++)
		if (stored_products[i].id == id)
			return stored_products[i].name;
}

function openDelForm()
{
	document.getElementById('deleteProForm').style.width = "100%"; 
	closeSideBar();
	closeDetail();
}

function isBlocked(val)
{
	if (val == 1)
		return "Blocked";
	return "Normal";
}

function blockAcc(name)
{
	name = name.slice(0, -1);
	var admins = JSON.parse(localStorage.getItem("admins"));
	if ((name == admins[0] && localStorage.getItem("current_admin") == admins[0]) || checkAdmin(name) != 1 || (checkAdmin(name) == 1 && localStorage.getItem("current_admin") == admins[0]))
	{
		var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
		for (var i = 0; i < stored_accounts.length; i++)
		{
			if (name == stored_accounts[i].name)
			{
				stored_accounts[i].isBlocked = 1;
				break;
			}
		}
		localStorage.setItem('user_info', JSON.stringify(stored_accounts));
		document.getElementById('AccState' + name).innerHTML = "State: Blocked";
		document.getElementById(name + 'B').style.display = "none";
		document.getElementById(name + 'U').style.display = "inline-block";
	}
	else alert("This action is beyond your authority!");
}

function unblockAcc(id)
{
	id = id.slice(0, -1);
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	for (var i = 0; i < stored_accounts.length; i++)
	{
		if (id == stored_accounts[i].name)
		{
			stored_accounts[i].isBlocked = 0;
			break;
		}
	}
	localStorage.setItem('user_info', JSON.stringify(stored_accounts));
	document.getElementById('AccState' + id).innerHTML = "State: Normal";
	document.getElementById(id + 'U').style.display = "none";
	document.getElementById(id + 'B').style.display = "inline-block";
}

function getButton(user)
{
	if (user.isBlocked == 1)
	{
		console.log("btntnntn", user.name);
		return '<button id="' + user.name + 'U' +  '" class="btn2" style="display: inline-block" onclick="unblockAcc(this.id)">Unblock</button>' + '<button id="' + user.name + 'B' +  '" class="btn2" style="display: none" onclick="blockAcc(this.id)">Block</button>' ;
	}
	return '<button id="' + user.name + 'U' +  '" class="btn2" style="display: none" onclick="unblockAcc(this.id)">Unblock</button>' + '<button id="' + user.name + 'B' +  '" class="btn2" style="display: inline-block" onclick="blockAcc(this.id)">Block</button>' ;
}

function resetButton(user)
{
	if (user.resetPW == 1)
		return '<button id="' + user.name +  '" class="btn2" style="display: inline-block" onclick="resetPw(this.id)">Reset</button>';
	return " ";
}

function search2()
{
	var input = document.getElementById("input2").value.toLowerCase();
	if (input === "")
		openManageAccForm();
	else 
	{
		var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
		var flag = false;
		var temp = '', c = 0, result = '';
		for (var j = 0; j < stored_accounts.length; j++)
		{
			if (stored_accounts[j].name.toLowerCase().indexOf(input) != -1)
			{
				console.log("run12");
				temp += '<div class="col-4" style="border: 3px solid #ff8c00"><h4 style="font-size: 20px; margin-top:2%">' + stored_accounts[j].name + '</h4><p style="margin-top: -21px; margin-bottom: -10px">Phone number: ' + stored_accounts[j].phoneNumber + '</p><p style="margin-bottom: -10px">Address: ' + stored_accounts[j].address + '</p><p style="margin-bottom: -10px">Email: ' + stored_accounts[j].email + '</p><p id="AccState' + stored_accounts[j].name + '">State: ' + isBlocked(stored_accounts[j].isBlocked) + '</p>'+ getButton(stored_accounts[j]) + '<button id="' + stored_accounts[j].name + '"class="btn2" onclick="deleteAcc(this.id)">Delete</button>' + '<button id="' + stored_accounts[j].name + '"class="btn2" onclick="openForm3(this.id)">Edit</button>' + resetButton(stored_accounts[j]) + '</div>';
				c += 1;
				if (c == 4 || j == stored_accounts.length - 1)
				{
					temp = '<div class="row2">' + temp + '</div>';
					result += temp;
					temp = "";
					c = 0;
					flag = true;
				}
			}
		}
			
		if (flag == false)
			result = '<div class="row2">' + temp + '</div>';
		document.getElementById('search_result1').innerHTML = result;
	}
	console.log("run12356");

}

function openManageAccForm()
{
	document.getElementById('manageAccount').style.width = "100%"; 
	closeSideBar();
	closeDetail();
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	var flag = false;
	var temp = '', c = 0, result = '';
	for (var j = 0; j < stored_accounts.length; j++)
	{
		temp += '<div class="col-4" style="border: 3px solid #ff8c00"><h4 style="font-size: 20px; margin-top:2%">' + stored_accounts[j].name + '</h4><p style="margin-top: -21px; margin-bottom: -10px">Phone number: ' + stored_accounts[j].phoneNumber + '</p><p style="margin-bottom: -10px">Address: ' + stored_accounts[j].address + '</p><p style="margin-bottom: -10px">Email: ' + stored_accounts[j].email + '</p><p id="AccState' + stored_accounts[j].name + '">State: ' + isBlocked(stored_accounts[j].isBlocked) + '</p>'+ getButton(stored_accounts[j]) + '<button id="' + stored_accounts[j].name + '"class="btn2" onclick="deleteAcc(this.id)">Delete</button>' + '<button id="' + stored_accounts[j].name + '"class="btn2" onclick="openForm3(this.id)">Edit</button>' + resetButton(stored_accounts[j]) + '</div>';
		c += 1;
		if (c == 4 || j == stored_accounts.length - 1)
		{
			temp = '<div class="row2">' + temp + '</div>';
			result += temp;
			temp = "";
			c = 0;
			flag = true;
		}
	}
		
	if (flag == false)
		result = '<div class="row2">' + temp + '</div>';
		//console.log(result);
	document.getElementById('search_result1').innerHTML = result;
}

function closeDelForm()
{
	document.getElementById('deleteProForm').style.width = "0%";
	document.getElementById('manageAccount').style.width = "0%"; 
	closeDetail();
	document.getElementById('kind').value='idProduct';
	document.getElementById('inputSearch').value='';
	document.getElementById('search_result').innerHTML='';
	closeAddForm();
}

function searchById()
{
	var result = '';
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	var temp = '', c = 0, products = '';
	var input = document.getElementById("input").value.toLowerCase();
	var flag = false;
	if (input === "")
		document.getElementById('search_result').innerHTML = result;
	else
	{
		var flag = false;
		for (var j = 0; j < product_info.length; j++)
		{
			// console.log(j);
			if (product_info[j].id.toLowerCase().indexOf(input) != -1)
			{
				temp += '<div class="col-4"' + 'id="' + product_info[j].id + '">' + '<img src="' + product_info[j].img+ '"><h4 style="font-size: 20px; margin-top:2%">' + product_info[j].name + '</h4><p style="margin-top: -21px; margin-bottom: -10px">Price: ' + product_info[j].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="btn" id="' + product_info[j].id + '" onclick="deleteProduct(this.id)">Delete</button><button id="' + product_info[j].id + '"class="btn" onclick="editInfo(this.id)">Edit</button></div>';
				c += 1;
				if (c == 4 || j == product_info.length - 1)
				{
					temp = '<div class="row2">' + temp + '</div>';
					result += temp;
					temp = "";
					c = 0;
					flag = true;
				}
				// console.log(product_info[j]);
			}
		}
		if (flag == false)
			result = '<div class="row2">' + temp + '</div>';
		//console.log(result);
		document.getElementById('search_result').innerHTML = result;
	}
}

function searchByName()
{
	var result = '';
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	var temp = '', c = 0, products = '';
	var input = document.getElementById("input").value.toLowerCase();
	if (input === "")
		document.getElementById('search_result').innerHTML = result;
	else
	{
		var flag = false;
		for (var j = 0; j < product_info.length; j++)
		{
			console.log(j);
			if (product_info[j].name.toLowerCase().indexOf(input) != -1)
			{
				temp += '<div class="col-4"' + 'id="' + product_info[j].id + '">' + '<img src="' + product_info[j].img+ '"><h4 style="font-size: 20px; margin-top:2%">' + product_info[j].name + '</h4><p style="margin-top: -21px; margin-bottom: -10px">Price: ' + product_info[j].price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</p>' + '<button class="btn" id="' + product_info[j].id + '" onclick="deleteProduct(this.id)">Delete</button><button id="' + product_info[j].id + '"class="btn" onclick="editInfo(this.id)">Edit</button></div>';
				c += 1;
				if (c == 4 || j == product_info.length - 1)
				{
					temp = '<div class="row2">' + temp + '</div>';
					result += temp;
					temp = "";
					c = 0;
					flag = true;
				}
				console.log(product_info[j]);
			}
		}
		if (flag == false)
			result = '<div class="row2">' + temp + '</div>';
		console.log(result);
		document.getElementById('search_result').innerHTML = result;
	}
}

function searchProduct() {
	document.getElementById("submitSearchProd").click();
}
function changeSearchProduct(){
	document.getElementById('inputSearch').value='';
	let kind = document.getElementById('kind').value;
	if(kind =="idProduct"){
		document.getElementById("inputSearch").placeholder = "Search by product ID";
	} else {
		document.getElementById("inputSearch").placeholder = "Search by product name";
	}
	searchProduct();
}

function getType(id)
{
	if (id[0] == 'p')
		return "pant";
	return "shirt";
}

function getPrefix(string)
{
	return string[0];
}

function getPostfix(string)
{
	return string.substring(1);
}

function editInfo(id)
{
	document.getElementById('EditProductForm').style.height = "435px";
	document.getElementById('EditProductForm').innerHTML = '<a class="closeDetail2" onclick="closeDetail()" style="cursor: pointer;">×</a><form><h2>EDIT PRODUCT</h2><input type="text" placeholder="Product name" id="product_name1"><input type="text" placeholder="Price" id="price1"><input type="text" placeholder="Quantity" id="quantity1"><input type="text" placeholder="Product type" id="type1"><input type="text" placeholder="Product ID" id="id2"><p style="margin-top: -4px; margin-bottom: -4px">Product image:</p><input type="file" placeholder="Image" id="image1"><a class="btn" id="' + id + '"onclick = "saveChanges(this.id)" style="width: 64%">SAVE CHANGES</a></form>';
	var product_info = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < product_info.length; i++)
		if (id == product_info[i].id)
		{
			document.getElementById("product_name1").value = product_info[i].name;
			document.getElementById("price1").value = product_info[i].price;
			document.getElementById("quantity1").value = product_info[i].quantity;
			document.getElementById("type1").value = getType(product_info[i].id);
			document.getElementById("id2").value = getPostfix(product_info[i].id);
			localStorage.setItem('current_product_id', product_info[i].id);
		}
	document.getElementById('EditProductForm').style.top = "15%";
}

function checkExistPid(id)
{
	var stored_products = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < stored_products.length; i++)
		if (id == stored_products[i].id)
		{
			alert("This id is existing");
			return 1;
		}
	return 0;
}

function saveChanges(id)
{
	var product_name = document.getElementById("product_name1").value;
	var price = document.getElementById('price1').value;
	var image = document.getElementById('image1').value;
	var quantity = document.getElementById("quantity1").value;
	var type = getPrefix(document.getElementById("type1").value)
	var id2 = document.getElementById("id2").value;
	id2 = type + id2;

	var product_info = JSON.parse(localStorage.getItem('product_info'));
	for (var i = 0; i < product_info.length; i++)
		if (id == product_info[i].id)
		{
			if (product_name !== '')
				product_info[i].name = product_name;
			if (price !== '')
				product_info[i].price = parseInt(price);
			if (quantity !== '')
				product_info[i].quantity = parseInt(quantity);
			if (image !== '')
			{
				image = '../image/' + image.substr(12, image.length - 12);
				product_info[i].img = image;
			}
			if (type !== '' && id2 != localStorage.getItem('current_product_id') && checkExistPid(id2) == 0)
			{
				console.log("run change id");
				product_info[i].id = id2;
			}
			break;
		}
	localStorage.setItem('product_info', JSON.stringify(product_info));
	closeDetail();
	document.getElementById("product_name1").value = null;
	document.getElementById("quantity1").value = null;
	document.getElementById('price1').value = null;
	document.getElementById('image1').value = null;	
}

function closeSideBar()
{
	document.getElementById("openSidebarMenu").checked = false;
	document.getElementById("sidebarMenu").style.transform = "translateX(-250px)";
}

function openSidebar()
{
	console.log(document.getElementById("openSidebarMenu").checked);
	if (document.getElementById("openSidebarMenu").checked == false)
		document.getElementById("sidebarMenu").style.transform = "translateX(0px)";
	else
		document.getElementById("sidebarMenu").style.transform = "translateX(-250px)";
}

function closeAddForm()
{
	document.getElementById('addAccount').style.top = '-300%';
	document.getElementById("password1").value = null;
	document.getElementById("user_name1").value = null;
	document.getElementById("email").value = null;
	document.getElementById("phoneNumber").value = null;
	document.getElementById("address").value = null;
}

function openForm2()
{
	closeSideBar();
	closeDetail();
	document.getElementById('addAccount').style.top = '15%';
	document.getElementById("formName").innerHTML = "ADD ACCOUNT";
	document.getElementById("add").style.display = "block";
	document.getElementById("save").style.display = "none";
	document.getElementById("priority").innerHTML = '<option>User</option><option>Admin</option>';
}

function openForm3(name)
{
	closeSideBar();
	closeDetail();
	document.getElementById('addAccount').style.top = '15%';
	document.getElementById("formName").innerHTML = "EDIT ACCOUNT";
	document.getElementById("save").style.display = "block";
	document.getElementById("add").style.display = "none";
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	for (var i = 0; i < stored_accounts.length; i++)
		if (name == stored_accounts[i].name)
		{
			document.getElementById("user_name1").value = stored_accounts[i].name;
			document.getElementById("email").value = stored_accounts[i].email;
			document.getElementById("password1").value = stored_accounts[i].password;
			document.getElementById("phoneNumber").value = stored_accounts[i].phoneNumber;
			document.getElementById("address").value = stored_accounts[i].address;
			if (checkAdmin(name) == 1)
				document.getElementById("priority").innerHTML = '<option>Admin</option><option>User</option>';
			else document.getElementById("priority").innerHTML = '<option>User</option><option>Admin</option>';
			localStorage.setItem('current_name', stored_accounts[i].name);
			break;
		}
}

function getInfo1()
{
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	var password = document.getElementById("password1").value;
	var flag = 1;
	for (var i = 0; i < stored_accounts.length; i++)
		if (document.getElementById("user_name1").value == stored_accounts[i].name)
		{
			alert("This user name has been used.");
			flag = 0;
		}
	if (flag != 0)
	{
		var userName = document.getElementById("user_name1").value;
		var phoneNumber = document.getElementById("phoneNumber").value;
		var address1 = document.getElementById("address").value;
		var email1 = document.getElementById("email").value;
		if ( userName === "" || phoneNumber === "" || address1 === "" || email1 === "" || password === "")
		{
			alert("You have not insert enough information!!!");
		}
		else
		{
			stored_accounts.push({name: userName, password: password.toString(), state: 0, phoneNumber: phoneNumber.toString(), address: address1, email: email1, isBlocked: 0, resetPW: 0});
			localStorage.setItem('user_info', JSON.stringify(stored_accounts));
			var sel1 = document.getElementById("priority");
			var text1 = sel1.options[sel1.selectedIndex].text;
			var admins = JSON.parse(localStorage.getItem("admins"));
			if (text1 == "Admin" && localStorage.getItem("current_admin") == admins[0])
			{
				console.log("run add admin");
				var admins = JSON.parse(localStorage.getItem("admins"));
				admins.push(userName);
				localStorage.setItem('admins', JSON.stringify(admins));
			}
			else if (text1 == "Admin")
			{
				alert("This action is beyond your authority, the account you just added is a normal user!");
			}
			closeAddForm();
			openManageAccForm();
		}
	}
}

function getInfo2()
{
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	var password = document.getElementById("password1").value;
	var current_name = localStorage.getItem('current_name');
	var flag = 1;
	var userName = document.getElementById("user_name1").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
	var address1 = document.getElementById("address").value;
	var email1 = document.getElementById("email").value;
	var flag = 1;
	for (var i = 0; i < stored_accounts.length; i++)
		if (userName == stored_accounts[i].name && current_name != stored_accounts[i].name)
		{
			alert("This user name has been used.");
			flag = 0;
			break;
		}
	
	if (flag == 1)
	{
		for (var i = 0; i < stored_accounts.length; i++)
			if (stored_accounts[i].name == current_name)
			{
				var admins = JSON.parse(localStorage.getItem("admins"));
				if ((current_name == admins[0] && localStorage.getItem("current_admin") == admins[0]) || checkAdmin(current_name) != 1 || (current_name != admins[0] && localStorage.getItem("current_admin") == admins[0]) )
				{
					stored_accounts[i].name = userName;
					for (var j = 0; j < admins.length; j++)
						if (admins[j] == current_name)
						{
							admins[j] = userName;
							break;
						}
					localStorage.setItem('admins', JSON.stringify(admins));
					stored_accounts[i].phoneNumber = phoneNumber;
					stored_accounts[i].email = email1;
					stored_accounts[i].address = address1;
					stored_accounts[i].password = password;
					localStorage.setItem('user_info', JSON.stringify(stored_accounts));
				}
				else
				{
					alert("This action is beyond your authority!");
					flag = 0;
				}
				break;
			}
		if (flag == 1)
		{
			var sel1 = document.getElementById("priority");
			var text1 = sel1.options[sel1.selectedIndex].text;
			var admins = JSON.parse(localStorage.getItem("admins"));
			if (text1 == "Admin" && checkAdmin(userName) != 1 && localStorage.getItem("current_admin") == admins[0])
			{
				console.log("run add admin");
				admins.push(userName);
				localStorage.setItem('admins', JSON.stringify(admins));
			}
			else if (text1 == "User" && checkAdmin(userName) == 1 && localStorage.getItem("current_admin") != admins[0])
				alert("This action is beyond your authority!");
			else if (text1 == "Admin" && checkAdmin(userName) != 1 && localStorage.getItem("current_admin") != admins[0])
				alert("This action is beyond your authority!");
			else if (text1 != "Admin" && userName != localStorage.getItem("current_admin") && userName != admins[0])
				removeAdmin(userName);
		}
		closeAddForm();
		openManageAccForm();
	}
}

function loadPage()
{
	document.getElementById('addProductForm').style.top = "-300%";
	showBill();
	var admin = localStorage.getItem('current_admin');
	document.getElementById("admin").innerHTML = admin + "<span>Co-founder and owner</span>"
}

function checkAdmin(name)
{
	console.log("run check");
	var admins = JSON.parse(localStorage.getItem("admins"));
	for (var i = 0; i < admins.length; i++)
		if (name == admins[i])
			return 1;
	return 0;
}

function deleteAcc(id)
{
	var admin = localStorage.getItem('current_admin');
	var admins = JSON.parse(localStorage.getItem("admins"));
	var admin = localStorage.getItem('current_admin');
	var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
	if (checkAdmin(id) && admin != admins[0])
	{
		console.log("run123");
		alert("This account can't be deleted because you are not " + admins[0]);
	}
	else
	{
		for (var i = 0; i < stored_accounts.length; i++)
		{
			if (id == stored_accounts[i].name)
			{
				if (confirm("Your action can't be undone!"))
				{
					stored_accounts.splice(i, 1);
					if (checkAdmin(id) == 1)
						removeAdmin(id);
				}
				break;
			}
		}
		localStorage.setItem('user_info', JSON.stringify(stored_accounts));
		openManageAccForm();
	}
}

function removeAdmin(name)
{
	var admins = JSON.parse(localStorage.getItem("admins"));
	for (var i = 0; i < admins.length; i++)
		if (name == admins[i])
		{
			admins.splice(i, 1);
			break;
		}
	localStorage.setItem('admins', JSON.stringify(admins));
}

function resetPw(name)
{
	var user_info = JSON.parse(localStorage.getItem('user_info'));
	for (var i = 0; i < user_info.length; i++)
		if (name == user_info[i].name)
		{
			if (confirm("Reset this user password"))
			{
				user_info[i].password = "12345";
				user_info[i].resetPW = 0;
				localStorage.setItem('user_info', JSON.stringify(user_info));
				openManageAccForm();
			}
			break;
		}
}