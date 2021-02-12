# wp-password-test
WordPress plugin that validates password strength during login only after confirming that the credentials are correct. If the password does not match all the rules, the user should not be allowed to log in and should be presented with a warning message above the login form.

The plugin should also keep a count of the number of unsuccessful login attempts in the database.
The password check
The password must have at least;
●	1 uppercase letter
●	1 lowercase letter
●	1 number
●	1 special character from !"#$%&'()*+,-./:;<=>?@[\]^_`{|}~
●	16 characters

A single regular expression must be used to check if the password meets all the criteria. When the password is not strong enough display the following message:

Your password is not strong enough, it has a score of {score}. Please change it to be allowed to log in again.

Note: {score} is a password strength score calculated using library https://github.com/bjeavons/zxcvbn-php.

Added using composer if it not working properly please use composer update

