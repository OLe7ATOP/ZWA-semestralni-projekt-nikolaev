function checkpass(){
    var pass = document.getElementById("password").value;
    var pass_check = document.getElementById("reppassword").value;
    var result = document.getElementById("passcheck");
    if(pass !== pass_check) {
        result.textContent = "Passwords are not the same!";
        result.style.color = "red";
    } else {
        result.textContent = "Passwords are equal";
        result.style.color = "green";
    }
}


function closeMessage(button){
    const messageBox = button.parentElement;
    messageBox.style.display = 'none';
}


function displayname(obj) {
    const fileName = obj.files[0] ? obj.files[0].name : "Load Image";
    obj.textContent = fileName;
    document.getElementById("userphoto").value = fileName;
}