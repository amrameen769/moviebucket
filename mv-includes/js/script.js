//Go Back Function
function goBack() {
    window.history.back();
}

function showScreen(screenid) {
    if(screenid.length == 0){
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("edit-screens").innerHTML = this.responseText;
        }
    }
    xhttp.open("POST","https://moviebucket.com/mv-theater/edit-screens.php?screenid=" + screenid,true);
    xhttp.send();
}

function loadDoc(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("book-page").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "book-movie.php?t=" + str, true);
    xhttp.send();
}

function loadShow(mv_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("book-page").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET","book-show.php?mvid=" + mv_id,true);
    xhttp.send();
}

function initializeScreen(sid) {

}