var Promise = require('promise');
var forEach = require('async-foreach').forEach;
var _ = require('lodash');

module.exports = {
	getServices: function(client,id,type) {
		return new Promise(function(resolve, reject) {
			var res=[];
			client.query("Select * from tbl_camping_service where camping_id=? and type=?", [id,type], function(error, result, fields) {
				if(error)
				{
					reject(error);
				}
				else
				{
					if(result.length>0)
					{
						var j=0;
						forEach(result, function(item, index, arr) {
							j++;
							var service_name=_.startCase((item.service_name).replace(/_/g, ' '));
							res.push(service_name)
							if(j== result.length)
							{
								resolve(res);
							}
						});
					}
					else
					{
						resolve(res);
					}
				}
			});
		});
	},
	
	getActivityVariables: function(client,id,type) {
		return new Promise(function(resolve, reject) {
			var res=[];
			client.query("Select file_url from tbl_activity_uploads where agency_activity_id=? and type=?", [id,type], function(error, result, fields) {
				if(error)
				{
					reject(error);
				}
				else
				{
					if(result.length>0)
					{
						var j=0;
						forEach(result, function(item, index, arr) {
							j++;
							res.push(item.file_url)
							if(j== result.length)
							{
								resolve(res);
							}
						});
					}
					else
					{
						resolve(res);
					}
				}
			});
		});
	},
	
	getMoreActivityByAgency: function(client,agencyId,activityId) {
		return new Promise(function(resolve, reject) {
			var res=[];
			client.query("Select id from tbl_agency_activities where activity_id=? and agency_id=?", [activityId,agencyId], function(error, result, fields) {
				if(error)
				{
					reject(error);
				}
				else
				{
					if(result.length>0)
					{
						var j=0;
						forEach(result, function(item, index, arr) {
							j++;
							res.push(item.id)
							if(j== result.length)
							{
								resolve(res);
							}
						});
					}
					else
					{
						resolve(res);
					}
				}
			});
		});
	},
};