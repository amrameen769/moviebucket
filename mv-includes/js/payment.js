function selectSeat(){
    let seats = document.getElementsByName('seat');
    let selected_seats = [];
    for(let i = 0; i<seats.length; i++){
        if(seats[i].type=='checkbox' && seats[i].checked == true){
            selected_seats.push(seats[i].id);
        }
    }
    alert(selected_seats);
    let jsonArray = JSON.stringify(selected_seats);
    $.ajax({
        type: "POST",
        url: "https://moviebucket.com/mv-enduser/includes/book-seats.php",
        data: { data: jsonArray},
        cache: false,

        success: function (response) {
            document.getElementById('confirm-book').innerHTML = response;
        }
    });
}
let total_cost = 0;
function addpay(id,shw_cost) {
    if($("#"+id).prop("checked") == true){
        total_cost += parseFloat(shw_cost);
    }
    if($("#"+id).prop("checked") == false){
        total_cost -= parseFloat(shw_cost);
    }
    document.getElementById('pay').innerText = "Pay " + total_cost;
}