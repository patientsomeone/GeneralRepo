/*global console, jQuery*/
var toBuild = {},
    leftovers = {
        "Iron Ingot": 10,
        "Copper Ingot": 50,
        "Silicon Ingot": 50,
        "Cobalt Ingot": 50
    },
    recepies = {
        initQueue: {
            "Core": 1,
            "Large Constructor": 1,
            "Small Generator": 1,
            "Small Fuel Tank": 1
        }
    },
    buildAmount,
    reqs = {
        "Core": {
            "Metal Components": 5,
            "Electronics": 4,
            "Computer": 5,
            "Cables": 3
        },
        "Large Constructor": {
            "Computer": 2,
            "Control Device": 2,
            "Electronics": 5,
            "Metal Components": 10,
            "Cables": 4,
            "Motor": 2,
            "Pipes": 4,
            "complete": 1
        },
        "Small Generator": {
            "Metal Components": 10,
            "Capacitor Device": 2,
            "Reactor Core": 1,
            "Control Device": 2,
            "Electronics": 3,
            "Computer": 2,
            "complete": 1
        },
        "Small Fuel Tank": {
            "Electronics": 4,
            "Metal Components": 4,
            "Cables": 3,
            "complete": 1
        },
        "Computer": {
            "Control Device": 1,
            "Metal Components": 2,
            "Cables": 2,
            "Electronics": 2,
            "complete": 1
        },
        "Control Device": {
            "Copper Ingot": 1,
            "Cobalt Ingot": 1,
            "Silicon Ingot": 1,
            "complete": 1
        },
        "Electronics": {
            "Copper Ingot": 1,
            "Silicon Ingot": 1,
            "complete": 2
        },
        "Metal Components": {
            "Iron Ingot": 1,
            "Cobalt Ingot": 1,
            "complete": 2
        },
        "Cables": {
            "Copper Ingot": 1,
            "complete": 2
        },
        "Motor": {
            "Metal Components": 2,
            "Cables": 3,
            "Electronics": 1,
            "complete": 1
        },
        "Pipes": {
            "Steel Plate": 2,
            "complete": 1
        },
        "Capacitor Device": {
            "Electronics": 3,
            "Cables": 3,
            "Metal Components": 5,
            "complete": 1
        },
        "Steel Plate": {
            "Iron Ingot": 5,
            "complete": 10
        },
        "Reactor Core": {
            "Motor": 1,
            "Pipes": 3,
            "Cables": 3,
            "Electronics": 3,
            "Metal Components": 10,
            "complete": 1
        },
        "Iron Ingot": {
            "Iron Ore": 5,
            "complete": 10
        },
        "Copper Ingot": {
            "Copper Ore": 5,
            "complete": 10
        },
        "Cobalt Ingot": {
            "Cobalt Ore": 5,
            "complete": 10
        },
        "Silicon Ingot": {
            "Silicon Ore": 5,
            "complete": 10
        },
        "Iron Ore": {
            "complete": 1
        },
        "Cobalt Ore": {
            "complete": 1
        },
        "Copper Ore": {
            "complete": 1
        },
        "Silicon Ore": {
            "complete": 1
        }
    };
recepies.addQueue = function (name, buildCount, output) {
    "use strict";
    var k;
    if (buildCount < output) {
        if (leftovers.hasOwnProperty[name]) {
            if (leftovers[name] > buildCount) {
                leftovers[name] = leftovers[name] - buildCount;
            } else {
                buildCount = buildCount - leftovers[name];
            }
//            recepies.addQueue(name, buildCount, output);
        } else {
            leftovers[name] = output - buildCount;
        }
    }
  
    buildAmount = Math.ceil((output / buildCount) * buildCount);
    
    for (k in reqs[name]) {
        if (reqs[name].hasOwnProperty(k) && k !== "complete") {
            if (!reqs[k]) {
                console.log("Record " + k +  " not found");
            } else if (!reqs[k].hasOwnProperty("complete")) {
                console.log("Output count for " + k +  " not found");
            } else {
                recepies.addQueue(k, reqs[name][k], reqs[k].complete);
            }
        }
    }
    toBuild[name] = (toBuild[name] ? (toBuild[name] + buildAmount) : 1);
    
};

recepies.queue = function (toQueue) {
    "use strict";
    var i;
        
    for (i in toQueue) {
        if (toQueue.hasOwnProperty(i) && i !== "complete") {
            console.log("Queing up " + i);
            recepies.addQueue(i, toQueue[i], reqs[i].complete);
        }
    }
        
};

recepies.write = function (toWrite) {
    "use strict";
    var j;
    for (j in toWrite) {
        if (toWrite.hasOwnProperty(j)) {
            jQuery("#calculator").append("<div>" + j + ": " + toWrite[j] + "</div>");
        }
    }
};

recepies.queue(recepies.initQueue);
recepies.write(toBuild);