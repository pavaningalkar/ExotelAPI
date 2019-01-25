package main

import (
	b64 "encoding/base64"
	"fmt"
	"io/ioutil"
	"net/http"
)

func main() {

	// Please provide accountSid, authToken from your Exotel account
	accountSid := "<your Exotel Sid>"
	authToken := "<your Exotel Token>"

	// Encoding the accountSid and authToken, used in Authorization header
	encoding := b64.StdEncoding.EncodeToString([]byte(accountSid + ":" + authToken))

	url := "https://api.exotel.com/v2/accounts/" + accountSid + "/campaigns/<campaign SID>"

	req, _ := http.NewRequest("DELETE", url, nil)

	req.Header.Add("Authorization", "Basic "+encoding)

	res, _ := http.DefaultClient.Do(req)

	defer res.Body.Close()
	body, _ := ioutil.ReadAll(res.Body)

	fmt.Println(res)
	fmt.Println(string(body))

}
