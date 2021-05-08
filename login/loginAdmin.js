var response={};
function renderInfo(){
    console.log(1);
}

function loadPage(name, mach)
{
    document.getElementById('addProductForm').style.top = "-300%";
    if (mach == "1")
        document.getElementById("admin").innerHTML = '<i class="fas fa-sign-out-alt" onclick="log()"></i>' + name + "<span>Manager</span> ";
    else
        document.getElementById("admin").innerHTML = '<i class="fas fa-sign-out-alt" onclick="log()"></i>' + name + "<span>Saleman</span> ";
    showBill();
}

function openManageAccForm()
{
    document.getElementById('manageAccount').style.width = "100%"; 
    document.getElementById('input2').value = ""; 
    closeSideBar();
    closeDetail();
    var stored_accounts = JSON.parse(localStorage.getItem('user_info'));
    search2();
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
                }
                else
                {
                    let n = response['thongtin']['name'].replace(/[\[\]?.,\/#!$%\^&\*;:{}=\\|_~()]/g, "").split(" ");
                    loadPage(n[n.length - 1], response['thongtin']['maCh']);
                    if (response['thongtin']['maCh'] == "1")
                        localStorage.setItem("admin", response['thongtin']['email']);
                    else 
                    {
                        document.getElementById('ffa').style.display = "none";
                    }
                }
            }

            else{
                if(response['status']==-1 || response['status']==0)
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
                window.location.replace((window.location.href).split("/").slice(0, -1).join("/") + "/logInAdmin.html");
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