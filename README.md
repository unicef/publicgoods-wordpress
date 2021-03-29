# Digital Public Goods Wordpress Site

This repo holds an offline Wordpress site that is used to generate the static website at https://digitalpublicgoods.net. This is one of four interconnected repositories; refer to the [publicgoods-website](https://github.com/unicef/publicgoods-website) for an overview.

## Overview

We chose Wordpress as a Content Management System (CMS) due to its ease of use to manage and update content. Because of this very same reason, and the fact that is a very popular choice to manage websites, it is also known for its frequent vulnerabilities, which we don not want to fall for. Additionally, instead of having to manage the hosting for this website, we leverage GitHub massive Content Delivery Network (CDN) infrastructure, which is limited to hosting static sites.

Thus, the overall structure and information flow is as follows:
- Use `publicgoods-wordpress` repository (this very same repo) to create an offline instance of our website in your local computer that we can easily edit and modify.
- Use `publicgoods-scripts` repository to generate the static copy of this site, including pulling from the latest version of the list of `publicgoods-candidates` to generate the live site.
- Upload (push) the static copy of our site to `publicgoods-website`, which effectively updates and publishes the live site

## Setup (MacOS)

To follow along these instructions you need to open [Terminal](https://support.apple.com/guide/terminal/welcome/mac), and have a basic understanding of version control systems and git: [this is a good 10min introduction](https://guides.github.com/introduction/git-handbook/).

1. Open your first window (will refer to it as *Terminal 1*) and create your base folder, and change folders into it:

    ```bash
    mkdir dpgsite
    cd dpgsite
    ```

2. Clone the 4 interconnected repositories (this step you will only do once, the rest of the steps below you will do them everytime you want to make changes to the website).

    ```bash
    git clone https://github.com/unicef/publicgoods-candidates.git
    git clone https://github.com/unicef/publicgoods-wordpress.git
    git clone https://github.com/unicef/publicgoods-website.git
    git clone https://github.com/unicef/publicgoods-scripts.git
    ```

3. Change folders into the `publicgoods-wordpress`, and launch your local instance of Wordpress
 
    ```bash
    cd publicgoods-wordpress
    git pull --rebase
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

4. Once you have made your edits in Wordpress and are ready to publish, open a second Terminal window (*Terminal 2*), and change folders to `dpgsite/publicgoods-website`, and run the following:

    ```bash
    cd dpgsite/publicgoods-website
    git pull --rebase
    ```

    This ensures that you have an up-to-date copy of this repository, and there will be no conflicts when you try to push your changes later.

5. Open a third terminal (*Terminal 3*), and change folders to `dpgsite/publicgooods-scripts`, and run the following:

    ```bash
    cd dpgsite/publicgoods-scripts
    git pull --rebase
    ```

    Again, this ensures that you have an up-to-date copy of this repository, which is used to generate the static site. Then run:

    ```bash
    
    ./static.bash && node generate_nominees.js && node index.js && npm run build && ./moveFiles.bash
    ```

    This will crawl the Wordpress site and save a local copy of the needed pages, and will populate the list of nominees. It will take a few minutes as it fetches data from online repositories to populate statistics for each of the nominees.

6. On *Terminal 2*, run the following:

    ```bash
    ./.develop.bash
    ```

    This will launch a local copy of the static site that you intend to publish. After running the above commands, visit http://localhost:8080 with your browser, and ensure that everything looks good as you expected. If something is not right, make the necessary changes in the Wordpress site, and repeat the second part of step 5, and reload this page.

    *NOTE: Please note that wordpress runs locally at http://localhost:8000 and the static site is at http://localhost:8080 (note the different ports `8000` and `8080` between both).*

6. When you are ready to publish, run the following in your *Terminal 2* (type Ctrl-C to quit the program that is running there):

    ```bash
    git commit -am 'INSERT_A_ONE_LINE_DESCRIPTOR_OF_YOUR_CHANGES_HERE'
    git push
    ```

    Replace `INSERT_A_ONE_LINE_DESCRIPTOR_OF_YOUR_CHANGES_HERE` above with a meaningful message about the changes you are pushing.
    
7. Finally, you need to also publish the changes to your local instance of Wordpress, so that others can build on these when they want to publish subsequent changes. Go back to *Terminal 1*, stop the program that is running by typing Ctrl-C, and then run:

    ```bash
    git commit -am 'INSERT_A_ONE_LINE_DESCRIPTOR_OF_YOUR_CHANGES_HERE'
    git push
    ```
    
    Again, replace `INSERT_A_ONE_LINE_DESCRIPTOR_OF_YOUR_CHANGES_HERE` above with a meaningful message about the changes you are pushing.

8. At this stage, you are done, and you can close all three Terminal windows 🙌
