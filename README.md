**Features**

1) Users can get a shortened alias of a url. 
2) If user is not authenticated, then they can only shorten a url with 30 days validity. 
3) If user is authenticated, then he can see the urls he created. 
4) If user is authenticated and email is validated, then he can add private url (which only he can access), add custom url and set validity time.

Base62 encoding is used for generating shortened url, which is based on unique id. I tried to keep unique id generation logic as simple as possible.

**To run this app in local environment**
1) Make sure you have php 8.2 (or higher) with necessay extensions, composer, msyql installed on your system.
2) Clone the repo.
3) Go to the project directoy and run 'cp .env.example .env'
4) Open .env and fill out mail related keys
   
   MAIL_MAILER=
   
   MAIL_HOST=
   
   MAIL_PORT=2525
   
   MAIL_USERNAME=null
   
   MAIL_PASSWORD=null
   
   MAIL_ENCRYPTION=null
   
   MAIL_FROM_ADDRESS="hello@example.com"
   
   MAIL_FROM_NAME="${APP_NAME}"
   
You can use mailtrap for testing purpose
6) Fill out pusher related keys

   PUSHER_APP_ID=
   
   PUSHER_APP_KEY=
   
   PUSHER_APP_SECRET=
   
   PUSHER_APP_CLUSTER=
   
7) You can also fill out these fields
   
   DEFAULT_ADMIN_NAME=
   
   DEFAULT_ADMIN_EMAIL=
   
   DEFAULT_ADMIN_PASSWORD=
   
If you don't fill out these field, then admin email will be admin@demo.com and password 'aaaaaaaa'
9) Make sure BROADCAST_CONNECTION=pusher
10) Fill out db credentials.
11) Now run 'composer install'
12) Open new terminal and run 'npm install'. Run 'npm run dev' after dependencies are installed.
13) Run 'php artisan migrate' and 'php artisan db:seed'
14) Run 'php artisan serve'. Open another terminal and run 'php artisan queue:work'. 
15) Open another terminal and run 'php artisan queue:work --queue=url-shortener'.
16) Now open browser and go to localhost:8000 (port might be different).
17) Expired urls will be automatically deleted (after 48 hours of expiration). This command is run in every 6 hours. You can run 'php artisan delete-expired-urls' to test the command.
18) Go to /admin route to view admin panel. Admin can view admin panel as well as do everything an authenticated user can do.

There's also 4 apis. They are
1) /api/v1/login (method = POST) (form-data: email, password)
2) /api/v1/logout (method = POST) (Authorization: bearer token)
3) /api/v1/short-url (method = POST) (form data : original_url, shorted_url(optional), is_private(optional, boolean) and expiration (integer between 1 to 90)).
4) /api/v1/short-url (method = GET) (form-data: original_url)
