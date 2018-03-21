define({ "api": [
  {
    "type": "get",
    "url": "/activityDetail",
    "title": "activityDetail",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/activityDetail</p>",
    "group": "Activity",
    "name": "activityDetail________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "activityId",
            "description": "<p>Activity Id Integer</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Activity Detail\",\"AppVersion\":\"1.0.0\",\"Result\":{\"activityId\":\"1\",\"activityName\":\"Rafting\",\"agencyId\":1,\"agencyMobile\":9876543210,\"agencyAddress\":\"Noida\",\"title\":\"sdfs\",\"location\":\"Noida, Uttar Pradesh, India\",\"price\":\"34.00\",\"description\":\"vcb cfg\",\"openTime\":\"03:25 pm\",\"closeTime\":\"06:25 pm\",\"difficultLevel\":\"Hard\",\"latitude\":\"28.5355161\",\"longitude\":\"77.39102649999995\",\"unityType\":{\"1\":\"12\"},\"images\":[\"https://cdrbkt.s3.us-west-1.amazonaws.com/1514714155.jpg\"],\"terms\":[],\"notes\":[]}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Activity"
  },
  {
    "type": "get",
    "url": "/activityListByAgency",
    "title": "activityListByAgency",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/activityListByAgency</p>",
    "group": "Activity",
    "name": "activityListByAgency________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "activityId",
            "description": "<p>Activity id Integer</p>"
          },
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "agencyId",
            "description": "<p>Agency id Integer</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Combo Package Details Detail\",\"AppVersion\":\"1.0.0\",\"Result\":{\"packageId\":\"1\",\"agencyId\":1,\"agencyMobile\":9876543210,\"agencyAddress\":\"Noida\",\"name\":\"My Camp\",\"title\":\"test\",\"description\":\"sdf sdf dsf sdfsd fs d\",\"days\":3,\"night\":2,\"location\":\"\",\"doubleSharing\":\"45.00\",\"tripleSharing\":\"45.00\",\"latitude\":\"\",\"longitude\":\"\",\"meal\":[\"sdfsdf sdf\"],\"inclusion\":[\"sdf sdf sd\"],\"exclusion\":[\"s dfsd fsd\"],\"images\":[\"https://cdrbkt.s3.us-west-1.amazonaws.com/1515915977.jpg\"],\"terms\":[\"sdfsd fsd f\"],\"notes\":[\"s dfsd fsd\"]}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Activity"
  },
  {
    "type": "get",
    "url": "/activityList",
    "title": "activityList",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/activityList</p>",
    "group": "Activity",
    "name": "activityList________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Activity Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"activityName\":\"dfgdfgfdsdfsdfsdfsdfsdf sdf dsf sdf\",\"unityType\":2},{\"activityName\":\"sdfdfgsdfsdfsdf\",\"unityType\":0}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Activity"
  },
  {
    "type": "get",
    "url": "/campingPackageDetail",
    "title": "campingPackageDetail",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/campingPackageDetail</p>",
    "group": "Activity",
    "name": "campingPackageDetail________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "packageId",
            "description": "<p>Camping Package id Integer</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Combo Package Details Detail\",\"AppVersion\":\"1.0.0\",\"Result\":{\"packageId\":\"1\",\"agencyId\":1,\"agencyMobile\":9876543210,\"agencyAddress\":\"Noida\",\"name\":\"My Camp\",\"title\":\"test\",\"description\":\"sdf sdf dsf sdfsd fs d\",\"days\":3,\"night\":2,\"location\":\"\",\"doubleSharing\":\"45.00\",\"tripleSharing\":\"45.00\",\"latitude\":\"\",\"longitude\":\"\",\"meal\":[\"sdfsdf sdf\"],\"inclusion\":[\"sdf sdf sd\"],\"exclusion\":[\"s dfsd fsd\"],\"images\":[\"https://cdrbkt.s3.us-west-1.amazonaws.com/1515915977.jpg\"],\"terms\":[\"sdfsd fsd f\"],\"notes\":[\"s dfsd fsd\"]}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Activity"
  },
  {
    "type": "get",
    "url": "/comboPackageDetail",
    "title": "comboPackageDetail",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/comboPackageDetail</p>",
    "group": "Activity",
    "name": "comboPackageDetail________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "packageId",
            "description": "<p>Combo Package Id Integer</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Combo Package Details Detail\",\"AppVersion\":\"1.0.0\",\"Result\":{\"packageId\":\"1\",\"agencyId\":7,\"agencyMobile\":9582835523,\"agencyAddress\":\"Shipra suncity\",\"name\":\"test #1\",\"title\":\"Title\",\"description\":\"Dscp\",\"days\":1,\"night\":0,\"camping\":\"1\",\"campDescription\":\"desction\",\"location\":\"Rishikesh, Uttarakhand, India\",\"price\":null,\"doubleSharing\":\"33.00\",\"tripleSharing\":\"33.00\",\"latitude\":\"30.0869281\",\"longitude\":\"78.26761160000001\",\"meal\":[\"meal 3\",\"meal 2\",\"meal 1\"],\"inclusion\":[],\"exclusion\":[],\"images\":[],\"terms\":[],\"notes\":[\"Special Notes  - 2\",\"Special Notes - 1\"]}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Activity"
  },
  {
    "type": "get",
    "url": "/agencyActivities",
    "title": "agencyActivities",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/agencyActivities</p>",
    "group": "Agency",
    "name": "agencyActivities________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "agencyId",
            "description": "<p>Agency id Integer</p>"
          },
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Agency Activity Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"activityName\":\"Rafting\",\"agencyId\":7,\"agencyMobile\":9582835523,\"agencyName\":\"Deepak\",\"agencyAddress\":\"Shipra suncity\",\"activityId\":2,\"title\":\"White River Rafting\",\"location\":\"Camp Shivpuri Rishikesh, Shivpuri Range, Uttarakhand, India\",\"price\":\"350.00\",\"description\":\"White river rafting is a riverside jungle camp far from the highway and away from everyone else. The pleasant sound of the rapids on the river echoes in the valley and camping around such an amazing natural surroundings is a lifetime experience in itself. As the area has Rajaji National park on both sides, a good variety of rare himalayan birds can be seen. Evenings at campsite are romantic, fun-filled and exciting. The starlit sky, silhouette of the mountains, rippling sound of the river and shimmering of bon-fire, this is a great way to explore the outdoors.\",\"openTime\":\"09:30:00\",\"closeTime\":\"18:00:00\",\"latitude\":\"30.143401\",\"longitude\":\"78.37823600000002\",\"difficultLevel\":1}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Agency"
  },
  {
    "type": "get",
    "url": "/agencyCampingPackages",
    "title": "agencyCampingPackages",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/agencyCampingPackages</p>",
    "group": "Agency",
    "name": "agencyCampingPackages________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "agencyId",
            "description": "<p>Agency id Integer</p>"
          },
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Combo Package Details Detail\",\"AppVersion\":\"1.0.0\",\"Result\":{\"packageId\":\"1\",\"agencyId\":1,\"agencyMobile\":9876543210,\"agencyAddress\":\"Noida\",\"name\":\"My Camp\",\"title\":\"test\",\"description\":\"sdf sdf dsf sdfsd fs d\",\"days\":3,\"night\":2,\"location\":\"\",\"doubleSharing\":\"45.00\",\"tripleSharing\":\"45.00\",\"latitude\":\"\",\"longitude\":\"\",\"meal\":[\"sdfsdf sdf\"],\"inclusion\":[\"sdf sdf sd\"],\"exclusion\":[\"s dfsd fsd\"],\"images\":[\"https://cdrbkt.s3.us-west-1.amazonaws.com/1515915977.jpg\"],\"terms\":[\"sdfsd fsd f\"],\"notes\":[\"s dfsd fsd\"]}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Agency"
  },
  {
    "type": "get",
    "url": "/agencyComboPackages",
    "title": "agencyComboPackages",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/agencyComboPackages</p>",
    "group": "Agency",
    "name": "agencyComboPackages________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "agencyId",
            "description": "<p>Agency id Integer</p>"
          },
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Combo Package Details Detail\",\"AppVersion\":\"1.0.0\",\"Result\":{\"packageId\":\"1\",\"agencyId\":7,\"agencyMobile\":9582835523,\"agencyAddress\":\"Shipra suncity\",\"name\":\"test #1\",\"title\":\"Title\",\"description\":\"Dscp\",\"days\":1,\"night\":0,\"camping\":\"1\",\"campDescription\":\"desction\",\"location\":\"Rishikesh, Uttarakhand, India\",\"price\":null,\"doubleSharing\":\"33.00\",\"tripleSharing\":\"33.00\",\"latitude\":\"30.0869281\",\"longitude\":\"78.26761160000001\",\"meal\":[\"meal 3\",\"meal 2\",\"meal 1\"],\"inclusion\":[],\"exclusion\":[],\"images\":[],\"terms\":[],\"notes\":[\"Special Notes  - 2\",\"Special Notes - 1\"]}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Agency"
  },
  {
    "type": "get",
    "url": "/agencyList",
    "title": "agencyList",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/agencyList</p>",
    "group": "Agency",
    "name": "agencyList________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Activity Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"id\":12,\"ownerName\":\"Montu\",\"email\":\"deepak.singh@instantsys.com\",\"mobile\":9582835523,\"address\":\"Gurgaon - Damdaama lack\",\"company\":\"Adventure - Block\",\"price\":\"0\"}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Agency"
  },
  {
    "type": "post",
    "url": "/resendOtp",
    "title": "resendOtp",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/resendOtp</p>",
    "group": "OTP",
    "name": "resendOtp________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Phone string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "userId",
            "description": "<p>UserId string</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"New Otp Generated successfully\",\"AppVersion\":\"1.0.0\",\"Result\":{\"userId\":\"1\",\"otp\":\"2576\"}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "OTP"
  },
  {
    "type": "post",
    "url": "/verifyOtp",
    "title": "verifyOtp",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/verifyOtp</p>",
    "group": "OTP",
    "name": "verifyOtp________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "otp",
            "description": "<p>Otp string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "userId",
            "description": "<p>UserId string</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Login Successfully\",\"AppVersion\":\"1.0.0\",\"Result\":{\"userId\":1,\"name\":\"Rajan Middha\",\"phone\":9876543214,\"deviceToken\":\"sdfsdfsd\",\"deviceType\":\"1\",\"email\":\"rajanmidd@gmail.com\",\"token\":\"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUmFqYW4gTWlkZGhhIiwicGhvbmUiOjk4NzY1NDMyMTQsImVtYWlsIjoicmFqYW5taWRkQGdtYWlsLmNvbSIsImlhdCI6MTUxOTQ3MDIyNywiZXhwIjoxNTE5NTU2NjI3fQ.IAhGIADDavVA0NEll-PU-g0H_AxHuoFycP6BzAVU7ic\",\"otp\":\"6712\",\"expiresIn\":86400}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "OTP"
  },
  {
    "type": "get",
    "url": "/agencyListByActivity",
    "title": "agencyListByActivity",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/agencyListByActivity</p>",
    "group": "Packages",
    "name": "agencyListByActivity________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "activityId",
            "description": "<p>Activity ID string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Camping Packages Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"agencyName\":\"Rajan Middha\",\"id\":2,\"name\":\"sdfs\",\"title\":\"fsd\",\"description\":\"fsdfsdf\",\"location\":\"\",\"days\":3,\"night\":0,\"tripleSharing\":34,\"doubleSharing\":34}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Packages"
  },
  {
    "type": "get",
    "url": "/agencyListByCampingPackages",
    "title": "agencyListByCampingPackages",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/agencyListByCampingPackages</p>",
    "group": "Packages",
    "name": "agencyListByCampingPackages________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Camping Packages Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"agencyName\":\"Rajan Middha\",\"id\":2,\"name\":\"sdfs\",\"title\":\"fsd\",\"description\":\"fsdfsdf\",\"location\":\"\",\"days\":3,\"night\":0,\"tripleSharing\":34,\"doubleSharing\":34}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Packages"
  },
  {
    "type": "get",
    "url": "/agencyListByComboPackages",
    "title": "agencyListByComboPackages",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/agencyListByComboPackages</p>",
    "group": "Packages",
    "name": "agencyListByComboPackages________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Combo Packages Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"agencyName\":\"Rajan Middha\",\"id\":4,\"name\":\"fgh\",\"title\":\"fghfg\",\"description\":\"fgh\",\"days\":3,\"night\":0,\"campDescription\":\"dfgdf\",\"location\":\"Shimla, Himachal Pradesh, India\",\"price\":null,\"tripleSharing\":45,\"doubleSharing\":455,\"isCamping\":\"1\"}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Packages"
  },
  {
    "type": "get",
    "url": "/campingPackages",
    "title": "campingPackages",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/campingPackages</p>",
    "group": "Packages",
    "name": "campingPackages________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Camping Packages Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"agencyName\":\"Rajan Middha\",\"id\":2,\"name\":\"sdfs\",\"title\":\"fsd\",\"description\":\"fsdfsdf\",\"location\":\"\",\"days\":3,\"night\":0,\"tripleSharing\":34,\"doubleSharing\":34}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Packages"
  },
  {
    "type": "get",
    "url": "/comboPackages",
    "title": "comboPackages",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/comboPackages</p>",
    "group": "Packages",
    "name": "comboPackages________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Combo Packages Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"agencyName\":\"Rajan Middha\",\"id\":4,\"name\":\"fgh\",\"title\":\"fghfg\",\"description\":\"fgh\",\"days\":3,\"night\":0,\"campDescription\":\"dfgdf\",\"location\":\"Shimla, Himachal Pradesh, India\",\"price\":null,\"tripleSharing\":45,\"doubleSharing\":455,\"isCamping\":\"1\"}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Packages"
  },
  {
    "type": "get",
    "url": "/listActivities",
    "title": "listActivities",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/listActivities</p>",
    "group": "Packages",
    "name": "listActivities________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "activityId",
            "description": "<p>Activity ID string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "Integer",
            "optional": false,
            "field": "page",
            "description": "<p>Page Number Integer (Default=1)</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Camping Packages Listing\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"agencyName\":\"Rajan Middha\",\"id\":2,\"name\":\"sdfs\",\"title\":\"fsd\",\"description\":\"fsdfsdf\",\"location\":\"\",\"days\":3,\"night\":0,\"tripleSharing\":34,\"doubleSharing\":34}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Packages"
  },
  {
    "type": "get",
    "url": "/check",
    "title": "check",
    "description": "<p>http://54.172.221.76:10005/api/v1/check</p>",
    "group": "Test",
    "name": "check________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "Test"
  },
  {
    "type": "post",
    "url": "/editProfile",
    "title": "editProfile",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/editProfile</p>",
    "group": "User",
    "name": "editProfile________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "Number",
            "optional": false,
            "field": "userId",
            "description": "<p>User ID number</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "firstName",
            "description": "<p>First Name string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "lastName",
            "description": "<p>Last Name string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>password string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>mobile number as a string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "city",
            "description": "<p>City name as a string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "deviceToken",
            "description": "<p>device token string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "deviceType",
            "description": "<p>device type 0=android,1=IOs it would be also a string</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/forgotPassword",
    "title": "forgotPassword",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>forgotPassword</p>",
    "group": "User",
    "name": "forgotPassword________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email Id string</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/login",
    "title": "login",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/login</p>",
    "group": "User",
    "name": "login________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>phone string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "loginType",
            "description": "<p>Login Type string ('1'=&gt;By Email,'2'=&gt;By phone)</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>password string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "deviceToken",
            "description": "<p>device token string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "deviceType",
            "description": "<p>device type 1=android,2=IOS</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Login Successfully\",\"AppVersion\":\"1.0.0\",\"Result\":{\"userId\":1,\"name\":\"Rajan Middha\",\"phone\":9876543214,\"deviceToken\":\"sdfsdfsd\",\"deviceType\":\"1\",\"email\":\"rajanmidd@gmail.com\",\"token\":\"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUmFqYW4gTWlkZGhhIiwicGhvbmUiOjk4NzY1NDMyMTQsImVtYWlsIjoicmFqYW5taWRkQGdtYWlsLmNvbSIsImlhdCI6MTUxOTQ3MDIyNywiZXhwIjoxNTE5NTU2NjI3fQ.IAhGIADDavVA0NEll-PU-g0H_AxHuoFycP6BzAVU7ic\",\"otp\":\"6712\",\"expiresIn\":86400}}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/logout",
    "title": "logout",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/logout</p>",
    "group": "User",
    "name": "logout________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "userId",
            "description": "<p>User id string</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/myProfile",
    "title": "myProfile",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-goweek-token",
            "description": "<p>Users unique x-goweek-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/myProfile</p>",
    "group": "User",
    "name": "myProfile________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "userId",
            "description": "<p>User ID string</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Success\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"userId\":1,\"name\":\"Rajan Middha\",\"phone\":9876543214,\"deviceToken\":\"\",\"deviceType\":\"\",\"email\":\"rajanmidd@gmail.com\"}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/signUp",
    "title": "signUp",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>application/x-www-form-urlencoded.</p>"
          }
        ]
      }
    },
    "description": "<p>http://54.172.221.76:10005/api/v1/signUp</p>",
    "group": "User",
    "name": "signUp________________________________________________________________________________________________________________________________________________________________",
    "parameter": {
      "fields": {
        "Expected parameters": [
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>First Name string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>password string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>phone as a string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "deviceToken",
            "description": "<p>device token string</p>"
          },
          {
            "group": "Expected parameters",
            "type": "String",
            "optional": false,
            "field": "deviceType",
            "description": "<p>device type 0=android,1=IOs it would be also a string</p> <hr>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "Success",
            "description": "<p>response status ( 0 for error, 1 for success )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Status",
            "description": "<p>status code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Message",
            "description": "<p>response message string</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "AppVersion",
            "description": "<p>APP version</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Result",
            "description": "<p>result</p> <hr>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"Success\":true,\"Status\":200,\"Message\":\"Sign Up Successfully\",\"AppVersion\":\"1.0.0\",\"Result\":[{\"userId\":1,\"token\":\"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUmFqYW4gTWlkZGhhIiwiZW1haWwiOiJyYWphbm1pZGRAZ21haWwuY29tIiwicGhvbmUiOiI5ODc2NTQzMjE0IiwiaWF0IjoxNTE5NDY0MjI1LCJleHAiOjE1MTk1NTA2MjV9.JrDBUhww0DTpC_Nzfi_3PEmuFqkXWKaDaL9I7IhkATk\",\"otp\":\"9923\",\"expiresIn\":86400}]}",
          "type": "json"
        }
      ]
    },
    "version": "1.0.0",
    "filename": "routes/v1/index.js",
    "groupTitle": "User"
  }
] });