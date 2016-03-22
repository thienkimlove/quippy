<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Admin Cp</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="../js/controller.js"></script>
</head>

<body ng-app="myApp" ng-controller="myCtrl">

<div class="container">

    <div id="login-form">

        <h3>Login</h3>

        <fieldset>
            <form action="http://192.168.0.69/quippy/public/admin-page" method="get">
                <input name="name" type="text"  value="name" onBlur="if(this.value=='')this.value='Email'"
                       onFocus="if(this.value=='Email')this.value='' ">
                <!-- JS because of IE support; better: placeholder="Email" -->

                <input name="password" type="password" required value="Password" onBlur="if(this.value=='')this.value='Password'"
                       onFocus="if(this.value=='Password')this.value='' ">
                <!-- JS because of IE support; better: placeholder="Password" -->
                <input type="submit" value="Login"  >
                <p id="demo"></p>
                <footer class="clearfix">
                    <p><span class="info">?</span><a href="#">Forgot Password</a></p>
                </footer>
            </form>

        </fieldset>

    </div>
    <!-- end login-form -->

</div>


</body>
</html>
