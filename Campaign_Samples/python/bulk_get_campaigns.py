import requests, base64, json
accountSid = "<your Exotel SID>"
accountToken = "<your Exotel token>"
encoding = base64.b64encode(accountSid + ":" + accountToken)

url = "https://api.exotel.com/v2/accounts/"+ accountSid +"/campaigns"

querystring = {"page_size":"1","page":"1"}

payload = ""
headers = {
    'Content-Type': "application/json",
    'Authorization': "Basic " + encoding
    }

response = requests.request("GET", url, data=payload, headers=headers, params=querystring)

print(response.text)
