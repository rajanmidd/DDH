'use strict';
//set NODE_ENV=production
if (process.env.NODE_ENV === "prod") {
    var dbinfo = {
        'url': 'dsngeudb.cnlozsh3ryb3.us-east-1.rds.amazonaws.com',
        'port': '3306',
        'username': 'dsngeu',
        'password': 'deepak123',
        'database': 'dsngeudb',
    }
} else if (process.env.NODE_ENV === "uts") {
    var dbinfo = {
        'url': 'dsngeudb.cnlozsh3ryb3.us-east-1.rds.amazonaws.com',
        'port': '3306',
        'username': 'dsngeu',
        'password': 'deepak123',
        'database': 'dsngeudb',
    }

} else {
    var dbinfo = {
        'url': 'dsngeudb.cnlozsh3ryb3.us-east-1.rds.amazonaws.com',
        'port': '3306',
        'username': 'dsngeu',
        'password': 'deepak123',
        'database': 'dsngeudb',
    }
}

module.exports = dbinfo;
