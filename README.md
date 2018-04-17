# test-intelactsoft


For run the project is need to import the database from /database.sql file.
In src/config/db change the database data to connect to mysql 

After the project is created you should run in the console composer update, in the parent directory
$your-project-path composer update

If you don't have instaled composer you can get it from here https://getcomposer.org/.

To add products in database use route /save-product  with POST verb. I've use json from https://github.com/teamleadercrm/coding-test/blob/master/data/products.json
To get discounts of order use route /get-order-discounts with POST verb . I've used json from https://github.com/teamleadercrm/coding-test/tree/master/example-orders

Note : Before to get discounts of order you should add products in the database.

I've used:
PHP 7.0.10
apache2.4.23
mysql5.7.14

Please let me know if you have any question.
