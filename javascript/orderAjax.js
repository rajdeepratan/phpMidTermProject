function searchOrders() {
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.onreadystatechange = function () {
        console.log('Ready State is now: ' + ajaxRequest.readyState);

        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            document.getElementById('order-table').innerHTML =
                ajaxRequest.responseText;
        }
    };

    ajaxRequest.open('POST', 'displayOrderList.php');

    ajaxRequest.setRequestHeader(
        'Content-Type',
        'application/x-www-form-urlencoded'
    );

    var date = document.getElementById('date').value;

    ajaxRequest.send('date=' + date);
}
