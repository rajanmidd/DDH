var express=require('express'),
  app=express(),
  bodyParser = require('body-parser'), //it is use to handle post reuqests
  morgan = require('morgan'), //use morgan to for development env
  mysql = require('mysql'), //used to manage mysql 
  jwt = require('jsonwebtoken'), // use to create, sign, and verify tokens
  config = require('./config/config'), // get our config file
  path = require('path');


// setting up DB configuration 
var db_client = mysql.createPool({
  connectionLimit : 10,
  host: config.DB.url,
  user: config.DB.username,
  password: config.DB.password,
  database: config.DB.database,
});

//connect to mysql database
/* db_client.connect(function(err) {
  if (err) {
    console.log(err)
    console.error('error occured during mysql db connection: ' + err.stack);
    return;
  }
  console.log('connected as id ' + db_client.threadId);
}); */

db_client.on('error', function(err) {
  if (err.code === 'ETIMEDOUT') {
      db_client.connect(function(err) {
          if (err) {
              console.log(err)
              console.error('error occured during mysql db connection: ' + err.stack);
              return;
          }
          console.log('connected as id ' + db_client.threadId);
      });
  }
});

// Setting Secret code globally 
app.set('superSecret', config.CONSTANTS.secret); // secret variable

// use body parser so we can get info from POST and/or URL parameters
app.use(bodyParser.urlencoded({ extended: false }));

//enabling bodyparser to accept json also
app.use(bodyParser.json());

// use morgan to log requests to the console
app.use(morgan('dev'));

//define public folder as a static folder
app.use(express.static(__dirname + '/public'));

// Switch off the default 'X-Powered-By: Express' header
app.disable('x-powered-by');

//create custom headers to aa our custom headers
function customHeaders(req, res, next) {
  // OR set your own header here
  res.setHeader('X-goWeek-App-Version', 'v1.0.0');
  next();
}

//adding customHeaders function in middleware 
app.use(customHeaders);

//adding route for home page
app.get('/', function(req, res) {
  res.send('<center><h2><b>Hi, This is Go-Week Server.<br><i> How can i help you ;)</i></b></h2></center>');
});

app.set('views', path.join(__dirname, './app/views'));
app.set('view engine', 'ejs');

//adding route for docs 
app.get('/docs', function(req, res) {
  app.use(express.static(__dirname + '/docs'));
  res.sendFile('./public/apidoc/index.html', { root: __dirname });
});


// define apiv1 for version v1 api routes and require routes based file
var api1 = require('./routes/v1/index')(app, express, db_client);
//adding middleware for api v1
app.use('/api/v1', api1);

// starting server at define port
app.listen(config.CONSTANTS.PORT);
console.log('Node JS Server running on http://localhost:' + config.CONSTANTS.PORT);



// cathc errors and save as file in log folder 
process.on(
  'uncaughtException',
  function(err) {
      var stack = err.stack;
      var timeout = 1;
      console.log(stack)
          // save log to timestamped logfile
      var filename = "crash_" + new Date() + ".log";
      console.log("LOGGING ERROR TO " + filename);
      console.log(stack);
      //         fs.writeFile('logs/' + filename, stack);
      //         setTimeout
      //         (
      //            function ()
      //            {
      //               console.log("KILLING PROCESS");
      //            },
      //            timeout * 1000
      //         );
  }
);