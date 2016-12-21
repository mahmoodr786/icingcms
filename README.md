# [IcingCMS](https://icingcms.org/): A [CakePHP](http://cakephp.org) 3 Content Management System


## Installation

 Run `git clone https://github.com/mahmoodr786/icingcms.git`.

If Composer is installed globally, run
```bash
composer install
```
Read and edit `config/app.php` and setup the 'Datasources' and any other
configuration relevant for your application. Make sure you can connect to your database.

Run
```bash
composer @icingup
```

Windows Users please run these commands manually
```bash
chmod 755 webroot/uploads
chmod 755 plugins
chmod 755 plugins/IcingManager/config/pluginLoad.json
chmod 755 plugins/IcingManager/config/themeLoad.json
cd plugins/FileManager && composer install
cd plugins/Demo && composer install
cd plugins/IcingBlue && composer install
bin/cake migrations migrate --plugin ContentManager
bin/cake migrations migrate --plugin IcingManager
bin/cake migrations migrate --plugin MenuManager
bin/cake migrations migrate --plugin UserManager
bin/cake migrations seed --plugin ContentManager
bin/cake migrations seed --plugin IcingManager
bin/cake migrations seed --plugin MenuManager
bin/cake migrations seed --plugin UserManager
```

Run
```bash
bin/cake icingcms adminuser
```

Create your Admin User.

Run
```bash
bin/cake server
```

That is it. Go to http://localhost:port/admin and login.

More installation info: [IcingCMS.org](https://icingcms.org/documentation/setup)
