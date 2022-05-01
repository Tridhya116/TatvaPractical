## Blog Management

Blog management is to handle (create/edit/delete/view) blogs by a user.

Please check functionalities below:

1. Signup and Login
=> User can create/register their account and login through Laravel common auth.
=> After registering, they can login from the login portal.

Data tested:
Username: 99urmishah@gmail.com
Password: 12345678

Signup screen:
![image](https://user-images.githubusercontent.com/59407613/166137349-e256941d-e831-4142-b653-91f68fa1da6e.png)

Login screen:
![image](https://user-images.githubusercontent.com/59407613/166137373-b71c339a-a376-44ac-9b6a-580c7963f6d7.png)


2. Blogs page:
=> Navigation: blogs link in the header
=> Blogs list will be shown to all the users (including guests)

    ![image](https://user-images.githubusercontent.com/59407613/166137396-0a86d54c-6217-4fea-b1a6-7c04bfbad924.png)

3. Create new blog:
=> Only logged in user can create new blogs
![image](https://user-images.githubusercontent.com/59407613/166137413-e8399022-2049-4ad6-858b-45b5c6c1157f.png)
![image](https://user-images.githubusercontent.com/59407613/166137418-ed674d25-84c2-4500-b6f7-a7c8f85b62c4.png)
=> Server side and client side validations are used as per the requirements given.

4. Edit/Delete blogs:
=> Editing and Deleting options can only be visible to the person who has created that specific blog
=> Even from the url entered manually, other users can not access that specific blog which they have not created.

![image](https://user-images.githubusercontent.com/59407613/166137584-ebc4fd96-9d75-4c3c-8abf-f7125c3d2f00.png)

## Setup Instructions:
1. Setup laravel auth ui using following command:
composer require laravel/ui "^2.1" --dev
php artisan ui vue --auth
npm install && npm run dev

2. Migrate command to work with database:
php artisan migrate

3. To run an application
php artisan serve

4. copy .env.example and create one with DB connections
