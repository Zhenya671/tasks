<form method="post">

    <input type="hidden" name="action" value="register">

    <label for='firstName'>
        First name
    </label>
    <input id='firstName' name="signUpForm[firstName]" type="text" '>

    <label for='lastName'>
        Last name
    </label>
    <input id='lastName' name="signUpForm[lastName]" type="text" '>

    <label for='email'>
        Email
    </label>
    <input id='email' name="signUpForm[email]" type="email" '>

    <label for='confirmEmail'>
        Confirm email
    </label>
    <input id='confirmEmail' name="signUpForm[confirmEmail]" type="email" '>

    <label for='password'>
        Password
    </label>
    <input id='password' name="signUpForm[password]" type="password" '>

    <label for='confirmPassword'>
        Confirm password
    </label>
    <input id='confirmPassword' name="signUpForm[confirmPassword]" type="password" '>

    <input type='submit' id='submit' value='Send' >

</form>