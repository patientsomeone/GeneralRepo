var sheet = SpreadsheetApp.getActiveSpreadsheet(),
    toSee = sheet.getSheetByName("To See"),
    pass = sheet.getSheetByName("Passed");

function onOpen() {
    var ui = SpreadsheetApp.getUi();
    ui.createMenu("Houses").addItem("Tranfer", "transferPassed").addToUi();
}

function transferPassed() {
    var i,
        passRow,
        passList = toSee.getRange("I3:I100").getValues(),
        passTerms = ["x", "y", "yes", "pass", "*"],
        thisPass;
    while (passList[i][0] !== "") {
        thisPass = passList[i][0];
        if (passTerms.indexOf(thisPass) >= 0) {
            toSee.getRange(i, 1, 1, 9).copyTo(pass);
            toSee.deleteRow(i);
        }
    }
}


		Yellow House		https://www.ziprealty.com/property/22005-LOCUST-PL-LYNNWOOD-WA-98036/75117958/detail?utm_source=ziprealtyapp&utm_medium=mobileapp&utm_campaign=seeonwebsite			testing Pass Functionality	