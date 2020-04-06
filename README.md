# Digital Public Goods Wordpress Site

This repo holds an offline Wordpress site that is used to generate the static website at https://digitalpublicgoods.net. This is one of four interconnected repositories; refer to the [publicgoods-website](https://github.com/unicef/publicgoods-website) for an overview.

## Overview

We chose Wordpress as a Content Management System (CMS) due to its ease of use to manage and update content. Because of this very same reason, and the fact that is a very popular choice to manage websites, it is also known for its frequent vulnerabilities, which we don not want to fall for. Additionally, instead of having to manage the hosting for this website, we leverage GitHub massive Content Delivery Network (CDN) infrastructure, which is limited to hosting static sites.

Thus, the overall structure and information flow is as follows:
- Use `publicgoods-wordpress` repository (this very same repo) to create an offline instance of our website in your local computer that we can easily edit and modify.
- Use `publicgoods-scripts` repository to generate the static copy of this site, including pulling from the latest version of the list of `publicgoods-candidates` to generate the live site.
- Upload (push) the static copy of our site to `publicgoods-website`, which effectively updates and publishes the live site

## Setup (MacOS)

To follow along these instructions you need to open [Terminal](https://support.apple.com/guide/terminal/welcome/mac). 

1. Open your first window and create your base folder, and change folders into it:

    ```bash
    mkdir dpgsite
    cd dpgsite
    ```

2. Clone the 4 interconnected repositories:

    ```bash
    git clone https://github.com/unicef/publicgoods-candidates.git
    git clone https://github.com/unicef/publicgoods-wordpress.git
    git clone https://github.com/unicef/publicgoods-website.git
    git clone https://github.com/unicef/publicgoods-scripts.git
    ```

3. Change folders into the `publicgoods-wordpress`, and launch your local instance of Wordpress
 
    ```bash
    cd publicgoods-candidates
    ./develop.bash
    ``` 
    
    which should output something like the following:

    ```bash
    PHP 5.6.30 Development Server started at Mon Apr  6 13:07:11 2020
    Listening on http://localhost:8000
    Document root is dpgsite/publicgoods-wordpress
    Press Ctrl-C to quit.
    ```

    From the message above, if you open a browser and navigate to http://localhost:8000, you should be able to access the local copy of the Wordpress site. 

    You access the administrative interface by visiting: http://localhost:8000/admin, and use the following credentials:

    * Username: `admin`
    * Password: `admin`

    Feel free to experiment with this site as much as you want. Everything is a local copy, and you can always discard your changes and start anew (more on this later).


## How to run

If you have `php` installed on your computer:
1. Run `./develop.bash`
2. Open http://localhost:8000 on your browser to access the site. 
3. Access the administrative interface through http://localhost:8000/admin
