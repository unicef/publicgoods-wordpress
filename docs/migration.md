## Migration from Sqlite to Postgres

On Sept. 17, 2020, the infrastructure behind the [digitalpublicgoods.net](https://digitalpublicgoods.net) website was migrated from a configuration involving an offline Wordpress site configured with a sqlite database to a live instance on heroku using a MySQL database and AWS S3 storage for the media library. 

### Database

The most laborious part was converting the sqlite database into MySQL. Tried several methods, but none of them really worked. The one that got closer was as follows:

1. Dump the sqlite database: 

    ```bash 
    cd wp-content/database
    sqlite3 .ht.sqlite .dump > dump.sql
    ```

2. Run [sqlite3-ti-mysql.py](https://documentation.easyredmine.com/s/K739FRX): `cat dump.sql | python sqlite3-to-mysql.py > data.sql`, which resulted in a "good enough" MySQL file, but still had some errors in the creation of tables (the data types were not correct), but the INSERT statements were.

3. Separately do a mysqldump of a brand new Wordpress instance to have proper CREATE TABLE statements

4. Manually replace all of the table creation statments from (3) into (2). 

5. Finally, import the output of (4) into a live MySQL instance.

Still, some things were still misconfigured, and needed manual adjustment through the Wordpress manual interface.

Also, the file `wp-content/db.php` was removed, as well as the folder `wp-content/plugins/sqlite-integration`.

### S3 Integration

* The [WP Offload Media Lite](https://wordpress.org/plugins/amazon-s3-and-cloudfront/) plugin was installed.
* The `wp-content/uploads` folder was uploaded to a bucket on AWS S3
* An [.htaccess](../.htaccess) file was created to handle the redirections.
