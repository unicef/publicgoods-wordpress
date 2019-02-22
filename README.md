# Digital Public Goods Wordpress Site

This repo holds an offline Wordpress site that is used to generate the static website at https://digitalpublicgoods.net. This is one of four interconnected repositories; refer to the [publicgoods-website](https://github.com/unicef/publicgoods-website) for an overview. 

This site will never be online by itself, it is instead to be run offline on any computer. It is powered by SQLite3, so that it does not require a separate database setup. The credentials for the administrative user are: 
- username: `admin`
- password: `admin`

## How to run

If you have `php` installed on your computer:
1. Run `./develop.bash`
2. Open http://localhost:8000 on your browser to access the site. 
3. Access the administrative interface through http://localhost:8000/admin
