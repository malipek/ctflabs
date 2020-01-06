# AES-128 CBC oracle padding attack example

Demo of AES-128 CBC oracle padding. 
It may be successfully exploited with [PadBuster](https://github.com/AonCyberLabs/PadBuster)

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
Use [PadBuster](https://github.com/AonCyberLabs/PadBuster) to decrypt token and then encrypt admin's one.