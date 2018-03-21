
'use strict';

// // =================================================================
// get the packages we need ========================================
// =================================================================

var jwt = require('jsonwebtoken'),
    Util = require('../../util/custom_functions'),
	common = require('../../util/common'),
    bodyParser = require('body-parser'),
    moment = require('moment'),
    fs = require('fs'),
    forEach = require('async-foreach').forEach,
    _ = require('lodash'),
    expressValidator = require('express-validator'),
    //taking a instance of Util class
    Util = new Util(),
    config = require('../../config/config'),
    bcrypt = require('bcrypt'),
    md5 = require('md5'),
    nodemailer = require('nodemailer');

    var salt = bcrypt.genSaltSync(10);


//tracer
var logger = require('tracer').colorConsole({
    format: [
        '{{timestamp}} (in line: {{line}}) >> {{message}}', //default format
        {
            error: '{{timestamp}} <{{title}}> {{message}} (in {{file}}:{{line}})\nCall Stack:\n{{stack}}' // error format
        }
    ],
    dateformat: 'HH:MM:ss.L',
    preprocess: function(data) {
        data.title = data.title.toUpperCase();
    }
});


// =================================================================
// Export API V1================================================
// =================================================================
module.exports = function(app, express, client) {
    var api = express.Router();
    app.use(expressValidator());
    app.use(bodyParser.json({
        limit: "50mb",
        type: 'application/json'
    }));
    app.use(bodyParser.urlencoded({
        extended: true,
        limit: '50mb'
    }));

    // ---------------------------------------------------------
    // route not need to check access token
    // ---------------------------------------------------------   

    api.get('/', function(req, res) {
        Util.makeResponse(res, true, 200, 'Welcome to the coolest API on earth!', '1.0.0', [])
    });


    /***************************************************************************************************************************************************************/
    /************************************************************************ /check ************************************************************************/
    /**
     * @api {get} /check check
     * @apiDescription http://54.172.221.76:10005/api/v1/check
     * @apiGroup Test
     * @apiName check
     * ***************************************************************************************************************************************************************
     
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * ***************************************************************************************************************************************************************
     * @apiVersion 1.0.0
     */

    api.get('/check', function(req, res) {
         sendMail('rajan@techaheadcorp.com','test','test');
        Util.makeResponse(res, true, 200, 'Welcome to the coolest API on earth!', '1.0.0', []);
    });




    /***************************************************************************************************************************************************************/
    /************************************************************************ /signUp ************************************************************************/
    /**
     * @api {post} /signUp signUp
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/signUp
     * @apiGroup User
     * @apiName signUp
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      email                Email string
     * @apiParam (Expected parameters) {String}      name                 First Name string
     * @apiParam (Expected parameters) {String}      password             password string
     * @apiParam (Expected parameters) {String}      phone                phone as a string
     * @apiParam (Expected parameters) {String}      deviceToken          device token string
     * @apiParam (Expected parameters) {String}      deviceType           device type 0=android,1=IOs it would be also a string
     
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * ***************************************************************************************************************************************************************
     * @apiVersion 1.0.0
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"Success":true,"Status":200,"Message":"Sign Up Successfully","AppVersion":"1.0.0","Result":[{"userId":1,"token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUmFqYW4gTWlkZGhhIiwiZW1haWwiOiJyYWphbm1pZGRAZ21haWwuY29tIiwicGhvbmUiOiI5ODc2NTQzMjE0IiwiaWF0IjoxNTE5NDY0MjI1LCJleHAiOjE1MTk1NTA2MjV9.JrDBUhww0DTpC_Nzfi_3PEmuFqkXWKaDaL9I7IhkATk","otp":"9923","expiresIn":86400}]}
     * 
     **/

    api.post('/signUp', function(req, res) {
        var schema = {
            'email': {
                notEmpty: true,
                isEmail: {
                    errorMessage: 'Invalid Email format'
                }
            },
            'password': {
                notEmpty: true,
                errorMessage: 'Invalid Password' // Error message for the parameter 
            },
            'name': {
                notEmpty: true,
                errorMessage: 'Invalid firstName' // Error message for the parameter 
            },
            'phone': {
                notEmpty: true,
                errorMessage: 'Invalid phone' // Error message for the parameter 
            }
        };
        req.checkBody(schema);
        req.asyncValidationErrors().then(function() {
            // all good here 
            var data = req.body;
			console.log(data);
            var name = data.name;
            var email = data.email;
            var password = data.password;
            var phone = data.phone;
            var device_token = data.deviceToken || "";
            var device_type = data.deviceType || 1;
            client.query("select * from tbl_users where phone=? or email=?", [phone,email], function(error, result, fields) {
                if (error) {
					console.log(error);
                    Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                } 
                else if (phone === "" || password === "") {
                    Util.makeResponse(res, false, 500, "Phone or Password cannot be empty", '1.0.0', []);
                }
                else if (result.length > 0) {
                    Util.makeResponse(res, false, 200, "Sorry, phone or email is alread exists. Please try with different email.", '1.0.0', []);
                } else {
                    var pass= bcrypt.hashSync(password, salt);
                    var regFields = {
                        'name': name,
                        'email': email,
                        'phone': phone,
                        'password': pass,
                        'status': '1',
                        'device_token': device_token || "",
                        'device_type': device_type || 1,
                        'created_at': moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
                        'remember_token': (md5(Math.floor((Math.random() * 10000000000) + 1), 'hex')).toString()
                    };
                    var token_keys = {
                        'name': name,
                        'email': email,
                        'phone': phone,
                    };

                    var token = jwt.sign(token_keys, app.get('superSecret'), {
                        expiresIn: 86400 // expires in 24 hours
                    });

                    client.query("INSERT INTO tbl_users SET ?", regFields, function(error1, result1, fields1) {
                        if(error1)
                        {
							console.log(error1);
                           Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                        } 
                        else
                        {
                            var otpFields = {
                                'user_id': result1.insertId,
                                'otp': randomString(4),
                                'created_at': moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
                                'status': '1',
                            };
                            client.query("INSERT INTO tbl_otp SET ?", otpFields, function(error2, result2, fields2) {
                                if(error2)
                                {
									console.log(error2);
                                   Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                                } 
                                else
                                {
                                    //send mail 
                                    var res2 = sendMail(email,'Congratulations! You have successfully registered','Hi '+name+' , You have successfully registered with us.<br/><br/>Thanks<br/>Go-Week Team');
                                    var response = [{
                                        "userId": result1.insertId,
                                        "token": token,
                                        "otp":otpFields.otp,
                                        "expiresIn": 86400
                                    }];
                                    Util.makeResponse(res, true, 200, "Sign Up Successfully", '1.0.0', response);
                                }
                            });
                        }
                    });
                }
            });

        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
    
    /***************************************************************************************************************************************************************/
    /************************************************************************ /verifyOtp ************************************************************************/
    /**
     * @api {post} /verifyOtp verifyOtp
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/verifyOtp
     * @apiGroup OTP
     * @apiName verifyOtp
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      otp                   Otp string
     * @apiParam (Expected parameters) {String}      userId                UserId string
     * 
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * ***************************************************************************************************************************************************************
     * @apiVersion 1.0.0
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"Success":true,"Status":200,"Message":"Login Successfully","AppVersion":"1.0.0","Result":{"userId":1,"name":"Rajan Middha","phone":9876543214,"deviceToken":"sdfsdfsd","deviceType":"1","email":"rajanmidd@gmail.com","token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUmFqYW4gTWlkZGhhIiwicGhvbmUiOjk4NzY1NDMyMTQsImVtYWlsIjoicmFqYW5taWRkQGdtYWlsLmNvbSIsImlhdCI6MTUxOTQ3MDIyNywiZXhwIjoxNTE5NTU2NjI3fQ.IAhGIADDavVA0NEll-PU-g0H_AxHuoFycP6BzAVU7ic","otp":"6712","expiresIn":86400}}
     * 
    **/

    api.post('/verifyOtp', function(req, res) {
        var schema = {
            'userId': {
                notEmpty: true,
                errorMessage: 'Invalid Userid' // Error message for the parameter 
            },
            'otp': {
                notEmpty: true,
                errorMessage: 'Invalid otp' // Error message for the parameter 
            }
        };
        req.checkBody(schema);
        req.asyncValidationErrors().then(function() {
            // all good here 
           
            var data = req.body;
            client.query("select * from tbl_users where id=?", [data.userId], function(error, result, fields) {
                if (error) 
                {
                    Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', {});
                } 
                else if (result.length==0) 
                {
                    Util.makeResponse(res, false, 200, "Sorry, user not found", '1.0.0', {});
                }
                else
                {
                    client.query("select * from tbl_otp where user_id=? and otp=?", [data.userId,data.otp], function(error1, result1, fields1) {
                        if (error1) 
                        {
                            Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', {});
                        } 
                        else if (result1.length==0) 
                        {
                            Util.makeResponse(res, false, 200, "Sorry, Otp not found", '1.0.0', {});
                        }
                        else if (result1[0].status==2) 
                        {
                            Util.makeResponse(res, false, 200, "Sorry, Otp has been already used.", '1.0.0', {});
                        }
                        else
                        {
                            client.query('UPDATE tbl_otp SET status = ? WHERE id = ? ', ['2', result1[0].id], function(error2, result2) {   
                                if(error2)
                                {
                                    Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', {});
                                } 
                                else
                                {
                                    Util.makeResponse(res, true, 200, "Otp has been verified successfully", '1.0.0', {});
                                }
                            });
                        }
                    });
                }
            });
        });
    });



    /***************************************************************************************************************************************************************/
    /************************************************************************ /resendOtp ************************************************************************/
    /**
     * @api {post} /resendOtp resendOtp
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/resendOtp
     * @apiGroup OTP
     * @apiName resendOtp
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      phone                 Phone string
     * @apiParam (Expected parameters) {String}      userId                UserId string
     * 
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * ***************************************************************************************************************************************************************
     * @apiVersion 1.0.0
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"Success":true,"Status":200,"Message":"New Otp Generated successfully","AppVersion":"1.0.0","Result":{"userId":"1","otp":"2576"}}
     * 
    **/

   api.post('/resendOtp', function(req, res) {
    var schema = {
        'userId': {
            notEmpty: true,
            errorMessage: 'User ID is Required' // Error message for the parameter 
        },
        'phone': {
            notEmpty: true,
            errorMessage: 'Phone ID is Required' // Error message for the parameter 
        }
    };
    req.checkBody(schema);
    req.asyncValidationErrors().then(function() {
        // all good here 
       
        var data = req.body;
        client.query("select * from tbl_users where id=?", [data.userId], function(error, result, fields) {
            if (error) 
            {
                Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', {});
            } 
            else if (result.length==0) 
            {
                Util.makeResponse(res, false, 200, "Sorry, no user found", '1.0.0', {});
            }
            else
            {
                var otpFields = {
                    'user_id': data.userId,
                    'otp': randomString(4),
                    'created_at': moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
                    'status': '1',
                };
                client.query("INSERT INTO tbl_otp SET ?", otpFields, function(error2, result2, fields2) {
                    if(error2)
                    {
                       Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                    } 
                    else
                    {                        
                        var response = {
                            "userId": data.userId,
                            "otp":otpFields.otp
                        };
                        Util.makeResponse(res, true, 200, "New Otp Generated successfully", '1.0.0', response);
                    }
                });
            }
        });
    });
});




    /***************************************************************************************************************************************************************/
    /************************************************************************ /login ************************************************************************/
    /**
     * @api {post} /login login
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/login
     * @apiGroup User
     * @apiName login
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      email                 Email string
     * @apiParam (Expected parameters) {String}      phone                 phone string
     * @apiParam (Expected parameters) {String}      loginType             Login Type string ('1'=>By Email,'2'=>By phone)
     * @apiParam (Expected parameters) {String}      password              password string
     * @apiParam (Expected parameters) {String}      deviceToken           device token string
     * @apiParam (Expected parameters) {String}      deviceType            device type 1=android,2=IOS
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * ***************************************************************************************************************************************************************
     * @apiVersion 1.0.0
     * 
     * @apiSuccessExample {json} Success-Response:
     *  {"Success":true,"Status":200,"Message":"Login Successfully","AppVersion":"1.0.0","Result":{"userId":1,"name":"Rajan Middha","phone":9876543214,"deviceToken":"sdfsdfsd","deviceType":"1","email":"rajanmidd@gmail.com","token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUmFqYW4gTWlkZGhhIiwicGhvbmUiOjk4NzY1NDMyMTQsImVtYWlsIjoicmFqYW5taWRkQGdtYWlsLmNvbSIsImlhdCI6MTUxOTQ3MDIyNywiZXhwIjoxNTE5NTU2NjI3fQ.IAhGIADDavVA0NEll-PU-g0H_AxHuoFycP6BzAVU7ic","otp":"6712","expiresIn":86400}}
     * 
    **/

    api.post('/login', function(req, res) {
        var data=req.body;
		console.log(data);
        if(data.loginType=='1')
        {
            var schema = {
                'email': {
                    notEmpty: true,
                    isEmail: {
                        errorMessage: 'Invalid Email format'
                    }
                },
                'password': {
                    notEmpty: true,
                    errorMessage: 'Invalid Password' // Error message for the parameter 
                }
            };
        }
        else{
            var schema = {
                'phone': {
                    notEmpty: true,
                    errorMessage: 'Invalid phone format'
                },
                'password': {
                    notEmpty: true,
                    errorMessage: 'Invalid Password' // Error message for the parameter 
                }
            };
        }
         
         req.checkBody(schema);
         req.asyncValidationErrors().then(function() {
            if(data.loginType=='1')
            {
                var match=data.email;
                var sql = "select * from tbl_users where email=?";
            }
            else
            {
                var match=data.phone;
                var sql = "select * from tbl_users where phone=?";
            }
            var pass= bcrypt.hashSync(data.password, salt);
            client.query(sql, [match], function(error, result, fields) {
                if (error) 
                {
                    Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                } 
                else if (result.length == 0) 
                {
                    Util.makeResponse(res, false, 200, "Sorry, no matching user found", '1.0.0', []);
                }
                else if (result[0].status == '0') 
                {
                    Util.makeResponse(res, false, 200, "Sorry, your account is not active.", '1.0.0', []);
                }
                else if(result[0].is_blocked =='2')
                {
                    Util.makeResponse(res, false, 200, "Sorry, your account has been blocked. Please contact to GO-Week Team.", '1.0.0', []);
                }           
                else if(result[0].is_deleted =='2')
                {
                    Util.makeResponse(res, false, 200, "Sorry, your account does not exists.", '1.0.0', []);
                }
                else if(data.loginType=='1') 
                {
                    if(pass == result[0].password)
                    {
                        Util.makeResponse(res, false, 200, "Password is Incorrect", '1.0.0', []);
                    }
                    else
                    {
                        client.query('UPDATE tbl_users SET device_token = ?, device_type=? WHERE id = ? ', [data.deviceToken,data.deviceType, result[0].id], function(err1, result1) {    
                            var token_keys = {
                                "name": Util.checknull(result[0].name),
                                "phone": Util.checknull(result[0].phone),
                                "email": Util.checknull(result[0].email)
                            }
    
                            var token = jwt.sign(token_keys, app.get('superSecret'), {
                                expiresIn: 86400 // expires in 24 hours
                            });
    
                            var newData = [{
                                "userId": Util.checknull(result[0].id),
                                "name": Util.checknull(result[0].name),
                                "phone": Util.checknull(result[0].phone),
                                "deviceToken": Util.checknull(data.deviceToken),
                                "deviceType": Util.checknull(data.deviceType),
                                "email": Util.checknull(result[0].email),
                                "token": token,
                                "expiresIn": 86400
                            }];    
                            Util.makeResponse(res, true, 200, "Success", '1.0.0', newData);
                        });
                    }
                }
                else
                {
                    var otpFields = {
                        'user_id': result[0].id,
                        'otp': randomString(4),
                        'created_at': moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
                        'status': '1',
                    };
                    client.query("INSERT INTO tbl_otp SET ?", otpFields, function(error2, result2, fields2) {
                        if(error2)
                        {
                           Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                        } 
                        else
                        {
                            var token_keys = {
                                "name": Util.checknull(result[0].name),
                                "phone": Util.checknull(result[0].phone),
                                "email": Util.checknull(result[0].email)
                            };
    
                            var token = jwt.sign(token_keys, app.get('superSecret'), {
                                expiresIn: 86400
                            });
    
                            var newData = {
                                "userId": Util.checknull(result[0].id),
                                "name": Util.checknull(result[0].name),
                                "phone": Util.checknull(result[0].phone),
                                "deviceToken": Util.checknull(data.deviceToken),
                                "deviceType": Util.checknull(data.deviceType),
                                "email": Util.checknull(result[0].email),
                                "token": token,
                                "otp":otpFields.otp,
                                "expiresIn": 86400
                            };
                            Util.makeResponse(res, true, 200, "Login Successfully", '1.0.0', newData);
                        }
                    });
                }
            });
         }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
         });
      });

    /***************************************************************************************************************************************************************/
   /************************************************************************ /forgotPasswordMail ************************************************************************/
   /**
      * @api {post} /forgotPassword forgotPassword
      * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
      * @apiDescription forgotPassword
      * @apiGroup User
      * @apiName forgotPassword
      * ***************************************************************************************************************************************************************
      * @apiParam (Expected parameters) {String}      email              Email Id string
      * 
      * ***************************************************************************************************************************************************************
      * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
      * @apiSuccess {Number}                Status             status code
      * @apiSuccess {String}                Message            response message string
      * @apiSuccess {String}                AppVersion         APP version
      * @apiSuccess {Object}                Result             result
      * ***************************************************************************************************************************************************************
      * @apiVersion 1.0.0
   **/
  
   api.post('/forgotPassword', function (req, res) {
      var data=req.body;
      var email=data.email;
      client.query("select * from tbl_users where email=?", [email], function (error, result, fields) {
         if(error) 
         {
             Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
         } 
         else if(result.length ==0)
         {
            Util.makeResponse(res, false, 200, "Sorry, user is not found.", '1.0.0', []);
         }
         else
         {
            var activationUrl = req.protocol + '://' + req.get('host') +'/recovery/?email='+result[0].email+'&activkey='+result[0].remember_token;
            //send mail 
            var res2=sendMail(email,'You have requested the password recovery','You have requested the password recovery. To receive a new password, please click on the link <a href="'+activationUrl+'">Click Here</a>');
            Util.makeResponse(res, true, 200, "For furthur steps please check your email.", '1.0.0',[]);
         }
      });      
   });

    // ---------------------------------------------------------
    // route middleware to authenticate and check token
    // ---------------------------------------------------------

    api.use(function(req, res, next) {
        // check header or url parameters or post parameters for token
        var token = req.param('x-goweek-token') || req.headers['x-goweek-token'];
        // decode token
        if (token) {
            // verifies secret and checks expf.
            jwt.verify(token, app.get('superSecret'), function(err, decoded) {
                if (err) {
                    //console.log(err)
                    Util.makeResponse(res, false, 401, 'Authentication failed. Invalid Token.', '1.0.0', [])
                } else {
                    // if everything is good, save to request for use in other routes
                    req.decoded = decoded;
                    next();
                }
            });
        } else {
            Util.makeResponse(res, false, 403, 'No token provided.', '1.0.0', [])
        }
    });


    // ---------------------------------------------------------
    // authenticated routes
    // ---------------------------------------------------------


    /***************************************************************************************************************************************************************/
    /************************************************************************ /activityList ************************************************************************/
    /**
     * @api {get} /activityList activityList
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/activityList 
     * @apiGroup Activity
     * @apiName activityList
     * ***************************************************************************************************************************************************************
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Activity Listing","AppVersion":"1.0.0","Result":[{"activityName":"dfgdfgfdsdfsdfsdfsdfsdf sdf dsf sdf","unityType":2},{"activityName":"sdfdfgsdfsdfsdf","unityType":0}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/activityList', function(req, res) {
        client.query("select a.id as activityId,a.name as activityName from tbl_activity as a where a.status=? order by a.id desc", ['1'], function(error, result, fields) {
            if (error) {
                Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
            }
            else
            {
                Util.makeResponse(res, true, 200, "Activity Listing", '1.0.0', result);
            }
        });  
    });
    

    /***************************************************************************************************************************************************************/
    /************************************************************************ /comboPackages ************************************************************************/
    /**
     * @api {get} /comboPackages comboPackages
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/comboPackages 
     * @apiGroup Packages
     * @apiName comboPackages
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}      page              Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * 
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Combo Packages Listing","AppVersion":"1.0.0","Result":[{"agencyName":"Rajan Middha","id":4,"name":"fgh","title":"fghfg","description":"fgh","days":3,"night":0,"campDescription":"dfgdf","location":"Shimla, Himachal Pradesh, India","price":null,"tripleSharing":45,"doubleSharing":455,"isCamping":"1"}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/comboPackages', function(req, res) {
		var data=req.query;		
		if (data.hasOwnProperty("page")) {
			var page=data.page;
		}
		else
		{
			var page=1;
		}
		var limit=10;
		if(page ==1)
		{
			var start=0;
		}
		else
		{
			var start =((page-1)*limit)
		}
		
        client.query("select b.owner_name as agencyName, a.id, a.combo_name as name, a.combo_title as title, a.combo_description as description, a.days, a.night, a.camp_description as campDescription, a.combo_location as location, a.price, a.triple_sharing as tripleSharing, a.double_sharing as doubleSharing, a.camping as isCamping from tbl_combo_packages as a left join tbl_agency as b on b.id =a.agency_id where a.status=? and a.is_deleted=? and a.is_blocked=? order by a.id desc limit "+start +","+ limit, ['1','1','1'], function(error, result, fields) {
            if (error) {
                Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
            }
            else
            {
				var comboPackages=[];
				if(result.length >0)
				{
					var j=0;
					result.forEach(function (item){
						common.getServices(client,item.id,'2').then(function(serviceRes){
							item.services=serviceRes;
							comboPackages.push(item);
							j++;							
							if(j== result.length)
							{
								comboPackages = _.sortBy(comboPackages,"id");
								Util.makeResponse(res, true, 200, "Combo Packages Listing", '1.0.0', comboPackages.reverse());
							}
						});						
					});
				}
				else
				{
					Util.makeResponse(res, true, 200, "Combo Packages Listing", '1.0.0', comboPackages);
				}               
            }
        });
    });

    /***************************************************************************************************************************************************************/
    /************************************************************************ /agencyListByComboPackages ************************************************************************/
    /**
     * @api {get} /agencyListByComboPackages agencyListByComboPackages
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/agencyListByComboPackages 
     * @apiGroup Packages
     * @apiName agencyListByComboPackages
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}      page              Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * 
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Combo Packages Listing","AppVersion":"1.0.0","Result":[{"agencyName":"Rajan Middha","id":4,"name":"fgh","title":"fghfg","description":"fgh","days":3,"night":0,"campDescription":"dfgdf","location":"Shimla, Himachal Pradesh, India","price":null,"tripleSharing":45,"doubleSharing":455,"isCamping":"1"}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/agencyListByComboPackages', function(req, res) {
		
		var data=req.query;		
		if (data.hasOwnProperty("page")) {
			var page=data.page;
		}
		else
		{
			var page=1;
		}
		var limit=10;
		if(page ==1)
		{
			var start=0;
		}
		else
		{
			var start =((page-1)*limit)
		}
		
        client.query("select b.id as agencyId, b.owner_name as agencyName, b.address as agencyAddress, a.id, a.combo_name as name, a.combo_title as title, a.combo_description as description, a.days, a.night, a.camp_description as campDescription, a.combo_location as location, FORMAT(a.price, 2) as price, FORMAT(a.triple_sharing, 2) as tripleSharing, FORMAT(a.double_sharing, 2) as doubleSharing, a.camping as isCamping from tbl_combo_packages as a left join tbl_agency as b on b.id =a.agency_id where a.status=? and a.is_deleted=? and a.is_blocked=? group by a.agency_id order by a.id desc limit "+start +","+ limit, ['1','1','1'], function(error, result, fields) {
            if (error) {
                Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
            }
            else
            {
                var comboPackages=[];
				if(result.length >0)
				{
					var j=0;
					result.forEach(function (item){
						common.getServices(client,item.id,'2').then(function(serviceRes){
							item.services=serviceRes;
							comboPackages.push(item);
							j++;							
							if(j== result.length)
							{
								comboPackages = _.sortBy(comboPackages,"id");
								Util.makeResponse(res, true, 200, "Combo Packages Listing", '1.0.0', comboPackages.reverse());
							}
						});						
					});
				}
				else
				{
					Util.makeResponse(res, true, 200, "Combo Packages Listing", '1.0.0', comboPackages);
				} 
            }
        });
    });

    /***************************************************************************************************************************************************************/
    /************************************************************************ /campingPackages ************************************************************************/
    /**
     * @api {get} /campingPackages campingPackages
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/campingPackages 
     * @apiGroup Packages
     * @apiName campingPackages
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {Integer}      page              Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Camping Packages Listing","AppVersion":"1.0.0","Result":[{"agencyName":"Rajan Middha","id":2,"name":"sdfs","title":"fsd","description":"fsdfsdf","location":"","days":3,"night":0,"tripleSharing":34,"doubleSharing":34}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/campingPackages', function(req, res) {
		var data=req.query;		
		if (data.hasOwnProperty("page")) {
			var page=data.page;
		}
		else
		{
			var page=1;
		}
		var limit=10;
		if(page ==1)
		{
			var start=0;
		}
		else
		{
			var start =((page-1)*limit)
		}
		
        client.query("select b.owner_name as agencyName, a.id,a.camping_name as name, a.camping_title as title, a.camping_description as description, a.camping_location as location, a.days, a.night, FORMAT(a.triple_sharing, 2) as tripleSharing, FORMAT(a.double_sharing, 2) as doubleSharing from tbl_camping_packages as a left join tbl_agency as b on b.id =a.agency_id where a.status=? and a.is_deleted=? and a.is_blocked=? order by a.id desc limit "+start +","+ limit, ['1','1','1'], function(error, result, fields) {
            if (error) {
                Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
            }
            else
            {
                var campingPackages=[];
				if(result.length >0)
				{
					var j=0;
					result.forEach(function (item){
						common.getServices(client,item.id,'1').then(function(serviceRes){
							item.services=serviceRes;
							campingPackages.push(item);
							j++;							
							if(j== result.length)
							{
								campingPackages = _.sortBy(campingPackages,"id");
								Util.makeResponse(res, true, 200, "Combo Packages Listing", '1.0.0', campingPackages.reverse());
							}
						});						
					});
				}
				else
				{
					Util.makeResponse(res, true, 200, "Camping Packages Listing", '1.0.0', campingPackages);
				} 
            }
        });
    });


    /***************************************************************************************************************************************************************/
    /************************************************************************ /agencyListByCampingPackages ************************************************************************/
    /**
     * @api {get} /agencyListByCampingPackages agencyListByCampingPackages
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/agencyListByCampingPackages 
     * @apiGroup Packages
     * @apiName agencyListByCampingPackages
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}      page              Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Camping Packages Listing","AppVersion":"1.0.0","Result":[{"agencyName":"Rajan Middha","id":2,"name":"sdfs","title":"fsd","description":"fsdfsdf","location":"","days":3,"night":0,"tripleSharing":34,"doubleSharing":34}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/agencyListByCampingPackages', function(req, res) {
		var data=req.query;		
		if (data.hasOwnProperty("page")) {
			var page=data.page;
		}
		else
		{
			var page=1;
		}
		var limit=10;
		if(page ==1)
		{
			var start=0;
		}
		else
		{
			var start =((page-1)*limit)
		}
		
        client.query("select b.id as agencyId, b.owner_name as agencyName, b.address as agencyAddress, a.id,a.camping_name as name, a.camping_title as title, a.camping_description as description, a.camping_location as location, a.days, a.night, FORMAT(a.triple_sharing, 2) as tripleSharing, FORMAT(a.double_sharing, 2) as doubleSharing from tbl_camping_packages as a left join tbl_agency as b on b.id =a.agency_id where a.status=? and a.is_deleted=? and a.is_blocked=? and  double_sharing = (SELECT MIN(double_sharing) FROM tbl_camping_packages c  WHERE c.agency_id = a.agency_id) group by a.agency_id order by a.id desc limit "+start +","+ limit, ['1','1','1'], function(error, result, fields) {
            if (error) {
                Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
            }
            else
            {
                var campingPackages=[];
				if(result.length >0)
				{
					var j=0;
					result.forEach(function (item){
						common.getServices(client,item.id,'1').then(function(serviceRes){
							item.services=serviceRes;
							campingPackages.push(item);
							j++;							
							if(j== result.length)
							{
								campingPackages = _.sortBy(campingPackages,"id");
								Util.makeResponse(res, true, 200, "Combo Packages Listing", '1.0.0', campingPackages.reverse());
							}
						});						
					});
				}
				else
				{
					Util.makeResponse(res, true, 200, "Camping Packages Listing", '1.0.0', campingPackages);
				} 
            }
        });
    });



    /***************************************************************************************************************************************************************/
    /************************************************************************ /listActivities ************************************************************************/
    /**
     * @api {get} /listActivities listActivities
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/listActivities 
     * @apiGroup Packages
     * @apiName listActivities
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      activityId                Activity ID string
	 * @apiParam (Expected parameters) {Integer}      page              Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Camping Packages Listing","AppVersion":"1.0.0","Result":[{"agencyName":"Rajan Middha","id":2,"name":"sdfs","title":"fsd","description":"fsdfsdf","location":"","days":3,"night":0,"tripleSharing":34,"doubleSharing":34}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/listActivities', function(req, res) {
		var page=req.query.page;	
        var schema = {
            'activityId': {
                notEmpty: true,
                errorMessage: 'Activity ID is Required'
            },
			'page': {
                notEmpty: true,
                errorMessage: 'Page Number is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
            var activityId = req.query.activityId;
            if (!activityId) {
                Util.makeResponse(res, false, 200, "Activity ID is Required", '1.0.0', []);
            } else {
				var limit=10;
				if(page ==1)
				{
					var start=0;
				}
				else
				{
					var start =((page-1)*limit)
				}
				
                client.query("select b.owner_name as agencyName, c.name as activityName, a.id, a.title, a.location, a.description, a.days, a.unit_type as unitType, a.unit_type_value as unitTypeValue, a.season, FORMAT(a.price_per_person, 2) as price, a.difficult_level as difficultLevel, a.open_time as openTime, a.close_time as closeTime from tbl_agency_activities as a left join tbl_agency as b on b.id =a.agency_id left join tbl_activity as c on c.id =a.activity_id  where a.activity_id=? and a.status=? and a.is_deleted=? and a.is_blocked=?  order by a.id desc limit "+start +","+ limit, [activityId, '1','1','1'], function(error, result, fields) {
                    if (error) 
                    {
                        Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                    }
                    else
                    {
						var activityList=[];
						if(result.length >0)
						{
							var j=0;
							result.forEach(function (item){
								var activityDetail={
									"agencyName":item.agencyName,
									"activityName":item.activityName,
									"id":item.id,
									"title":item.title,				
									"location":item.location,
									"description":item.description,
									"days":item.days,
									"unitType":item.unitType,
									"unitTypeValue":item.unitTypeValue?JSON.parse(item.unitTypeValue):{},
									"season":item.season,
									"price":item.price,
									"difficultLevel":item.difficultLevel,
									"openTime":item.openTime,
									"closeTime":item.closeTime,
								};
								activityList.push(activityDetail);
								j++;							
								if(j== result.length)
								{
									activityList = _.sortBy(activityList,"id");
									Util.makeResponse(res, true, 200, "Activity Listing", '1.0.0', activityList);
								}					
							});
						}
						else
						{
							Util.makeResponse(res, true, 200, "Activity Listing", '1.0.0', activityList);
						} 
                        
                    }
                });
            }
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });


    /***************************************************************************************************************************************************************/
    /************************************************************************ /agencyListByActivity ************************************************************************/
    /**
     * @api {get} /agencyListByActivity agencyListByActivity
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/agencyListByActivity 
     * @apiGroup Packages
     * @apiName agencyListByActivity
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      activityId                Activity ID string
	 * @apiParam (Expected parameters) {Integer}     page                      Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Camping Packages Listing","AppVersion":"1.0.0","Result":[{"agencyName":"Rajan Middha","id":2,"name":"sdfs","title":"fsd","description":"fsdfsdf","location":"","days":3,"night":0,"tripleSharing":34,"doubleSharing":34}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/agencyListByActivity', function(req, res) {
        var schema = {
            'activityId': {
                notEmpty: true,
                errorMessage: 'Activity ID is Required'
            },
			'page': {
                notEmpty: true,
                errorMessage: 'Page Number is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
            var activityId = req.query.activityId;

            if (!activityId) {
                Util.makeResponse(res, false, 200, "Activity ID is Required", '1.0.0', []);
            } else {
				var page=req.query.page;
				var limit=10;
				if(page ==1)
				{
					var start=0;
				}
				else
				{
					var start =((page-1)*limit);
				}
		
                client.query("select b.id as agencyId, b.owner_name as agencyName, b.address as agencyAddress, c.name as activityName, a.id, a.title, a.location, a.description, a.days, a.unit_type, a.unit_type_value, a.season, FORMAT(a.price_per_person, 2) as price, a.difficult_level as difficultLevel, a.open_time as openTime, a.close_time as closeTime from tbl_agency_activities as a left join tbl_agency as b on b.id =a.agency_id left join tbl_activity as c on c.id =a.activity_id  where a.activity_id=? and a.status=? and a.is_deleted=? and a.is_blocked=?  and price_per_person = (SELECT MIN(price_per_person) FROM tbl_agency_activities d WHERE d.agency_id = a.agency_id and d.activity_id="+activityId+") group by a.agency_id order by a.id desc limit "+start +","+ limit, [activityId, '1','1','1'], function(error, result, fields) {
                    if (error) 
                    {
                        Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                    }
                    else
                    {
						var activityList=[];
						if(result.length >0)
						{
							var j=0;
							result.forEach(function (item){
								
								var activityDetail={
									"agencyId":item.agencyId,
									"agencyName":item.agencyName,									
									"agencyAddress":item.agencyAddress,
									"activityName":item.activityName,
									"activityId":item.id,									
									"title":item.title,
									"location":item.location,
									"description":item.description,
									"days":item.days,
									"night":item.night,
									"unitType":item.unit_type,
									"unitTypeValue":item.unit_type_value,
									"season":item.season,
									"price":item.price,
									"difficultLevel":item.difficultLevel,
									"openTime":moment(item.openTime,'HH:mm').format('hh:mm a'),
									"closeTime":moment(item.closeTime,'HH:mm').format('hh:mm a'),
									"moreActivity":[],
								};
								common.getMoreActivityByAgency(client,item.agencyId,req.query.activityId).then(function(moreActivity){
									j++;
									activityDetail.moreActivity=moreActivity;									
									activityList.push(activityDetail);
									if(j== result.length)
									{
										activityList = _.sortBy(activityList,"id");
										Util.makeResponse(res, true, 200, "Agency Camping Packages", '1.0.0', activityList.reverse());
									}
								});
							});
						}
						else
						{
							Util.makeResponse(res, true, 200, "Agency Camping Packages", '1.0.0', activityList);
						}
					}
                });
            }
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /agencyList ************************************************************************/
    /**
     * @api {get} /agencyList agencyList
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/agencyList 
     * @apiGroup Agency
     * @apiName agencyList
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     page                      Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Activity Listing","AppVersion":"1.0.0","Result":[{"id":12,"ownerName":"Montu","email":"deepak.singh@instantsys.com","mobile":9582835523,"address":"Gurgaon - Damdaama lack","company":"Adventure - Block","price":"0"}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/agencyList', function(req, res) {
        var schema = {
			'page': {
                notEmpty: true,
                errorMessage: 'Page Number is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var page=req.query.page;
			var limit=10;
			if(page ==1)
			{
				var start=0;
			}
			else
			{
				var start =((page-1)*limit)
			}
	
			client.query("select a.id , a.owner_name as ownerName,a.address,a.company, if((select min(price_per_person) from tbl_agency_activities where agency_id=a.id),FORMAT((select min(price_per_person) from tbl_agency_activities where agency_id=a.id),2),0) as price from tbl_agency as a where a.status=? and a.is_block=? and a.is_deleted=? order by a.id desc limit "+start +","+ limit, ['1','0','0'], function(error, result, fields) {
				if (error) 
				{
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{
					Util.makeResponse(res, true, 200, "Activity Listing", '1.0.0', result);
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /agencyActivities ************************************************************************/
    /**
     * @api {get} /agencyActivities agencyActivities
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/agencyActivities 
     * @apiGroup Agency
     * @apiName agencyActivities
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     agencyId                  Agency id Integer
	 * @apiParam (Expected parameters) {Integer}     page                      Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Agency Activity Listing","AppVersion":"1.0.0","Result":[{"activityName":"Rafting","agencyId":7,"agencyMobile":9582835523,"agencyName":"Deepak","agencyAddress":"Shipra suncity","activityId":2,"title":"White River Rafting","location":"Camp Shivpuri Rishikesh, Shivpuri Range, Uttarakhand, India","price":"350.00","description":"White river rafting is a riverside jungle camp far from the highway and away from everyone else. The pleasant sound of the rapids on the river echoes in the valley and camping around such an amazing natural surroundings is a lifetime experience in itself. As the area has Rajaji National park on both sides, a good variety of rare himalayan birds can be seen. Evenings at campsite are romantic, fun-filled and exciting. The starlit sky, silhouette of the mountains, rippling sound of the river and shimmering of bon-fire, this is a great way to explore the outdoors.","openTime":"09:30:00","closeTime":"18:00:00","latitude":"30.143401","longitude":"78.37823600000002","difficultLevel":1}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/agencyActivities', function(req, res) {
        var schema = {
			'agencyId': {
                notEmpty: true,
                errorMessage: 'Agency Id is Required'
            },
			'page': {
                notEmpty: true,
                errorMessage: 'Page Number is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var data=req.query;
			var page=data.page;
			var limit=10;
			if(page ==1)
			{
				var start=0;
			}
			else
			{
				var start =((page-1)*limit)
			}
			client.query("select c.name as activityName, b.id as agencyId, b.mobile as agencyMobile, b.owner_name as agencyName, b.address as agencyAddress, a.id as activityId, a.title, a.location, FORMAT(a.price_per_person,2) as price, a.description, a.open_time as openTime, a.close_time as closeTime, a.latitude, a.longitude, a.difficult_level as difficultLevel from tbl_agency_activities as a left join tbl_agency as b on b.id=a.agency_id left join tbl_activity as c on c.id=a.activity_id where a.agency_id=? order by a.id desc limit "+start +","+ limit, [data.agencyId], function(error, result, fields) {
				if (error) 
				{
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{
					Util.makeResponse(res, true, 200, "Agency Activity Listing", '1.0.0', result);
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /agencyComboPackages ************************************************************************/
    /**
     * @api {get} /agencyComboPackages agencyComboPackages
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/agencyComboPackages
     * @apiGroup Agency
     * @apiName agencyComboPackages
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     agencyId                  Agency id Integer
	 * @apiParam (Expected parameters) {Integer}     page                      Page Number Integer (Default=1)
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Combo Package Details Detail","AppVersion":"1.0.0","Result":{"packageId":"1","agencyId":7,"agencyMobile":9582835523,"agencyAddress":"Shipra suncity","name":"test #1","title":"Title","description":"Dscp","days":1,"night":0,"camping":"1","campDescription":"desction","location":"Rishikesh, Uttarakhand, India","price":null,"doubleSharing":"33.00","tripleSharing":"33.00","latitude":"30.0869281","longitude":"78.26761160000001","meal":["meal 3","meal 2","meal 1"],"inclusion":[],"exclusion":[],"images":[],"terms":[],"notes":["Special Notes  - 2","Special Notes - 1"]}}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/agencyComboPackages', function(req, res) {
        var schema = {
			'agencyId': {
                notEmpty: true,
                errorMessage: 'Agency Id is Required'
            },
			'page': {
                notEmpty: true,
                errorMessage: 'Page Number is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var data=req.query;
			var page=data.page;
			var limit=10;
			if(page ==1)
			{
				var start=0;
			}
			else
			{
				var start =((page-1)*limit)
			}
			client.query("select b.id as agencyId, b.mobile as agencyMobile, b.owner_name as agencyName, b.address as agencyAddress, a.id as packageId, a.combo_name, a.combo_title, a.combo_description, a.combo_location, a.days, a.night,a.camping, a.camp_description, FORMAT(a.price,2) as price, FORMAT(a.double_sharing,2) as doubleSharing, FORMAT(a.triple_sharing,2) as tripleSharing,  a.latitude, a.longitude from tbl_combo_packages as a left join tbl_agency as b on b.id=a.agency_id  where a.agency_id=? order by a.id desc limit "+start +","+ limit, [data.agencyId], function(error, result, fields) {
				if (error) 
				{
					console.log(error);
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{
					var comboPackages=[];
					if(result.length >0)
					{
						var j=0;
						result.forEach(function (item){
							
							var packageDetail={
								"packageId":item.packageId,
								"activityName":item.activityName,
								"agencyId":item.agencyId,
								"agencyMobile":item.agencyMobile,
								"agencyAddress":item.agencyAddress,
								"name":item.combo_name,
								"title":item.combo_title,
								"description":item.combo_description,
								"days":item.days,
								"night":item.night,
								"camping":item.camping,
								"campDescription":item.camp_description,					
								"location":item.combo_location,
								"price":item.price,
								"doubleSharing":item.doubleSharing,
								"tripleSharing":item.tripleSharing,
								"latitude":item.latitude,
								"longitude":item.longitude,
								"meal":[],
								"inclusion":[],
								"exclusion":[],
								"images":[],
								"terms":[],
								"notes":[]
							};
							common.getActivityVariables(client,item.packageId,'12').then(function(resMeal){
								packageDetail.meal=resMeal;
								common.getActivityVariables(client,item.packageId,'13').then(function(resInclusion){
									packageDetail.inclusion=resInclusion;
									common.getActivityVariables(client,item.packageId,'14').then(function(resExclusion){
										packageDetail.exclusion=resExclusion;
										common.getActivityVariables(client,item.packageId,'15').then(function(resImages){
											packageDetail.images=resImages;
											common.getActivityVariables(client,item.packageId,'17').then(function(resTerms){
												packageDetail.terms=resTerms;
												common.getActivityVariables(client,item.packageId,'18').then(function(resNotes){
													j++;
													packageDetail.notes=resNotes;
													comboPackages.push(packageDetail);
													if(j== result.length)
													{
														comboPackages = _.sortBy(comboPackages,"packageId");
														Util.makeResponse(res, true, 200, "Agency Combo Package Details", '1.0.0', comboPackages.reverse());
													}												
												});
											});
										});
									});
								});
							});	
						});
					}
					else
					{
						Util.makeResponse(res, true, 200, "Agency Combo Package Details", '1.0.0', comboPackages);
					}
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /agencyCampingPackages ************************************************************************/
    /**
     * @api {get} /agencyCampingPackages agencyCampingPackages
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/agencyCampingPackages
     * @apiGroup Agency
     * @apiName agencyCampingPackages
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     agencyId                  Agency id Integer
	 * @apiParam (Expected parameters) {Integer}     page                      Page Number Integer 
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Combo Package Details Detail","AppVersion":"1.0.0","Result":{"packageId":"1","agencyId":1,"agencyMobile":9876543210,"agencyAddress":"Noida","name":"My Camp","title":"test","description":"sdf sdf dsf sdfsd fs d","days":3,"night":2,"location":"","doubleSharing":"45.00","tripleSharing":"45.00","latitude":"","longitude":"","meal":["sdfsdf sdf"],"inclusion":["sdf sdf sd"],"exclusion":["s dfsd fsd"],"images":["https://cdrbkt.s3.us-west-1.amazonaws.com/1515915977.jpg"],"terms":["sdfsd fsd f"],"notes":["s dfsd fsd"]}}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/agencyCampingPackages', function(req, res) {
        var schema = {
			'agencyId': {
                notEmpty: true,
                errorMessage: 'Agency Id is Required'
            },
			'page': {
                notEmpty: true,
                errorMessage: 'Page Number is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var data=req.query;
			var page=data.page;
			var limit=10;
			if(page ==1)
			{
				var start=0;
			}
			else
			{
				var start =((page-1)*limit)
			}
			client.query("select b.id as agencyId, b.mobile as agencyMobile, b.owner_name as agencyName, b.address as agencyAddress, a.id as packageId, a.camping_name, a.camping_title, a.camping_description, a.camping_location, a.days, a.night, FORMAT(a.double_sharing,2) as doubleSharing, FORMAT(a.triple_sharing,2) as tripleSharing,  a.latitude, a.longitude from tbl_camping_packages as a left join tbl_agency as b on b.id=a.agency_id where a.agency_id=? order by a.id desc limit "+start +","+ limit,[data.agencyId], function(error, result, fields) {
				if (error) 
				{
					console.log(error);
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{					
					var campingPackages=[];
					if(result.length >0)
					{
						var j=0;
						result.forEach(function (item){
							var packageDetail={
								"packageId":item.packageId,
								"activityName":item.activityName,
								"agencyId":item.agencyId,
								"agencyMobile":item.agencyMobile,
								"agencyAddress":item.agencyAddress,
								"name":item.camping_name,
								"title":item.camping_title,
								"description":item.camping_description,
								"days":item.days,
								"night":item.night,				
								"location":item.camping_location,
								"doubleSharing":item.doubleSharing,
								"tripleSharing":item.tripleSharing,
								"latitude":item.latitude,
								"longitude":item.longitude,
								"meal":[],
								"inclusion":[],
								"exclusion":[],
								"images":[],
								"terms":[],
								"notes":[]
							};
							common.getActivityVariables(client,item.packageId,'5').then(function(resMeal){
								packageDetail.meal=resMeal;
								common.getActivityVariables(client,item.packageId,'6').then(function(resInclusion){
									packageDetail.inclusion=resInclusion;
									common.getActivityVariables(client,item.packageId,'7').then(function(resExclusion){
										packageDetail.exclusion=resExclusion;
										common.getActivityVariables(client,item.packageId,'8').then(function(resImages){
											packageDetail.images=resImages;
											common.getActivityVariables(client,item.packageId,'10').then(function(resTerms){
												packageDetail.terms=resTerms;
												common.getActivityVariables(client,item.packageId,'11').then(function(resNotes){
													j++;
													packageDetail.notes=resNotes;
													campingPackages.push(packageDetail);
													if(j== result.length)
													{
														campingPackages = _.sortBy(campingPackages,"packageId");
														Util.makeResponse(res, true, 200, "Agency Camping Packages", '1.0.0', campingPackages.reverse());
													}	
												});
											});
										});
									});
								});
							});
						});
					}
					else
					{
						Util.makeResponse(res, true, 200, "Sorry, No Camping Package Found", '1.0.0', campingPackages);	
					}
					
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /activityDetail ************************************************************************/
    /**
     * @api {get} /activityDetail activityDetail
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/activityDetail
     * @apiGroup Activity
     * @apiName activityDetail
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     activityId                      Activity Id Integer
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Activity Detail","AppVersion":"1.0.0","Result":{"activityId":"1","activityName":"Rafting","agencyId":1,"agencyMobile":9876543210,"agencyAddress":"Noida","title":"sdfs","location":"Noida, Uttar Pradesh, India","price":"34.00","description":"vcb cfg","openTime":"03:25 pm","closeTime":"06:25 pm","difficultLevel":"Hard","latitude":"28.5355161","longitude":"77.39102649999995","unityType":{"1":"12"},"images":["https://cdrbkt.s3.us-west-1.amazonaws.com/1514714155.jpg"],"terms":[],"notes":[]}}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/activityDetail', function(req, res) {
        var schema = {
			'activityId': {
                notEmpty: true,
                errorMessage: 'Activity Id is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var data=req.query;
			client.query("select c.name as activityName, b.id as agencyId, b.mobile as agencyMobile, b.owner_name as agencyName, b.address as agencyAddress, a.title, a.location, FORMAT(a.price_per_person,2) as price, a.description, a.open_time as openTime, a.close_time as closeTime, a.latitude, a.longitude, a.unit_type_value, d.name as difficultLevel from tbl_agency_activities as a left join tbl_agency as b on b.id=a.agency_id left join tbl_activity as c on c.id=a.activity_id left join tbl_activity_difficulty_level as d on d.id=a.difficult_level where a.id=? ", [data.activityId], function(error, result, fields) {
				if (error) 
				{
					console.log(error);
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{
					
					if(result.length >0)
					{
						var activityDetail={
							"activityId":data.activityId,
							"activityName":result[0].activityName,
							"agencyId":result[0].agencyId,
							"agencyMobile":result[0].agencyMobile,
							"agencyAddress":result[0].agencyAddress,
							"title":result[0].title,
							"location":result[0].location,
							"price":result[0].price,
							"description":result[0].description,
							"openTime":moment(result[0].openTime,'HH:mm').format('hh:mm a'),
							"closeTime":moment(result[0].closeTime,'HH:mm').format('hh:mm a'),
							"difficultLevel":result[0].difficultLevel,
							"latitude":result[0].latitude,
							"longitude":result[0].longitude,
							"unityType":JSON.parse(result[0].unit_type_value),
							"images":[],
							"terms":[],
							"notes":[]
						};
						common.getActivityVariables(client,data.activityId,'1').then(function(resImages){
							activityDetail.images=resImages;
							common.getActivityVariables(client,data.activityId,'3').then(function(resTerms){
								activityDetail.terms=resTerms;
								common.getActivityVariables(client,data.activityId,'4').then(function(resNotes){
									activityDetail.notes=resNotes;
									Util.makeResponse(res, true, 200, "Activity Detail", '1.0.0', activityDetail);
								});
							});
						});
						
					}
					else
					{
						Util.makeResponse(res, true, 200, "Sorry, No Activity Detail Found", '1.0.0', {});	
					}
					
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /comboPackageDetail ************************************************************************/
    /**
     * @api {get} /comboPackageDetail comboPackageDetail
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/comboPackageDetail
     * @apiGroup Activity
     * @apiName comboPackageDetail
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     packageId                      Combo Package Id Integer
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Combo Package Details Detail","AppVersion":"1.0.0","Result":{"packageId":"1","agencyId":7,"agencyMobile":9582835523,"agencyAddress":"Shipra suncity","name":"test #1","title":"Title","description":"Dscp","days":1,"night":0,"camping":"1","campDescription":"desction","location":"Rishikesh, Uttarakhand, India","price":null,"doubleSharing":"33.00","tripleSharing":"33.00","latitude":"30.0869281","longitude":"78.26761160000001","meal":["meal 3","meal 2","meal 1"],"inclusion":[],"exclusion":[],"images":[],"terms":[],"notes":["Special Notes  - 2","Special Notes - 1"]}}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/comboPackageDetail', function(req, res) {
        var schema = {
			'packageId': {
                notEmpty: true,
                errorMessage: 'Package Id is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var data=req.query;
			client.query("select b.id as agencyId, b.mobile as agencyMobile, b.owner_name as agencyName, b.address as agencyAddress, a.combo_name, a.combo_title, a.combo_description, a.combo_location, a.days, a.night,a.camping, a.camp_description, FORMAT(a.price,2) as price, FORMAT(a.double_sharing,2) as doubleSharing, FORMAT(a.triple_sharing,2) as tripleSharing,  a.latitude, a.longitude from tbl_combo_packages as a left join tbl_agency as b on b.id=a.agency_id  where a.id=? ", [data.packageId], function(error, result, fields) {
				if (error) 
				{
					console.log(error);
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{
					
					if(result.length >0)
					{
						var packageDetail={
							"packageId":data.packageId,
							"activityName":result[0].activityName,
							"agencyId":result[0].agencyId,
							"agencyMobile":result[0].agencyMobile,
							"agencyAddress":result[0].agencyAddress,
							"name":result[0].combo_name,
							"title":result[0].combo_title,
							"description":result[0].combo_description,
							"days":result[0].days,
							"night":result[0].night,
							"camping":result[0].camping,
							"campDescription":result[0].camp_description,					
							"location":result[0].combo_location,
							"price":result[0].price,
							"doubleSharing":result[0].doubleSharing,
							"tripleSharing":result[0].tripleSharing,
							"latitude":result[0].latitude,
							"longitude":result[0].longitude,
							"meal":[],
							"inclusion":[],
							"exclusion":[],
							"images":[],
							"terms":[],
							"notes":[]
						};
						common.getActivityVariables(client,data.packageId,'12').then(function(resMeal){
							packageDetail.meal=resMeal;
							common.getActivityVariables(client,data.packageId,'13').then(function(resInclusion){
								packageDetail.inclusion=resInclusion;
								common.getActivityVariables(client,data.packageId,'14').then(function(resExclusion){
									packageDetail.exclusion=resExclusion;
									common.getActivityVariables(client,data.packageId,'15').then(function(resImages){
										packageDetail.images=resImages;
										common.getActivityVariables(client,data.packageId,'17').then(function(resTerms){
											packageDetail.terms=resTerms;
											common.getActivityVariables(client,data.packageId,'18').then(function(resNotes){
												packageDetail.notes=resNotes;
												Util.makeResponse(res, true, 200, "Combo Package Details Detail", '1.0.0', packageDetail);
											});
										});
									});
								});
							});
						});						
					}
					else
					{
						Util.makeResponse(res, true, 200, "Sorry, No Combo Package Found", '1.0.0', {});	
					}
					
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /campingPackageDetail ************************************************************************/
    /**
     * @api {get} /campingPackageDetail campingPackageDetail
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/campingPackageDetail
     * @apiGroup Activity
     * @apiName campingPackageDetail
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     packageId                      Camping Package id Integer
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Combo Package Details Detail","AppVersion":"1.0.0","Result":{"packageId":"1","agencyId":1,"agencyMobile":9876543210,"agencyAddress":"Noida","name":"My Camp","title":"test","description":"sdf sdf dsf sdfsd fs d","days":3,"night":2,"location":"","doubleSharing":"45.00","tripleSharing":"45.00","latitude":"","longitude":"","meal":["sdfsdf sdf"],"inclusion":["sdf sdf sd"],"exclusion":["s dfsd fsd"],"images":["https://cdrbkt.s3.us-west-1.amazonaws.com/1515915977.jpg"],"terms":["sdfsd fsd f"],"notes":["s dfsd fsd"]}}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/campingPackageDetail', function(req, res) {
        var schema = {
			'packageId': {
                notEmpty: true,
                errorMessage: 'Package Id is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var data=req.query;
			client.query("select b.id as agencyId, b.mobile as agencyMobile, b.owner_name as agencyName, b.address as agencyAddress, a.camping_name, a.camping_title, a.camping_description, a.camping_location, a.days, a.night, FORMAT(a.double_sharing,2) as doubleSharing, FORMAT(a.triple_sharing,2) as tripleSharing,  a.latitude, a.longitude from tbl_camping_packages as a left join tbl_agency as b on b.id=a.agency_id  where a.id=? ", [data.packageId], function(error, result, fields) {
				if (error) 
				{
					console.log(error);
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{
					
					if(result.length >0)
					{
						var packageDetail={
							"packageId":data.packageId,
							"activityName":result[0].activityName,
							"agencyId":result[0].agencyId,
							"agencyMobile":result[0].agencyMobile,
							"agencyAddress":result[0].agencyAddress,
							"name":result[0].camping_name,
							"title":result[0].camping_title,
							"description":result[0].camping_description,
							"days":result[0].days,
							"night":result[0].night,				
							"location":result[0].camping_location,
							"doubleSharing":result[0].doubleSharing,
							"tripleSharing":result[0].tripleSharing,
							"latitude":result[0].latitude,
							"longitude":result[0].longitude,
							"meal":[],
							"inclusion":[],
							"exclusion":[],
							"images":[],
							"terms":[],
							"notes":[]
						};
						common.getActivityVariables(client,data.packageId,'5').then(function(resMeal){
							packageDetail.meal=resMeal;
							common.getActivityVariables(client,data.packageId,'6').then(function(resInclusion){
								packageDetail.inclusion=resInclusion;
								common.getActivityVariables(client,data.packageId,'7').then(function(resExclusion){
									packageDetail.exclusion=resExclusion;
									common.getActivityVariables(client,data.packageId,'8').then(function(resImages){
										packageDetail.images=resImages;
										common.getActivityVariables(client,data.packageId,'10').then(function(resTerms){
											packageDetail.terms=resTerms;
											common.getActivityVariables(client,data.packageId,'11').then(function(resNotes){
												packageDetail.notes=resNotes;
												Util.makeResponse(res, true, 200, "Combo Package Details Detail", '1.0.0', packageDetail);
											});
										});
									});
								});
							});
						});						
					}
					else
					{
						Util.makeResponse(res, true, 200, "Sorry, No Camping Package Found", '1.0.0', {});	
					}
					
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	/***************************************************************************************************************************************************************/
    /************************************************************************ /activityListByAgency ************************************************************************/
    /**
     * @api {get} /activityListByAgency activityListByAgency
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/activityListByAgency
     * @apiGroup Activity
     * @apiName activityListByAgency
     * ***************************************************************************************************************************************************************
	 * @apiParam (Expected parameters) {Integer}     activityId                      Activity id Integer
	 * @apiParam (Expected parameters) {Integer}     agencyId                        Agency id Integer
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success            response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Combo Package Details Detail","AppVersion":"1.0.0","Result":{"packageId":"1","agencyId":1,"agencyMobile":9876543210,"agencyAddress":"Noida","name":"My Camp","title":"test","description":"sdf sdf dsf sdfsd fs d","days":3,"night":2,"location":"","doubleSharing":"45.00","tripleSharing":"45.00","latitude":"","longitude":"","meal":["sdfsdf sdf"],"inclusion":["sdf sdf sd"],"exclusion":["s dfsd fsd"],"images":["https://cdrbkt.s3.us-west-1.amazonaws.com/1515915977.jpg"],"terms":["sdfsd fsd f"],"notes":["s dfsd fsd"]}}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/activityListByAgency', function(req, res) {
        var schema = {
			'activityId': {
                notEmpty: true,
                errorMessage: 'Activity Id is Required'
            },
			'agencyId': {
                notEmpty: true,
                errorMessage: 'Agency Id is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
			var data=req.query;
			var page=data.page;
			var limit=10;
			if(page ==1)
			{
				var start=0;
			}
			else
			{
				var start =((page-1)*limit)
			}
			client.query("select c.name as activityName, b.id as agencyId, b.mobile as agencyMobile, b.owner_name as agencyName, b.address as agencyAddress, a.title, a.location, FORMAT(a.price_per_person,2) as price, a.description, a.open_time as openTime, a.close_time as closeTime, a.latitude, a.longitude, a.unit_type_value, d.name as difficultLevel from tbl_agency_activities as a left join tbl_agency as b on b.id=a.agency_id left join tbl_activity as c on c.id=a.activity_id left join tbl_activity_difficulty_level as d on d.id=a.difficult_level where a.agency_id=? and a.activity_id=?  order by a.id desc limit "+start +","+ limit, [data.agencyId,data.activityId], function(error, result, fields) {
				if (error) 
				{
					console.log(error);
					Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
				}
				else
				{
					var activityList=[];
					if(result.length >0)
					{
						var j=0;
						result.forEach(function (item){
							var activityDetail={
								"agencyName":item.agencyName,
								"activityName":item.activityName,
								"id":item.id,
								"title":item.title,				
								"location":item.location,
								"description":item.description,
								"days":item.days,
								"unitType":item.unitType,
								"unitTypeValue":item.unitTypeValue?JSON.parse(item.unitTypeValue):{},
								"season":item.season,
								"price":item.price,
								"difficultLevel":item.difficultLevel,
								"openTime":item.openTime,
								"closeTime":item.closeTime,
							};
							activityList.push(activityDetail);
							j++;							
							if(j== result.length)
							{
								activityList = _.sortBy(activityList,"id");
								Util.makeResponse(res, true, 200, "Activity Listing", '1.0.0', activityList);
							}					
						});
					}
					else
					{
						Util.makeResponse(res, true, 200, "Activity Listing", '1.0.0', activityList);
					}					
				}
			});
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
	
	
	
	
	
	
	
	
	
	

    /***************************************************************************************************************************************************************/
    /************************************************************************ /myProfile ************************************************************************/
    /**
     * @api {get} /myProfile myProfile
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/myProfile 
     * @apiGroup User
     * @apiName myProfile
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      userId                User ID string
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * @apiSuccessExample {json} Success-Response
     * {"Success":true,"Status":200,"Message":"Success","AppVersion":"1.0.0","Result":[{"userId":1,"name":"Rajan Middha","phone":9876543214,"deviceToken":"","deviceType":"","email":"rajanmidd@gmail.com"}]}
     *   
     * @apiVersion 1.0.0
     **/


    api.get('/myProfile', function(req, res) {
        var schema = {
            'userId': {
                notEmpty: true,
                errorMessage: 'User ID is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
            var userId = req.query.userId;
            if (!userId) {
                Util.makeResponse(res, false, 200, "User ID is Required", '1.0.0', []);
            } else {
                client.query("select * from tbl_users where id=? limit 1", [userId], function(error2, result2, fields2) {
                    if (error2) {
                        Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);

                    } else if (result2.length == 0) {
                        Util.makeResponse(res, false, 200, "User ID does not exists", '1.0.0', []);

                    } else {


                        var newData = [{
                            "userId": Util.checknull(result2[0].id),
                            "name": Util.checknull(result2[0].name),
                            "phone": Util.checknull(result2[0].phone),
                            "deviceToken": Util.checknull(req.body.deviceToken),
                            "deviceType": Util.checknull(req.body.deviceType),
                            "email": Util.checknull(result2[0].email)
                        }];
                        Util.makeResponse(res, true, 200, "Success", '1.0.0', newData);
                    }
                });
            }
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });


    /***************************************************************************************************************************************************************/
    /************************************************************************ /editProfile ************************************************************************/
    /**
     * @api {post} /editProfile editProfile
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/editProfile
     * @apiGroup User
     * @apiName editProfile
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      email                Email string
     * @apiParam (Expected parameters) {Number}      userId               User ID number
     * @apiParam (Expected parameters) {String}      firstName            First Name string
     * @apiParam (Expected parameters) {String}      lastName             Last Name string
     * @apiParam (Expected parameters) {String}      password             password string
     * @apiParam (Expected parameters) {String}      mobile               mobile number as a string
     * @apiParam (Expected parameters) {String}      city                 City name as a string
     * @apiParam (Expected parameters) {String}      deviceToken          device token string
     * @apiParam (Expected parameters) {String}      deviceType           device type 0=android,1=IOs it would be also a string
     
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * ***************************************************************************************************************************************************************
     * @apiVersion 1.0.0
     **/

    api.post('/editProfile', function(req, res) {
        //console.log(req.body);
        var schema = {
            'userId': {
                notEmpty: true,
                errorMessage: 'User ID is Required' // Error message for the parameter 
            },
            'email': {
                notEmpty: true,
                isEmail: {
                    errorMessage: 'Invalid Email format'
                }
            },
            'name': {
                notEmpty: true,
                errorMessage: 'Name is Required' // Error message for the parameter 
            },
            'phone': {
                notEmpty: true,
                errorMessage: 'phone is Required' // Error message for the parameter 
            }
        };
        req.checkBody(schema);
        req.asyncValidationErrors().then(function() {
            // all good here 
            var data = req.body;
            var userId = data.userId;
            var name = data.name;
            var email = data.email;
            var phone = data.phone;
            var device_token = data.deviceToken || "";
            var device_type = data.deviceType || 1;

            client.query("select * from tbl_users where id=?", [userId], function(error, result, fields) {
                if (error) 
                {
                    Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                } 
                else if (result.length == 0) 
                {
                    Util.makeResponse(res, false, 200, "Sorry, Invalid User ID or Old Password", '1.0.0', []);
                }
                else if (result[0].status == '0') 
                {
                    Util.makeResponse(res, false, 200, "Sorry, your account is not active.", '1.0.0', []);
                }
                else if(result[0].is_blocked =='2')
                {
                    Util.makeResponse(res, false, 200, "Sorry, your account has been blocked. Please contact to GO-Week Team.", '1.0.0', []);
                }           
                else if(result[0].is_deleted =='2')
                {
                    Util.makeResponse(res, false, 200, "Sorry, your account does not exists.", '1.0.0', []);
                }
                else
                {
                    var regFields = {
                        'name': name,
                        'email': email,
                        'phone': phone,
                        'status': '1',
                        'device_token': device_token || "",
                        'device_type': device_type || 1
                    };

                    client.query("UPDATE tbl_users SET ? WHERE id = ?", [regFields, userId], function(error1, result1, fields1) {
                        if (error1) 
                        {
                            Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                        } 
                        else
                        {
                            Util.makeResponse(res, true, 200, "Profile Updated Successfully", '1.0.0', req.body);
                        }
                    });
                }
            });
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });

    
    /***************************************************************************************************************************************************************/
    /************************************************************************ /logout ************************************************************************/
    /**
     * @api {get} /logout logout
     * @apiHeader {String} x-goweek-token Users unique x-goweek-token.
     * @apiHeader {String} Content-Type application/x-www-form-urlencoded.
     * @apiDescription http://54.172.221.76:10005/api/v1/logout 
     * @apiGroup User
     * @apiName logout
     * ***************************************************************************************************************************************************************
     * @apiParam (Expected parameters) {String}      userId             User id string
     
     * ***************************************************************************************************************************************************************
     * @apiSuccess {Number=0,1}            Success           response status ( 0 for error, 1 for success )
     * @apiSuccess {Number}                Status             status code
     * @apiSuccess {String}                Message            response message string
     * @apiSuccess {String}                AppVersion         APP version
     * @apiSuccess {Object}                Result             result
     * ***************************************************************************************************************************************************************
     * @apiVersion 1.0.0
     **/

    api.get('/logout', function(req, res) {
        var data = req.query;
        var schema = {
            'userId': {
                notEmpty: true,
                errorMessage: 'User ID is Required'
            },
        };
        req.checkQuery(schema);
        req.asyncValidationErrors().then(function() {
            client.query('UPDATE tbl_users SET last_login = ?, updated_at=?, device_token=?  WHERE id = ? ', [moment().format('YYYY-MM-DD HH:mm:s'),moment().format('YYYY-MM-DD HH:mm:s'), '', req.query.userId], function(err, result) {
                if (err) {
                    //console.log(err)
                    Util.makeResponse(res, false, 500, "Something went wrong", '1.0.0', []);
                } else {
                    Util.makeResponse(res, true, 200, "Logout Successfully", '1.0.0', []);
                }
            });
        }, function(errors) {
            Util.makeResponse(res, false, 400, "Bad Request", '1.0.0', errors);
        });
    });
      
   return api;
};


function sendMail(to,subject,message) 
{
   var smtpConfig = {
      service: 'Gmail',
      auth: {
         user: 'rajanmidd@gmail.com',
         pass: '01668230543'
      }
   };
   var transporter = nodemailer.createTransport(smtpConfig);
   var mailOptions = {
      from: '"Go-Week" <admin@goweek.com>', // sender address
      to: to, // list of receivers
      subject: subject, // Subject line
      //text: 'Hello world ?', // plaintext body
      html: message // html body
   };
   
   transporter.sendMail(mailOptions, function(error, info){
      if(error)
      {
         return console.log(error);
      }
      else
      {
         return console.log(info.response);
      }      
   }); 
}

function randomString(len)
{
    var text = "";
    //var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var possible = "123456789";
    for(var i = 0; i < len; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
}