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
    const fileInput = document.getElementById('img');
    const fileName = fileInput.files[0]?.name;
    const fileNameDisplay = document.getElementById('loadedimage');

    // Если файл выбран, показываем его имя
    if (fileName) {
        fileNameDisplay.textContent = "Selected file: " + fileName;
    } else {
        fileNameDisplay.textContent = "No file selected";
    }
}

class Info{
    dow;
    time;
    trainerid;

    constructor(dow, time, trainerid) {
        this.dow = dow
        this.time = time
        this.trainerid = trainerid
    }
}

function deletetraining(dow, time, trainerid) {
    const html = new XMLHttpRequest()
    html.onload = ()    => {
        if(html.status >=200 && html.status <300) {
            const response = JSON.parse(html.responseText)
            console.log(response)
        }
    }

    new User()
    const info = new Info(dow, time, trainerid);

    html.open('POST', 'delete_training.php')
    html.setRequestHeader('Content-Type', 'application/json')
    html.send(JSON.stringify(info))
    html.send('GET','userpage.php')
}



