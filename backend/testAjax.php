<!DOCTYPE html>
<html>
<body>

<h1>The XMLHttpRequest Object</h1>

<button type="button" onclick="getData()">Request data</button>

<p id="demo"></p>


<script>
    $(document).ready(function getData() {
        //var xhttp = new XMLHttpRequest();
        //xhttp.onreadystatechange = function() {
        //  if (this.readyState == 4 && this.status == 200) {
        //    document.getElementById("demo").innerHTML = this.responseText;
        //  }
        //  };
        //  
        //xhttp.open("GET", "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G5A4", false);
        //xhttp.send();

        var settings = {
            "url": "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G5A4",
            "method": "GET",
            "timeout": 0,
        };


        $.ajax(settings).done(function (response) {
            alert("Hello");
            alert(response);
        });



    });
</script>

</body>
</html>