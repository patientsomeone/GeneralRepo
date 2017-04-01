/*global SpreadsheetApp, ui, Logger */
var curSheet = SpreadsheetApp.getActive(),
    temSheet = curSheet.getSheetByName("Template"),
    traSheet = curSheet.getSheetByName("Transactions"),
    lisSheet = curSheet.getSheetByName("Listings"),
    cleanRow = temSheet.getRange("A2:N2")[""];
    


function addRow(count, sheet) {
    var i,
        thisSheet = (sheet || SpreadsheetApp.getActiveSheet()),
        lastRow = thisSheet.getLastRow(),
        lastCol = thisSheet.getLastColumn(),
        newRow,
        cleanRow = temSheet.getRange("A100:N100"),
        rowCount = (count || 1);
    
    thisSheet.insertRowsAfter(lastRow, rowCount);
    cleanRow.copyTo(thisSheet.getRange((lastRow + 1), 1, rowCount, lastCol));
}

function clearSold(del) {
    var i,
        delRows = (del || 0),
        deleted = 0,
        curRow,
        data = lisSheet.getDataRange().getValues(),
        lastTrans;
    
    for (i = 0; i < data.length; i += 1) {
        if (data[i][8] === "x" && data[i][9] !== "x") {
            Logger.log("Copied row " + i);
            lastTrans = traSheet.getLastRow();
            curRow = lisSheet.getRange(i + (1 - deleted), 1, 1, 13);
            curRow.copyTo(traSheet.getRange((lastTrans + 1), 1, 1, 13));
            lisSheet.deleteRow(i + (1 - deleted));
            deleted += 1;
        }
    }
    Logger.log("Adding " + delRows + " deleted rows.");
    addRow(delRows, lisSheet);
}
    
function onOpen() {
    SpreadsheetApp.getUi().createMenu("Execute").addItem("Add Row", "addRow").addItem("Process Transactions", "clearSold").addToUi();
    clearSold();
}