
//döljer/visar menyn för blogg
blogglink = document.getElementById('blogglink');

blogglink.onclick = function(){
    var all = document.getElementById("alllink");
    var create = document.getElementById("createlink");
    var del = document.getElementById("deletelink");
    
    if (create.style.display === "block") {
        all.style.display = "none";
        create.style.display = "none";

        del.style.display = "none";
    } else {
        all.style.display = "block";
        create.style.display = "block";
        del.style.display = "block";
    }
    return false;
};

//döljer/visar listan för användare
//fixme varför funkar den inte?

userlistbtn = document.getElementById('userlistbtn');

userlistbtn.onclick = function(){
    var userlist = userlistbtn.parentElement.parentElement.getElementsByClassName("submenu");
    for (let i = 0; i < userlist.length; i++) {
        if (userlist[i].style.display === "block") {
            userlist[i].style.display = "none";
        } else {
            userlist[i].style.display = "block";
        }
    }
    return false;
};

let createbtn = document.getElementById('createbtn');

if (createbtn) {
    createbtn.onclick = function(){
        var form = document.getElementById("CreateForm");
            
        if (form.style.display === "block") {
            form.style.display = "none";
        }
        return false;
    };
}
