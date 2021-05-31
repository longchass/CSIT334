import requests
import json
import sys

#gets number to send to
number = [str("+" + sys.argv[1])]

#gets input message
message = str(sys.argv[2])


header = {"Content-Type": "application/json; charset=utf-8",
          "Authorization": "Basic NGI2M2QyOWItZWMwNy00OWJjLTg4OGQtOWI5YTliODZiZTUw"}

#sms_from to be replaced with verified/valid number
payload = {
            "app_id": "4354d47c-391a-40fd-967f-fbe4df633c0c",
            "name": "VaXafe SMS",
            "sms_from": "+15555555555",
            "contents": { "en": message },
            "include_phone_numbers": number
          }

req = requests.post("https://onesignal.com/api/v1/notifications", headers=header, data=json.dumps(payload))

#status codes if processed or not
print(req.status_code, req.reason)