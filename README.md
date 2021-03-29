In current directory open terminal and run  
`php -S localhost:5000`

Replace values in `config.ini`

After creating the db you can run  
`php make-tables.php`

All requests to have the format url `domain://controller/handler/other/params`  
The `controller` maps to a controller class

All controller classes have a `$this->handler` property  
Which are arrays of `[handler => controller_method]` format

The `/other/params` part of the url will be passed as arguments to the `controller_method`
