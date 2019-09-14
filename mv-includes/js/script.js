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
    xhttp.open("POST", "book-movie.php?t=" + str, true);
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


/*document.getElementById('1').addEventListener("click", function () {
    init(this.id);
});*/


/*function init(sid) {
    var screenid = "name-" + sid;
    var seatid = "seat-" + sid;
    var screen = $("#" + screenid).val();
    var seat = $("#" + seatid).val();
    var xhr = new XMLHttpRequest();
    xhr.open('POST','https://moviebucket.com/mv-theater/add-screens.php', true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    let details = "screen_name="+screen+"&seat_number="+seat;
    xhr.onload = function() {
        if(this.readyState == 4){
            document.getElementById('settings').innerHTML = this.responseText;
        }
    }
    xhr.send(details);
}*/

function init(sid) {
    //alert(sid);
    var screenid = sid;
    var seatid = "seat-" + sid;
    var screen = $("input[name=screen-name][id="+sid+"]").val();
    var seat = $("#" + seatid).val();
        $.post('https://moviebucket.com/mv-theater/add-screens.php', {
                screen_name: screen,
                seat_number: seat,
                sid : sid
            },
            function (response) {
                document.getElementById('settings').innerHTML = response;
            });
}

function bookSeats(shw_id){
    $.post("https://moviebucket.com/mv-enduser/includes/select-seats.php",
        {
            shw_id: shw_id
        },
        function(response){
            document.getElementById("book-page").innerHTML = response;
        });
}


