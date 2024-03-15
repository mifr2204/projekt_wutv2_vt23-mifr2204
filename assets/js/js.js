

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

createbtn = document.getElementById('createbtn')

createbtn.onclick = function(){
    console.log("TT");
    var form = document.getElementById("CreateForm");
        
    if (form.style.display === "block") {
        form.style.display = "none";
    }
    return false;
};