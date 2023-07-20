<?php
if (isset($_GET["status"])) {
    if ($_GET["status"] == "false") {
        echo "<script>alert('captcha is wrong')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ITI Smart Village</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <header>
            <img class="header__logo" src="iti-logo.png" alt="iti-logo" />
            <h1 class="header__text">ITI Smart Village</h1>
        </header>
        <hr>
        <main>
            <section>
                <h2>Become a member</h2>
                <form id="regform" action="done.php" method="post">
                    <fieldset>
                        <legend>Regestiration Form</legend>
                        <fieldset>
                            <legend>Personal Information</legend>
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" placeholder="Your first name.." />
                            <br>
                            <br>
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="Your last name.." />
                            <br>
                            <br>
                            <label style="display: block; font-weight: bold" for="Address">Address</label>
                            <br>
                            <textarea id="Address" name="Address" placeholder="Write your Address.." cols="30" rows="10"></textarea>
                            <br>
                            <br>
                            <label for="country">Country</label>
                            <select id="country" name="country">
                                <option value="egypt">Egypt</option>
                                <option value="usa">USA</option>
                                <option value="uk">UK</option>
                            </select>
                            <br>
                            <br>
                            <p id="label_specific">Gender</p>
                            <label for="male">Male</label>
                            <input value="male" type="radio" checked="true" name="gender" id="male" />
                            <label for="female">Female</label>
                            <input value="female" type="radio" name="gender" id="female" />
                            <br>
                            <br>
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend>Skills</legend>
                            <br>
                            <input type="checkbox" name="skill[]" value="PHP"> PHP
                            <input type="checkbox" name="skill[]" value="JS"> JS <br> <br>
                            <input type="checkbox" name="skill[]" value="MySQL"> MySQL
                            <input type="checkbox" name="skill[]" value="PostgreSQL"> PostgreSQL
                            <br>
                            <br>
                        </fieldset>
                        <br>
                        <fieldset>
                            <br>
                            <legend>User Login Information</legend>
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Your username.." />
                            <br>
                            <br>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Your password.." />
                            <br>
                            <br>
                            <label for="dep">department</label>
                            <input type="text" id="dep" name="dep" placeholder="open source" />
                            <br>
                            <br>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset>
                            <legend>Captcha</legend>
                            <p>9h68G0</p>
                            <p>please insert it as it is</p>
                            <input type="text" name="captcha" id="captcha" />
                        </fieldset>
                        <br>
                        <br>
                        <input type="submit" value="Submit" />
                        <input type="reset" />
                        <br>
                        <br>
                    </fieldset>
                </form>
                <br />
            </section>
        </main>
        <footer>
            <p>&copy; 2023 ITI Smart Village</p>
        </footer>
    </body>

    </html>


</body>

</html>