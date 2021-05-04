function selectData(i){
    if(i==1){
        var data={};
        data['ten']=document.querySelector
        data['diachi'];
        data['tinhtrang'];
        // data['']
    }
    else{
        var data={};
        data['tinhtrang'];
    }
}

function addNV(){
    var data=selectData(1);
    console.log(data);
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4&&xml.status==200){
            console.log(xml.responseText);
        }
    }
    xml.open("POST", "index.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(`requestType=1&requestData=${JSON.stringify(data)}`);
}

function editNV(){
    var data=selectData(1);
    console.log(data);
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4&&xml.status==200){
            console.log(xml.responseText);
        }
    }
    xml.open("POST", "index.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(`requestType=2&requestData=${JSON.stringify(data)}`);
}

function editKH(){
    var data=selectData(1);
    console.log(data);
    var xml=new XMLHttpRequest();
    xml.onreadystatechange=function(){
        if(xml.readyState==4&&xml.status==200){
            console.log(xml.responseText);
        }
    }
    xml.open("POST", "../edit/index.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(`requestType=3&requestData=${JSON.stringify(data)}`);
}