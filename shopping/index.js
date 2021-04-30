function collectData(idSP){
    var data={};
    data['email']=document.getElementById("userName").getAttribute("thongtin");
    data['msp']=idSP;
    data['sl']=document.querySelector('#quantity').value;
    data['gia']=((document.getElementById(idSP + 'p').innerText).split(" "))[0];
    data['size']=document.getElementById('size').value;
    return data;
}
function addPHP(idSP){
    var data=collectData(idSP);
    // console.log(data);
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4&&xml.status==200){
            // console.log("cart\n", xml.responseText);
            response=JSON.parse(xml.responseText);
            if(response['status']==1)
                alert("Adding this product to your cart, successfully");
        }
    }
    xml.open("POST", "../shopping/index.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(`requestType=1&requestData=${JSON.stringify(data)}`);
}
function orderPHP(){
    var data={};
    data['email']=document.getElementById("userName").getAttribute("thongtin");
    data['total'] = document.getElementById("orderBill").getAttribute("price");
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4&&xml.status==200){
            // console.log(xml.responseText);
            checkCookie();
        }
    }
    xml.open("POST", "../shopping/index.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(`requestType=3&requestData=${JSON.stringify(data)}`);
}
function deletePHP(idSP){
    if (confirm("Your action cannot be undone!"))
    {
        // var data=collectData();
        var data={};
        data['msp'] = idSP;
        data['sl'] = document.getElementById(idSP + "q").innerText;
        data['size'] = document.getElementById(idSP + "s").innerText;
        data['email']=document.getElementById("userName").getAttribute("thongtin");
        document.getElementById(idSP + 'r').style.display = "none";
        // console.log(data);
        var xml=new XMLHttpRequest();
        xml.onreadystatechange=function(){
            if(xml.readyState==4&&xml.status==200){
                // console.log('Xoa san pham\n' + xml.responseText);
                checkCookie();
            }
        }
        xml.open("POST", "../shopping/index.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send(`requestType=2&requestData=${JSON.stringify(data)}`);
    }
}