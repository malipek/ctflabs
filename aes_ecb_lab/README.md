# AES-128 ECB mode based attack example

Demo of AES-128 ECB choosen plaintext attack, based on example on [https://www.notsosecure.com/hacking-crypto-fun-profit/](https://www.notsosecure.com/hacking-crypto-fun-profit/)


## Running PoC
``
sudo docker-compose up
``

### First run and lab reset
``
curl http://127.0.0.1:8080/index.php?act=init
``

### Lab scenario
In web browser open [http://127.0.0.1:8080](http://127.0.0.1:8080) and try to sign in as admin.