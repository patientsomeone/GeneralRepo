/*global SpreadsheetApp, Logger */
/*eslint strict: 0*/
var curSheet = function () {return SpreadsheetApp.getActive(); },
    rawInput = function () {return curSheet().getSheetByName("rawInput"); },
    rawHistory = function () {return curSheet().getSheetByName("rawHistory"); },
    tickList = function () {return curSheet().getSheetByName("Current Tickets"); },
    currentTickets;

    function sortDates (a, b) {
        var aD = new Date(a[1].replace(/-/g, "/").replace(/[TZ]/g, " ")),
        bD = new Date(b[1].replace(/-/g, "/").replace(/[TZ]/g, " "));
        /*Logger.log(aD);
        Logger.log(a + " - " + b + " = " );
        Logger.log(aD - bD);*/
        return aD - bD;
    }
    function RevDates (a, b) {
        var aD = new Date(a[1].replace(/-/g, "/").replace(/[TZ]/g, " ")),
        bD = new Date(b[1].replace(/-/g, "/").replace(/[TZ]/g, " "));
        /*Logger.log(aD);
        Logger.log(b + " - " + a + " = " );
        Logger.log(aD - bD);*/
        return bD - aD;
    }

function readTickets () {
    /* Process current ticket list as global array (currentTickets) */
}

function initProc () {
    var i,
        tickCost = 1000,
        pool = (1/2),
        restricted = ["@elrine", "@dipjyoti", "@patientsomeone"],
        curData,
        curTick,
        curUser,
        curGold,
        curTrans,
        ri = rawInput(),
        rh = rawHistory(),
        inData = ri.getRange("A2").offset(0, 0, ri.getLastRow(), ri.getLastColumn()).getValues().sort(sortDates),
        histData = rh.getRange("A2").offset(0, 0, rh.getLastRow(), rh.getLastColumn()).getValues().sort(RevDates),
        curDate,
        lastHist = new Date(histData[1][1].replace(/-/g, "/").replace(/[TZ]/g, " "));

    readTickets();

    for (i = 1; i < inData.length - 1; i += 1) {
        curData = inData[i];
        curDate = new Date(curData[1].replace(/-/g, "/").replace(/[TZ]/g, " "));
        curUser = curData[3];
        curGold = curData[4];
        curTrans = (((/dep_/).test(curData[2]) ? "deposit" : "withdraw") + ((/_gold/).test(curData[2]) ? "Gold" : "Item"));
        Logger.log(curUser + ": " + curTrans + " " + curGold);
        /* Log whether this is newer or older than last historical entry */
        /*Logger.log("Last History: " + lastHist + " Current date: " + curDate + " | Is " + (curDate > lastHist ? "newer" : "older"));*/

        /* Process individual tickets */
        if (curTrans === "depositGold" && curDate > lastHist) {
            indTicks({
                "user": curUser,
                "gold": curGold,
                "row": curData
            })
        }

        /* Add row to top of histData */

    }

    /*Replace history sheet with histData*/

    /*Clear all rows of Input*/
}

function indTicks (data) {
    var proccing = {},
        procced;
    /* data = {
        "user": initProc().curUser,
        "gold": initProc().curGold,
        "row": initProc().curData
    } */
    /* Log Processessing*/
    /*Logger.log("Processessing " + data.user + " " + data.gold);*/

    /* Store Key/Value UserName/Ticket as object (proccing)*/

    /* Convert proccing Object to array (procced) */

    /* Inject procced into Ticket Holder list */
}

/*eslint-disable*/
function testFire () {

}
/*eslint-enable*/


/*eslint-disable*/
function onOpen() {
    SpreadsheetApp.getUi().createMenu("Execute").addItem("Process Tickets", "procTicks").addItem("Shuffle", "shuffleTicks").addItem("Winner", "selectWinner").addItem("Reset All", "resetAll").addItem("Reset Tickets", "resetTicks").addItem("Reset Shuffle", "resetShuffle").addToUi();
}
/*eslint-disable*/
