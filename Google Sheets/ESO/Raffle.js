/*global SpreadsheetApp, Logger */
/*eslint strict: 0*/
var curSheet = function () {return SpreadsheetApp.getActive(); },
    rawInput = function () {return curSheet().getSheetByName("rawInput"); },
    rawHistory = function () {return curSheet().getSheetByName("rawHistory"); },
    tickList = function () {return curSheet().getSheetByName("Current Tickets"); },
    lastProc = function () {return rawHistory().getRange("B2").getValue(); };




function procHist(updateInput) {
    var i,
        ri = rawInput(),
        rh = rawHistory(),
        curLength = ri.getLastRow(),
        curCol = ri.getLastColumn(),
        curHist = rh.getDataRange().getValues(),
        inSort,
        newIn = [],
        newHist = [],
        curIn = ri.getDataRange().getValues(),
        parseDate = function (date) {return new Date(date.replace(/-/g, "/").replace(/[TZ]/g, " ")); },
        inDate = parseDate(curIn[(curIn.length - 1)][1]),
        hisDate = (curHist.length > 1 ? parseDate(curHist[1][1]) : "");
//    Logger.log("Newest History Date2: " + curHist[1][1]);
//    Logger.log("Oldest In Date2: " + curIn[(curIn.length - 1)][1]);
//    Logger.log("inDate: " + inDate);
//    Logger.log("hisDate: " + hisDate);

    function sortDates(a, b) {
        var aD = new Date(a[1].replace(/-/g, "/").replace(/[TZ]/g, " ")),
            bD = new Date(b[1].replace(/-/g, "/").replace(/[TZ]/g, " "));
//        Logger.log(aD);
//        Logger.log(aD - bD);
        return aD - bD;
    }

    if (updateInput) {
        for (i = (curIn.length - 1); i > 0; i -= 1) {
//            Logger.log((parseDate(curIn[i][1]) > hisDate ? "newer" : "older"));
            if ((hisDate === "" || parseDate(curIn[i][1]) > hisDate)) {
                newIn.push(curIn[i]);
            }
        }
        inSort = newIn.sort(sortDates);
//        ri.getRange("A2").offset(0, 0, curLength, curCol).clearContent();
        ri.deleteRows(2, curLength);
//        Logger.log("Columns: " + newIn[0].length);
        if (inSort.length > 0) {
            Logger.log("Applying sort");
            ri.getRange("A2").offset(0, 0, inSort.length, inSort[0].length).breakApart();
            ri.getRange("A2").offset(0, 0, inSort.length, inSort[0].length).setValues(inSort);
            Logger.log("sorted");
        } else {
            Logger.log("No new input to apply");
            Logger.log(newIn);
        }
    } else {
//        Logger.log("Input Length: " + curIn.length + " | " + curLength);
//        Logger.log("history Length: " + curHist.length);
        newHist = newHist.concat(curHist.splice(1, curHist.length));

        if (newIn.length === 0) {
            newIn = curIn;
            Logger.log("Proccessed new input");
        }

        for (i = (newIn.length - 1); i > 0; i -= 1) {
            newHist.unshift(newIn[i]);
        }

        ri.deleteRows(2, curLength);
//        ri.getRange("A2").offset(0, 0, curLength, curCol).clearContent();

//        Logger.log("New history Length: " + newHist.length);
        rh.getRange("A2").offset(0, 0, newHist.length, newHist[0].length).setValues(newHist);
    }
}

