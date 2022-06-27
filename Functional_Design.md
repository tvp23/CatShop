# Functional design Catshop
---
#### Info
| info | |  
| ----------- | ----------- |
| **Version** | 1.0 |  
| **Date** | 23/06/2022 |  
| **Name** | Twan van Paridon |
| **Student ID** | 157802 |

## Functionalities
### Pages
##### Home-page
**Requirements**
The following is required:
- The page must serve as landing page.
- The page should have a welcome message. 

##### Product-page
**Requirements**
The following is required:
- The product page should serve products to the user.
- The product page should have a search function

**Style**
The product page should have a grid of images with a title, price and discription.
For this can be use a bootstrap card. Above the grid there should be a search bar for searching products. After searching a product there should be a text displaying what you have searched.

**Security**
The Search function should be sql-injection safe, This can be done by using PDO protocol. The text displaying your search query be safe from XSS by only printing text instead of a executing code. This can be done with the following code:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; `echo htmlentities($str);`

##### File-page
**Requirements**
The following is required:
- Display files in table
- Upload files
- Download files

**Style**
The files should be dispayed in a bootstrap table and should have the following columns:

| id | Name | Tools | 
| ----------- | ----------- | ----------- | 
| 1 | example.jpg |Download, Delete ***(Icons)***|
There should also be a action above the table to add files.

When deleting a file there should be a bootstrap modal confirming your action. After deleting the file there should be a alert showing the satus of deleting the file.

When adding a file there should be a bootstrap modal containing the functionality to upload a file.

**Security**
When uploading a file it should be checked for file extention. this need to be one of the following:
-  .jpg
-  .jpeg  
-  .png
-  .gif
-  .txt

When *downloading/deleting* a file it should be containt to the 'File' directory. The user should not be able to *download/deleting* files out side of the given directory. This can be done by using the following function `basename($path);`.
##### Alert-page
**Requirements**
The following is required:
- The page should have a way to display all alerts.
- Update alerts
- Delete alerts
- Activate/deactivate alerts
- Create new alerts

**Style**
The files should be dispayed in a bootstrap table and should have the following columns:

| id | Message | Color | Active | Tools | 
| ----------- | ----------- | ----------- | ----------- | ----------- |
| 1 | example message | $color | Active | Activate, Update, Delete ***(Icons)***|

There should also be a action above the table to add alerts and disable all alerts.

When activating, deactivating and deleting a alert there should be a bootstrap modal confirming your action.

When adding and updating a alert there should be a bootstrap modal containing the form for the message and color.
**Security**
There can only be one alert active at a time.

When displaying the alert you should be conscious of XSS vulnerabilities.
!link to displaying alerts

##### Admin-page
**Requirements**
The following is required:
- Display all users
- Change user roles
- Delete users

**Style**
The users should be dispayed in a bootstrap table and should have the following columns:

| id | Email | Name | Role | Tools | 
| ----------- | ----------- | ----------- | ----------- | ----------- |
| 1 | Examle@email.com | Example Name | $role | Update, Delete ***(Icons)***|

When deleting a user there should be a bootstrap modal confirming your action.
When updating a user there should be a bootstrap modal containing the form for the role.

**Security**
You should only partially retrieve the userdata, so no information will be leaked.

### Functions
##### Roles
The role system is set in place so the user can't access all parts of the website.

There are the following roles:
- user  
- admin  
- superadmin

**Security**


##### Account info validations

## Datamodel
## Production environment