# energiedatenParser

This app obtains the power generation data from the website https://www.agora-energiewende.de/service/agorameter/ and stores it in the database.
The webpage has a request-form to get the data and a table with most recent records in the database for 24 hours.

## Setup

* Install XAMPP
* Save the project in the directory C:\xampp\htdocs
* Go into the folder `config`, open `config.php` and set credentials if they differ. ADMIN and ADMINPASS in credentials are the username and password for MySQL. After installing XAMPP, MySQL has a default user "root" with full permissions and a blank password. 

## Usage

### Start the app

Start XAMPP (run as administrator), start Apache and MySql. 
The database for the application will be created automatically at the first start, if there was none before.
In the browser open the url http://localhost/LF12a_2/index.php

### Request the data

Choose the period and press the button "Abfrage senden"
