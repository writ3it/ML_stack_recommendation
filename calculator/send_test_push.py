from pywebpush import webpush
import json

testfile = "testdata/42e70d6844e53e81fe638c01e097c72560a6e611.json"
file = open(testfile,'r')
rawdata = file.read()
file.close()
data = json.loads(rawdata)
subscription = data['subscription']

privkeyfile = open("../server/secure/private_key.vapid", 'r')
private_key = privkeyfile.read()
privkeyfile.close()

webpush(subscription, "test webpush", vapid_private_key=private_key,vapid_claims={"sub": "mailto:example@xample.com"})