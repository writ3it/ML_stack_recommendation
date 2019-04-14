from pywebpush import webpush
import json

testfile = "testdata/fa012347649fc47eae62d37ae8ee796432a8e128.json"
file = open(testfile,'r')
rawdata = file.read()
file.close()
data = json.loads(rawdata)
subscription = data['subscription']

privkeyfile = open("../server/secure/private_key.vapid", 'r')
private_key = privkeyfile.read()
privkeyfile.close()

webpush(subscription, "test webpush", vapid_private_key=private_key,vapid_claims={"sub": "mailto:example@xample.com"})t