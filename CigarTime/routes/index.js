var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Cigar Time' });
});

/*GET UserList*/
router.get('/userlist', function(req, res) {
    var db = req.db;
    var collection = db.get('usercollection');
    collection.find({},{},function(e,docs){
        res.render('userlist', {
            title: "User List",
            "userlist" : docs
        });
    });
});


/*Get New User page*/
router.get('/newuser', function(req, res) {
    res.render('newuser', {title: 'Add New User'});
});

/*POST to Add User page*/
router.post('/adduser', function(req, res) {
    
    //set internal DB 
    var db = req.db;
    
    //Get form values, rely on "name" attribute
    var userName = req.body.username;
    var userEmail = req.body.useremail;
    
    //Define collection
    var collection = db.get('usercollection')
    
    //Submit to the DB
    collection.insert({
        "username" : userName,
        "email" : userEmail
    }, function (err, doc) {
        if (err) {
            //if it failed, return error
            res.send("There was a problem adding information");
        }
        else {
            //Forward to Success page
            res.redirect("userlist");
        }
    });
});

//Get Cigar List
router.get('/humidor', function(req, res) {
    var db = req.db,
        collection = db.get('humidor');
    collection.find({}, {}, function(e, docs) {
        res.render('humidor', {
            title: "Humidor",
            "humidor": docs
        });
    });
});

/* Get to Add Cigar Page */
router.get('/addcigar', function(req, res) {
    res.render('addcigar', {title: 'Add a Cigar'});
});

// POST to Add Cigar Page
router.post('/addcigar', function(req, res) {
    // Set our Internal DB Variable
    var db = req.db,
        
    // Get our form values (rely on "name" attribute)
        cigarName = req.body.cigarName,
        datePurchased = req.body.datePurchased,
        amountPaid = req.body.amountPaid,
        quantity = req.body.quantity,
        eachCost = (Math.round((amountPaid / quantity) * 10) / 10).toFixed(2),
        fiveCost = eachCost * 5,
        boxCost = eachCost * 20,
    
    // Set DB Collection
        collection = db.get('humidor');
    
    // Submit to DB
    collection.insert({
        "cigarName": cigarName,
        "datePurchased": datePurchased,
        "amountPaid": amountPaid,
        "quantity": quantity,
        "eachCost": eachCost,
        "fiveCost": fiveCost,
        "boxCost": boxCost
    }, function (err, doc) {
        if (err) {
            // If submit failed, return error
            res.send("There was a problem submitting to the Database");
        } else {
            // Onward to success
            res.redirect("humidor");
        };
    });
});

module.exports = router;
