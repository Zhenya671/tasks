<form action="./model/User.php" method="post">

    email<input id='email' name="email" type="email"  onkeyup='checkParams()'>
    password<input id='password' name="password" type="password" onkeyup='checkParams()'>
    <input type='submit' id='submit' value='send' disabled>

</form>

<script src="./other/js/main.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
