var response={};
function renderInfo(){
    console.log(1);
}

function loadPage(name)
{
    document.getElementById('addProductForm').style.top = "-300%";
    showBill();
    document.getElementById("admin").innerHTML = name + "<span>Co-founder and owner</span>"
}

function checkCookie(){
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4 && xml.status==200){
            console.log("check cookie");
            response=JSON.parse(xml.responseText);
            console.log(response);
            if(response['status']==1){
                var flag = 0;

                if ((window.location.href).split("/")[((window.location.href).split("/")).length-1] === "logInAdmin.html")
                {
                    window.location.replace((window.location.href).split("/").slice(0, -1).join("/") + "/adminPage.php");
                    // window.location.href.replace(window.location.search,'');
                }
                else
                {
                    let n = response['thongtin']['name'].replace(/[\[\]?.,\/#!$%\^&\*;:{}=\\|_~()]/g, "").split(" ");
                    loadPage(n[n.length - 1]);
                }
            }

            else{
                if(response['status']==-1)
                {
                    console.log("hahahaha");
                     if ((window.location.href).split("/")[((window.location.href).split("/")).length-1] !== "logInAdmin.html")
                        window.location.replace((window.location.href).split("/").slice(0, -1).join("/") + "/logInAdmin.html");
                }
            }
        }
    }
    xml.open('post','../login/loginAdmin.php');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send("requestType=1");
}

window.onload=checkCookie;
function loginPHP(){
    if (validate())
    {
        var xml=new XMLHttpRequest();
        let email=document.querySelector('#user_name'),password=document.querySelector('#password');
        xml.onreadystatechange=function(){
            if(xml.readyState==4 && xml.status==200){
                console.log("Login");
                response=JSON.parse(xml.responseText);
                console.log(response);
                // console.log(xml.responseText);
                if(response['status']==1){
                    window.location.replace((window.location.href).split("/").slice(0, -1).join("/") + "/adminPage.php");
                }
                else{
                    alert("Log in, unsuccessfully");
                }
            }
        }
        // console.log("truoc: "+email+" "+password);
        xml.open('post','../login/loginAdmin.php');
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send(`requestType=2&email=${email.value}&pass=${password.value}`);
    }
}

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
    xml.open('post','../login/loginAdmin.php');
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send("requestType=3");
}


function validate() 
{
    var pw = document.getElementById('password').value;
    var name = document.getElementById('user_name').value;

    if (name === "" || pw === "")
        return false;
    return true;
}