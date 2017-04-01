/*global SpreadsheetApp, ui, Logger */
var curSheet = function () {return SpreadsheetApp.getActive(); },
    duelMan = function () { return curSheet().getSheetByName("Duel Management"); },
    dm = duelMan(),
    duelStart = 3,
    endEnt = function () {
        var j,
            lastRow;
        Logger.log(dm.getLastRow());
        for (j = duelStart; j <= dm.getLastRow(); j += 1) {
//                Logger.log("Row " + j + ": " + dm.getRange("A" + j).getValue());
            if (dm.getRange("A" + j).getValue() === "") {
                return j;
            } else if (j === dm.getLastRow()) {
                return j;
            }
        }
    };

function ProcEnt() {
    var i,
        thisEnt,
        touchedFont = "#cccccc",
        thisFont,
        thisArr,
        thisUser,
        thisLvl;
        
//    Logger.log("Last entrant is " + endEnt());
    
    for (i = duelStart; i <= endEnt(); i += 1) {
        thisEnt = dm.getRange("A" + i).offset(0, 0, 1, 2);
        thisArr = thisEnt.getValues();
        thisUser = thisArr[0][0];
        thisLvl = thisArr[0][1];
        thisFont = thisEnt.getFontColors()[0][0];
//        Logger.log(thisArr);
        Logger.log(thisFont);
        if (thisFont !== touchedFont) {
            Logger.log(thisUser + " is not touched");
//            Logger.log(thisUser + " is level " + thisLvl + " " + typeof thisLvl);
            if ((typeof thisLvl === "string" && thisLvl.indexOf("cp") >= 0) || (thisLvl > 50)) {
                Logger.log(thisUser + " is over 50");
            } else {
                Logger.log(thisUser + " is under 50");
            }
        }
    }
}



function onOpen() {
    SpreadsheetApp.getUi().createMenu("Execute").addItem("Add Row", "addRow").addToUi();
}