# Server

### How to generate VAPID keys
```shell
$ openssl ecparam -genkey -name prime256v1 -out private_key.pem
$ openssl ec -in private_key.pem -pubout -outform DER|tail -c 65|base64|tr -d '=' |tr '/+' '_-' | tr -d '\n'  > public_key.vapid
$ openssl ec -in private_key.pem -outform DER|tail -c +8|head -c 32|base64|tr -d '=' |tr '/+' '_-' | tr -d '\n'  > private_key.vapid
```