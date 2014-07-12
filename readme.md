## Laravel/Foundation Auth Starter - V1.0

This project is a boilerplate that includes a User authentication module.
Users can create their own accounts, edit their details or login with Facebook credentials.
Some of the features included are:
- Fully responsive (Foundation by Zurb)
- Facebook auth
- Sign up with email confirmation
- Log in with either email or username
- Reset password via email
- Edit profiles (user picture upload)
- User roles
- Swipe menu for mobile
- Spanish translation

Based on Laravel and Foundation by Zurb.
Author: Jose Calleja.

Screenshots: https://github.com/josece/Laravel-Foundation/blob/master/public/screenshot.jpg

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Install
Once you unzip the package, configure your databases, and run in a terminal

```
composer install
```

For databases fill out your data in app/config/database.php
If you are using mandrill or mailgun you can fill yout your credentials in ```app/config/services.php``` and then change the provider in ```app/config/mail.php```.
The name of your app and other default values can be changed in ```app/config/configuration.php```