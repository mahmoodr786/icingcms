# IcingCMS: A CakePHP 3 Content Management System


## Installation

1. Run `git clone https://github.com/mahmoodr786/icingcms.git`.

If Composer is installed globally, run
```bash
composer install
```
Read and edit `config/app.php` and setup the 'Datasources' and any other
configuration relevant for your application. Make sure you can connect to your database.

2. Run 
```bash
composer @icingup
```

3. Run
```bash
bin/cake icingcms adminuser
```

Create your Admin User.

4. Run
```bash
bin/cake server
```

That is it. Go to http://localhost/:port/admin and login.

