import requests
import json
import sys

email_address = [str(sys.argv[1])]


header = {"Content-Type": "application/json; charset=utf-8",
          "Authorization": "Basic NGI2M2QyOWItZWMwNy00OWJjLTg4OGQtOWI5YTliODZiZTUw"}

payload = {"app_id": "4354d47c-391a-40fd-967f-fbe4df633c0c",
           "include_email_tokens": email_address,
           "email_from_name": "VaXafe",
           "email_subject": "COVID-19 Alert",
           "template_id": "e6b442a1-1ec1-4b80-8a31-5893ef4a23b4",
           "name": "COVID-19 At Location"}

req = requests.post("https://onesignal.com/api/v1/notifications", headers=header, data=json.dumps(payload))
 
#status codes if processed or not
print(req.status_code)
print(req.reason)

