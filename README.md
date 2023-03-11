<img src="https://www.liverpool.ac.uk/logo-size-test/full-colour.svg" alt="mypy logo" width="300px"/>

# Food Recipe Website

## Short description

A dynamic and responsive food recipe web app backed by SQL database to search food recipes. This website was designed for the CSCK543 Networks and Web Technology Aug 2022 End-Module Assignment at the University of Liverpool.

## Brief description

A food recipe website gives the following functions to the users.

1. Signup/Sign in for the users.

2. Search the recipes based on the matched text in the recipes.

3. Add a favourite recipe to the profile for quick finding.

4. Rate the recipes.

  
  

## Table of Contents

- [Install](#install)

- [Requirements](#requirements)

- [Usage](#usage)

- [Login details](#login-details)

- [Web app testing](#web-app-testing)

- [Contribution](#contribution)

  

## Install

HTML5, CSS3 and JavaScript is used to develop the website with Visual Studio Code editor.

  

## Requirements

The web app can be run on a local browser with the following installations.

1. An Apache Web Server via [XAMPP](https://www.apachefriends.org/download.html) and place the web project under the ``` \xampp\htdocs\ ``` folder.

2. The SQL database via [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) with SQL dump files provided with the project.

  
## Usage

Follow the instructions to successfully run the web project in a local browser with a URL: 

    http://localhost/easyrecipes.com
    
1. After installation of XAMPP, start the Apache server successfully.

2. After successfully installing the MYSQL workbench, run the SQL server with the database (SQL script files) as provided in the SQL dump files.

>  **_NOTE:_**

1. The web app can give a database connectivity error if the SQL workbench is not configured correctly. Ensure the database name, SQL server username and password are properly configured in the ```config.php ``` file under ```/easyrecipes.com/include/ ``` folder.

2. Stop any other MySQL services running on the local machine.

  

## Login details

For testing purposes, the following login and username can be used.

    Email=ishaka@easyrecipes.com
    Password=P@ss#22&&

## Web App Testing
The web app compatibility and accessibility are tested with the Chrome browser for desktop and mobile users.

1. The performance and accessibility testing are executed with [Lighthouse](https://developer.chrome.com/docs/lighthouse/overview/), scoring 100 %, and [Ecograder](https://ecograder.com/) with free web hosting available on [Group C Recipe Website](https://doomed-truck.000webhostapp.com/index) respectively.

2. Google Chrome Development Tools is used to validate the web app design layout for mobile user view.

  

## Contribution
The [GitHub](https://github.com/ghafers/web_project) repository is used to develop the web app project collaboratively.

Group C © Cheylea Hopkinson, Ghafer Ahmed Khan, Khalid Younis, Shelley Allsopp
