var response={};
function renderInfo(){
    console.log(1);
}

function validateVietnameseName(){
    var firstLetter="[A-EGHIK-VXYÂĐỔÔÚỨ]".normalize("NFC"),
        otherLetters="[a-eghik-vxyàáâãèéêìíòóôõùúýỳỹỷỵựửữừứưụủũợởỡờớơộổỗồốọỏịỉĩệểễềếẹẻẽặẳẵằắăậẩẫầấạảđ₫]".normalize("NFC"),
        regexString="^"+firstLetter+otherLetters+"+\\s"+"("+firstLetter+otherLetters+"+\\s)*"+firstLetter+otherLetters+"+$",
        regexPattern=RegExp(regexString);
    if(regexPattern.test(document.getElementById('user_name1').value.normalize("NFC")))
        return true;
    return false;
}

function close_login_reg_form()
{
    document.getElementById("account").style.display = "none";
    console.log(document.getElementById("home"), document.getElementById('bs&na').style.display);
    var x = document.getElementById("home");
    if (x.offsetHeight == 680 && document.getElementById('bs&na').style.display != 'none')
    {
        document.getElementById("home").style.height = "760px";
        document.getElementById("Endorser").style.display = "block";
        document.getElementById("propagation").style.display = "block";
        document.getElementById("user_name").value = null;
        document.getElementById("password").value = null; 
        document.getElementById("password1").value = null;
        document.getElementById("user_name1").value = null;
        document.getElementById("email").value = null;
        document.getElementById("phoneNumber").value = null;
        document.getElementById("address").value = null;
    }
    else
    {
        document.getElementById("home").style.height = "100px";
    }
}

// function renderData(){
//     if(response['sp']){
//         let sp="";
//         for(let i=0;i<response['sp'].length;i++){
//             sp+=`<div class="sp"><img src="./${response['sp'][i]['hinh']}" alt="" class="hinh"><div class="ten">${response['sp'][i]['ten']}</div></div>`
//         }
//         document.querySelector('.data').innerHTML=sp;
//     }
// }

function checkCookie(){
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4 && xml.status==200){
            response=JSON.parse(xml.responseText);
            console.log(response);
            console.log(xml.responseText);
            if(response['status']==1){
                document.getElementById("acc").innerHTML = '<a id="userName">' + response['thongtin']['name'].split(" ").splice(-1) + '</a>';
                document.getElementById("logOut").style.display = "inline-block";
                document.getElementById("log_out").innerHTML = '<i class="fas fa-sign-out-alt"></i>'; 
            }
            else{
                if(response['status']==-1)
                    console.log("hahahaha");
            }
        }
    }
    xml.open('post','../login/login.php');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send("requestType=1");
}

window.onload=checkCookie;
function loginPHP(){
    var xml=new XMLHttpRequest();
    let email=document.querySelector('#user_name'),password=document.querySelector('#password');
    xml.onreadystatechange=function(){
        if(xml.readyState==4 && xml.status==200){
            console.log(xml.responseText);
            response=JSON.parse(xml.responseText);
            console.log(response);
            console.log(xml.responseText);
            if(response['status']==1){
                document.getElementById("acc").innerHTML = '<a id="userName">' + response['thongtin']['name'].split(" ").splice(-1) + '</a>';
                document.getElementById("logOut").style.display = "inline-block";
                document.getElementById("log_out").innerHTML = '<i class="fas fa-sign-out-alt"></i>'; 
                close_login_reg_form();
            }
            else{
                alert("Log in, unsuccessfully");
            }
        }
    }
    console.log("truoc: "+email+" "+password);
    xml.open('post','../login/login.php');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(`requestType=2&email=${email.value}&pass=${password.value}`);
    // xml.send();
}

// function clear(){
//     document.querySelector('.info .hinh').src="";
//     document.querySelector('.info .ten').innerHTML="";
//     document.querySelector('.info .email').innerHTML="";
//     document.querySelector('.data').innerHTML="";

// }

function log(){
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4 && xml.status==200){
            response=JSON.parse(xml.responseText);
            console.log(xml.responseText);

            if(response['status']==1)
            {
                alert("Log out successfully");
            }
            else
                alert("Log out unsuccessfully");
        }
    }
    xml.open('post','../login/login.php');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send("requestType=3");
    document.getElementById("acc").innerHTML =  '<a href="#" title = "log in" onclick = "open_login_reg_form()"><i" class="fas fa-user"></i></a>';
    document.getElementById("log_out").innerHTML = " ";
    document.getElementById("logOut").style.display = "none";
}


function validate() 
{
    var res = true;
    var regexPhoneNum = /(0[1-9])+([0-9]{8})\b/;
    var regexEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regexPw = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;

    var phone = document.getElementById('phoneNumber').value;
    var email = document.getElementById('email').value;
    var pw = document.getElementById('password1').value;
    var add = document.getElementById('address').value;

    if (validateVietnameseName() != true)
    {
        res = false;
        alert("Name only contains word characters"); 
        return res;
    }
    if (regexPhoneNum.test(phone) != true)
    {
        res = false;
        alert("Phone number only contains numeric characters and the first character must be '0'");
        return res;
    }
    if (regexEmail.test(email) != true)
    {
        res = false;
        alert("Email must have character '@', '.', normal ones"); 
        return res;
    }
    if (regexPw.test(pw) != true)
    {
        res = false;
        alert("Password must have lower, upper character, number, special characters, the length at least 8 chars"); 
        return res;
    }
    if (add === "")
    {
        alert("Address must not be empty");
        res = false;
    }
    return res;
}

function registerPHP(){
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4 && xml.status==200){
            response=JSON.parse(xml.responseText);
            console.log(response);
            console.log(xml.responseText);
            if (response["status"] == 1)
            {
                name=document.querySelector('#user_name1').value;
                email=document.querySelector('#email').value;
                password=document.querySelector('#password1').value;
                document.getElementById("acc").innerHTML = '<a id="userName">' + name.split(" ").splice(-1) + '</a>';
                document.getElementById("log_out").innerHTML = '<i class="fas fa-sign-out-alt"></i>';
                document.getElementById("logOut").style.display = "inline-block";

                document.getElementById("user_name").value = email;
                document.getElementById("password").value = password;
                loginPHP();
            }
            else 
                alert("This email is already taken"); 
        }
    }
    if (validate() == true)
    {
        xml.open('post','../login/login.php');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let name,email,password,phoneNumber,address,gioitinh;
        name=document.querySelector('#user_name1').value;
        email=document.querySelector('#email').value;
        password=document.querySelector('#password1').value;
        phoneNumber=document.querySelector('#phoneNumber').value;
        address=document.querySelector('#address').value;
        xml.send(`requestType=4&name=${name}&pass=${password}&email=${email}&sdt=${phoneNumber}&diachi=${address}`);
    }
}