tech stack:
Laravel 11
Laravel Jetstream (Livewire scaffolding) - for user login
MySQL
Javascript (JQuery, AJAX)
Bootstrap Framework
Laragon

clone repository
composer update/install
create database "jobs"

run commands:
    php artisan migrate
    php artisan db:seed - for Admin user only
    npm install
    npm run build


to run project, run commands:
    if not using laragon:
        php artisan serve (http://127.0.0.1:8000 / localhost:8000)
    
    if using laragon:
        use url (job-board.test)


    npm run dev (to serve all resources - css,js,etc)



to setup email notification/sending

    1. create account in mailtrap.io
    2. create project
    3. click project and go to settings
    4. go to integration and select from integration dropdown - "Laravel 9+" option
    5. click hyperlink "Show Credentials" to get the full password value
    6. copy the .env values for "Laravel 9+" integration
    7. just change these .env variables only:
        MAIL_HOST=yourhost
        MAIL_PORT=yourport
        MAIL_USERNAME=yourusername
        MAIL_PASSWORD=yourpassword



to register another user:

    go to job-board.test/login or job-board.test/register

to post a job: (as a normal user)
    
    1. after creating a user, go to login page and you will redirected to job post section
    2. create job post, it will send an email notifcation to the job moderator (Admin user) after saving it.
    3. wait for job moderator to update it (published or spam status)


to "publish" and "mark a spam" a job post: (as a job moderator)
    
    1. after creating job post using a normal user (created using register page), logout that account and login as an admin
        email: admin@admin.com
        password: admin12345
    2. go to http://job-board.test/
    3. update job post in the datatable or go to your mailtrap inbox and click "View Job Post" button, you can also update the job post there


to view job listings - as a job seeker
    note: only published job post will be displayed in this page

    1. go to http://job-board.test/job-listing or http://localhost:8000/job-listing
    

