package main

import (
	b64 "encoding/base64"
	"fmt"
	"io/ioutil"
	"net/http"
	"strings"
)

func main() {

	// Please provide accountSid, authToken from your Exotel account
	accountSid := "<your Exotel Sid>"
	apiKey := "<yout API Key>"
	apiToken := "<your Exotel Token>"

	// Encoding the accountSid and authToken, used in Authorization header
	encoding := b64.StdEncoding.EncodeToString([]byte(apiKey + ":" + apiToken))

	url := "https://api.exotel.com/v2/accounts/" + accountSid + "/campaigns"

	payload := strings.NewReader(`{ 
		"campaigns": [{ 
			"caller_id": "0XXXXXXXXX1", 
			"url": "http://my.exotel.com/exoml/start_voice/208287", 
			"from": [ "+91XXXXXXXXX4", "+91XXXXXXXXX5" ], 
			"status_callback": "http://<callback custom domain>/1gvta9f1", 
			"call_status_callback": "http://<callback custom domain>/1gvta9f1"
			}]
		}`)

	req, _ := http.NewRequest("POST", url, payload)

	req.Header.Add("Content-Type", "application/json")
	req.Header.Add("Authorization", "Basic "+encoding)

	res, _ := http.DefaultClient.Do(req)

	defer res.Body.Close()
	body, _ := ioutil.ReadAll(res.Body)

	fmt.Println(res)
	fmt.Println(string(body))

}
