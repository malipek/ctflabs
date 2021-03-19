# Time based enumeration attack example

Demo of the [time based users enumeration](https://blog.rapid7.com/2017/06/15/about-user-enumeration/) in case of using time-consuming password storage methotds, such as BCrypt.

## Running PoC
``
sudo docker-compose up
``

### First run and lab reset
``
curl http://127.0.0.1:8080/index.php?act=init
``

### Lab scenario
In web browser open [http://127.0.0.1:8080](http://127.0.0.1:8080) and try different logins (with any password).

Observe response time for the following logins: `admin`, `info`, `Manager`.

Change value of `act` variable to `login2` in `POST` to check how mitigation works.