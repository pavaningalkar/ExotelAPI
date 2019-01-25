var request = require("request");
var accountSid = "<your Exotel Sid>";
var accountToken = "<your Exotel Token>";
var encoding = Buffer.from(accountSid + ':' + accountToken).toString('base64')

var options = { method: 'DELETE',
  url: 'https://api.exotel.com/v2/accounts/'+ accountSid +'/campaigns/<campaign SID>',
  headers: 
   { 
     Authorization: 'Basic ' + encoding 
    } };

request(options, function (error, response, body) {
  if (error) throw new Error(error);

  console.log(body);
  
});
