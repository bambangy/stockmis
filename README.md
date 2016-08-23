# STOCKMIS
_Stock Management Information System_

## Description ##
STOCKMIS or SMIS is  Management Information System of Stock. This app have small scope in managing stock information, from the beginning of increasing/decreasing stock until order stock take. Dont think about big scope app about inventory manager. This is just starter app. For educational purpose.

## Installation ##
- Just download it or clone it.
- Place it on your drive and nailed it with some mapped localhost port.
- Deploy or import file `your-app-folder\db/sql` to your database server.
- Setting some file to use.
 - Setting basic config by open this file `your-app-folder\application\config\config.php`.
   Find this line code `$config['base_url'] = 'http://localhost/simpersediaan/';` and change it to `$config['base_url'] = 'http://localhost/your-app-folder-name/`
 - Setting database by open this file `your-app-folder\application\config\database.php`.
   Find this code and change as noted,
   ```
   $db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost', // change this to your host server
	'username' => 'root', // change this to your database username
	'password' => '', // change this to to your database user password
	'database' => 'persediaandb', // change this as database deployed
	'dbdriver' => 'mysqli',
	'dbprefix' => '', // change this if you setting unique prefix to every table
  ```
- Now you can use it for development purpose

## Contact Me ##
Please contact me if you interest with this app. bambangyudhotomo@gmail.com
