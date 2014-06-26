

function addRow(tableID) {
    var table = document.getElementById(tableID).getElementsByTagName("tbody")[0];
    //document.getElementById(tableID).getElementsByTagName('tbody')[0]
    var rowCount = table.rows.length;

    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    for (var i = 0; i < colCount; i++) {
        var newcell = row.insertCell(i);
        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
    }



}

function deleteRow(tableID) {
    var table = document.getElementById(tableID).getElementsByTagName("tbody")[0];
    var rowCount = table.rows.length;
    for (var i = 0; i < rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if (null != chkbox && true == chkbox.checked) {
            if (rowCount <= 1) { 						// limit the user from removing all the fields
                //alert("Cannot Remove all the Rows.");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}