function shuffleTicks(reset, select) {
    var i, j,
        tl = tickList(),
        thisUn,
        thisTc,
        multiplied = [],
        shuffled,
        lastTickR = tl.getLastRow(),
        tickRange = tl.getRange("A2:B" + lastTickR).getValues(),
        shuffRange = tl.getRange("D2:D" + lastTickR).getValues(),
        curWinners;

    function shuffle(array) {
        var currentIndex = array.length, temporaryValue, randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {

            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            // And swap it with the current element.
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    }

//    Logger.log(tickRange);
    if (reset) {
        for (i = 0; i < shuffRange.length; i += 1) {
            if (shuffRange[i] === "") {
                lastTickR = i;
            }
        }
//        Logger.log(tl.getRange("D2").offset(0, 0, (lastTickR - 1)).getValues());
        tl.getRange("C2").offset(0, 0, (lastTickR - 1), 2).clearContent();
    } else if (select) {
        for (i = 0; i < shuffRange.length; i += 1) {
            if (shuffRange[i] === "") {
                lastTickR = (i + 1);
            }
        }
        for (i = 1; i <= 3; i += 1) {
            shuffled = (Math.random() * (lastTickR - 1) + 1);
            tl.getRange("C2").offset((shuffled - 1), 0).setValue(i);
        }
    } else {
        for (i = 0; i < tickRange.length; i += 1) {
            thisUn = tickRange[i][0];
            if (thisUn !== "") {
                thisTc = tickRange[i][1];
                for (j = 0; j <= thisTc; j += 1) {
                    multiplied.push([thisUn]);
                }
            }
        }

        shuffled = shuffle(multiplied);

        tl.getRange("D2").offset(0, 0, shuffled.length, shuffled[0].length).setValues(shuffled);
//        Logger.log(multiplied);
//        Logger.log(shuffled);
    }

}

function procTicks(callback) {
    var i, j,
        tickCost = 1000,
        pool = (1 / 2),
        restricts = ["@elrine", "@dipjyoti", "@patientsomeone"],
        un,
        trans,
        gold,
        item,
        itemCount,
        value,
        addTicks,
        curCount,
        ri = rawInput(),
        lastInR = ri.getLastRow(),
        lastInC = ri.getLastColumn(),
        data = ri.getDataRange().getValues(),
        curIn = ri.getRange("B2:I" + lastInR),
        tl = tickList(),
        tickRange = function (range) { return tl.getRange(range); },
        curTickLC = tl.getLastColumn(),
        curTickLR = tl.getLastRow(),
        curTick = tickRange("A2:B" + (curTickLC + 2)).getValues(),
        potCell = tl.getRange("F1"),
        totCell = tl.getRange("G1"),
        totalTicks,
        unMap = {},
        addedRow = 2;

    if (typeof callback === "boolean" && callback) {
        tl.getRange("A2").offset(0, 0, curTickLR, 4).clearContent();
        potCell.setValue(0);
        totCell.setValue(0);
    } else {
        procHist(true);
        Logger.log("Processed History");
        data = ri.getDataRange().getValues();

        for (i = 1; i < data.length; i += 1) {
            un = data[i][3];
            gold = data[i][4];
            trans = data[i][2];
            itemCount = data[i][5];
            item = data[i][6];
            value = (data[i][8] * itemCount);

            Logger.log(data[i]);
            Logger.log(gold);
            Logger.log(trans.slice(0, 3));
            Logger.log(restricts.indexOf(un.toLowerCase()));
            Logger.log(gold > tickCost);
            if (trans.slice(0, 3) === "dep" && restricts.indexOf(un.toLowerCase()) < 0 && gold >= tickCost) {
                Logger.log(totalTicks);
//                totalTicks = (parseInt(totCell.getValues(), 10) + ((Math.floor(gold / tickCost) * tickCost)));
//                Logger.log("Total cell: " + (parseInt(totCell.getValues(), 10)));
//                Logger.log("Total Tickets: " + parseInt((totalTicks / pool), 10));
//                Logger.log("Total Ticks: (" + gold + " / " + tickCost + " = " + (Math.floor(gold / tickCost)) + ") * " + tickCost + " * " + pool + " = " + totalTicks);
                addTicks = Math.floor(Math.min(gold, 20000) / tickCost);
                totalTicks = (parseInt(totCell.getValues(), 10) + (parseInt(Math.floor(gold / tickCost), 10) * parseInt(tickCost, 10)));
                Logger.log("Values " + parseInt(totCell.getValues(), 10));
                Logger.log("Gold " + gold + " / Ticket Cost " + tickCost);
                Logger.log("Gold / ticketCost " + Math.floor(gold / tickCost));
                Logger.log("Total Income " + (parseInt(totCell.getValues(), 10) + (parseInt(Math.floor(gold / tickCost), 10) * parseInt(tickCost, 10))));
                potCell.setValue(parseInt((totalTicks * pool), 10));
                totCell.setValue(totalTicks);
                Logger.log(un + " | " + gold + " | " + addTicks);
                if (unMap.hasOwnProperty(un.toLowerCase())) {
                    // Add one to row
//                    Logger.log("User name MAPPED " + un.toLowerCase() + " " + unMap[un.toLowerCase()]);
                    curCount = tickRange("B" + unMap[un.toLowerCase()]).getValue();
                    if (curCount < 20) {
//                        Logger.log("Adding: " + Math.max(curCount + addTicks, 20));
                        tickRange("B" + unMap[un.toLowerCase()]).setValue(Math.max(curCount + addTicks, 20));
                    }
                } else {
                    // Loop through user names
                    for (j = 0; j < curTickLC; j += 1) {
//                        Logger.log(un.toLowerCase() + " | " + curTick[j][0].toLowerCase());
                        unMap[un.toLowerCase().toLowerCase()] = j + 2;
                        if (un.toLowerCase() === curTick[j][0].toLowerCase()) {
//                            Logger.log("Row: " + (j + 2));
//                            Logger.log("User name match " + un.toLowerCase() + " " + curTick[j][0].toLowerCase());
                            curCount = tickRange("B" + (j + 2)).getValue();
                            if (curCount < 20) {
                                tickRange("B" + (j + 2)).setValue(Math.min(curCount + addTicks, 20));
                            } else {
                                Logger.log(un + " already has 20 tickets");
                            }
                            break;
                        } else if (!curTick[j][0].toLowerCase()) {
//                            Logger.log("Row: " + (j + addedRow));
//                            Logger.log("NO MATCH " + un.toLowerCase() + " " + curTick[j][0].toLowerCase());
                            tickRange("A" + (j + addedRow)).setValue(un);
                            tickRange("B" + (j + addedRow)).setValue(addTicks);
                            addedRow += 1;
                            break;
                        }
                    }
                }
                totalTicks = 0;
            }
        }
        if (typeof callback === "function") {
            callback();
        }

        procHist();
    }
}

function updateInput() {
    procHist(true);
}


function resetTicks() {
    procTicks(true);
}

function resetShuffle() {
    shuffleTicks(true);
}

function resetAll() {
    procTicks(true);
    shuffleTicks(true);
}

function selectWinner() {
    shuffleTicks(false, true);
}

function onOpen() {
    SpreadsheetApp.getUi().createMenu("Execute").addItem("Process Tickets", "procTicks").addItem("Shuffle", "shuffleTicks").addItem("Winner", "selectWinner").addItem("Reset All", "resetAll").addItem("Reset Tickets", "resetTicks").addItem("Reset Shuffle", "resetShuffle").addToUi();
}
