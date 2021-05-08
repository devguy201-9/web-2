function validateVietnameseName()
{
    var firstLetter="[A-EGHIK-VXYÂĐỔÔÚỨ]".normalize("NFC"),
        otherLetters="[a-eghik-vxyàáâãèéêìíòóôõùúýỳỹỷỵựửữừứưụủũợởỡờớơộổỗồốọỏịỉĩệểễềếẹẻẽặẳẵằắăậẩẫầấạảđ₫]".normalize("NFC"),
        regexString="^"+firstLetter+otherLetters+"+\\s"+"("+firstLetter+otherLetters+"+\\s)*"+firstLetter+otherLetters+"+$",
        regexPattern=RegExp(regexString);
    if(regexPattern.test(document.getElementById('user_name1').value.normalize("NFC")))
        return true;
    return false;
}


function validate(key) 
{
    var res = true;
    var regexPhoneNum = /(0[1-9])+([0-9]{8})\b/;
    var regexEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regexPw = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;

    var email = document.getElementById('email').value;
    var pw = document.getElementById('password1').value;
    var add = document.getElementById('address').value;

    if (validateVietnameseName() != true)
    {
        res = false;
        alert("Name only contains word characters, first letter of each word must be capitalized"); 
        return res;
    }
    if (regexEmail.test(email) != true)
    {
        res = false;
        alert("Email must have character '@', '.', normal ones"); 
        return res;
    }
    if (key == 1)
    {
        if (regexPw.test(pw) != true)
        {
            res = false;
            alert("Password must have lower, upper character, number, special characters, the length at least 8 chars"); 
            return res;
        }
    }
    if (add === "")
    {
        alert("Address must not be empty");
        res = false;
    }
    return res;
}

function openForm2()
{
    closeSideBar();
    closeDetail();
    document.getElementById('addAccount').style.top = '15%';
    document.getElementById("formName").innerHTML = "ADD ACCOUNT";
    document.getElementById("status").value = "1";
    document.getElementById("priority").value = "1";
    document.getElementById("email").disabled = false;
    document.getElementById("add").style.display = "block";
    document.getElementById("save").style.display = "none";
    document.getElementById("priority").style.display = "inline";
    document.getElementById("user_name1").style.display = "inline";
    document.getElementById("address").style.display = "inline";
    document.getElementById("password1").style.display = "inline";
    document.getElementById("addAccount").style.height = "480px"; 
}

function openForm3(id)
{
    if (document.getElementById(id).getAttribute("email") == localStorage.getItem('admin'))
        return false;
    closeSideBar();
    closeDetail();
    document.getElementById('addAccount').style.top = '15%';
    document.getElementById("formName").innerHTML = "EDIT ACCOUNT";
    document.getElementById("save").style.display = "block";
    document.getElementById("add").style.display = "none";
    if (id[0] + id[1] == "kh") 
    {
        document.getElementById("priority").style.display = "none";
        document.getElementById("user_name1").style.display = "none";
        document.getElementById("address").style.display = "none";
        document.getElementById("password1").style.display = "none";
        document.getElementById("addAccount").style.minHeight = "100px";
        document.getElementById("addAccount").style.height = "230px";
        document.getElementById("email").value = document.getElementById(id).getAttribute("email");
        document.getElementById("email").disabled = true;
        document.getElementById("status").value = document.getElementById(id).getAttribute("state");
    } 
    else 
    {
        document.getElementById("email").disabled = true;
        document.getElementById("priority").style.display = "inline";
        document.getElementById("user_name1").style.display = "inline";
        document.getElementById("address").style.display = "inline";
        document.getElementById("password1").style.display = "inline";
        document.getElementById("addAccount").style.height = "480px";
        document.getElementById("user_name1").value = document.getElementById(id).getAttribute("name");
        document.getElementById("email").value = document.getElementById(id).getAttribute("email");
        document.getElementById("status").value = document.getElementById(id).getAttribute("state");
        document.getElementById("address").value = document.getElementById(id).getAttribute("address");
        document.getElementById("priority").value = document.getElementById(id).getAttribute("mach");
        document.getElementById("password1").value = "";
    }
}


function selectData(i){
    var data={};
    if(i==1){
        data['mach'] = document.getElementById("priority").value;
        data['status'] = document.getElementById("status").value;
        data['ten'] = document.getElementById("user_name1").value;
        data['diachi'] = document.getElementById("address").value;
        data['matkhau'] = document.getElementById("password1").value;
        data['email'] = document.getElementById("email").value;
    }
    else{
        data['status'] = document.getElementById("status").value;
        data['email'] = document.getElementById("email").value;
    }
    return data;
} 

function addNV(){
    if (validate(1) == true)
    {
        var data=selectData(1);
        console.log(data);
        var xml=new XMLHttpRequest();
        xml.onreadystatechange=function(){
            if(xml.readyState==4&&xml.status==200){
                console.log(xml.responseText);
                response=JSON.parse(xml.responseText);
                if (response['status'] == 1)
                    search2();
            }
        }
        xml.open("POST", "../edit/index.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send(`requestType=1&requestData=${JSON.stringify(data)}`);
        alert('Add success');
        closeAddForm();
    }
}

function editNV(){
    if (validate(0) == true)
    {
        var data=selectData(1);
        console.log(data);
        var xml=new XMLHttpRequest();
        xml.onreadystatechange=function(){
            if(xml.readyState==4&&xml.status==200){
                console.log(xml.responseText);
                response=JSON.parse(xml.responseText);
                if (response['status'] == 1)
                    search2();
            }
        }
        xml.open("POST", "../edit/index.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send(`requestType=2&requestData=${JSON.stringify(data)}`);
        alert('Update success');
    }
}

function editKH(){
    var data=selectData(0);
    console.log(data);
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4&&xml.status==200){
            console.log(xml.responseText);
            response=JSON.parse(xml.responseText);
            if (response['status'] == 1)
                search2();
        }
    }
    xml.open("POST", "../edit/index.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(`requestType=3&requestData=${JSON.stringify(data)}`);
    alert('Update success');
}

function editUser()
{
    if (document.getElementById("priority").style.display == "none")
    {
        console.log("user");
        editKH();
    }
    else 
        editNV();
}