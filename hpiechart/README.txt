READ ME:
*********

This software is developed and copyrighted by Hscripts.
This version is hpiechart 1.0


Features:
==========
a) This pie chart script allows scale selection.
b) You can easily modify the chart's background color, title color, font style, font size and etc...
c) It provides 3D effect.
d) Database based utility. All data are stored in database.
e) Easy to install and use.

Installation:
==============

File permissions:
a) Unzip hpiechart.zip.
b) Set read, write permission for the file hpiechart/config.php for Linux
users.

Creating a database:
a) Create database for Pie Chart Script, using any name.
b) Run the file hpiechart/install.php in your browser.
c) Enter the proper database values like Host Name, Db Name(you already created), User name, password and tablename(table will be created under this name).

Note: * If you want to insert any other table values, just enter the table name under the textbox(TableName) in install.php.
      * Edit the fieldnames in the file hpiechart/piechart.php.
      * Comment the following line in the file hpiechart/piechart.php,
               include 'create.php';
       
d) Click on "Install", you will get sucessfully installed message.


Embedding the Script:
a) You can use this script in two ways.
b) Include the following <iframe> in your page where you want to display pie chart.
   <iframe src="./hpiechart/piechart.php">
   </iframe> 
   
  Note: If you made any changes in table values, no need to edit hpiechart/piechart.php file.
    
c) If you want to display pie chart as an image.
      * After installing, run the file hpiechart/piechart.php in your browser.
      * Image will be automatically created under the folder hpiechart, for the table values.
      * Insert the image in your page, by using image tag like:                
                  <img src='hpiechart/piechart.png'>
                   
   Note: Once you made any changes in table values, run the file hpiechart/piechart.php.

d)If you want to change chart's background color, title color etc... You must follow the below steps:
      * Open the file hpiechart/piechart.php
      * Edit the RGB values based on the comment lines given inside the file hpiechart/piechart.php.


What you can do for us:
If you use our free scripts or any portion of the code, a link to
Hscripts.com will be on your website. We believe it is a fair trade for a free
script/code. Please don't remove the link. It will be great help to us.


Releases:
==========
Release Date hpiechart 1.0 : 

On any suggestions, mail to us at support@hscripts.com

Visit us at http://www.hscripts.com
Visit us at http://www.hioxindia.com
