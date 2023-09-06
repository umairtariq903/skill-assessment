### Introduction

Hi, my name is Umair Tariq, submitting this test project with reference of Sheikh Muhammad Umar.
The backend is built using Laravel while the frontend is built using Vue.js.
I have added 2 classes for test cases, 1 for web and other for Apis (all the routes have test cases).

Here is the video of complete working functionality using Vue js
https://drive.google.com/file/d/1RRaUAeCJXLKLo7V-HVepGQc_qzPmlco6/view

### Getting Started

1. Create a copy of the `.env.example` file as `.env`

   ```bash
   cp .env.example .env
   ```

2. Install dependencies:

   ```shell
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v $(pwd):/var/www/html \
       -w /var/www/html \
       laravelsail/php81-composer:latest \
       composer install --ignore-platform-reqs
   ```

3. Start the container (Sail):

   ```shell
   ./vendor/bin/sail up -d
   ```

4. Generate a new secret key:

   ```shell
   ./vendor/bin/sail artisan key:generate
   ```

5. Switch to Vue.js folder

   ```shell
   cd vue-project
   ```

6. Install Vue.js dependencies

   ```shell
   npm i
   ```

7. Run Vue.js frontend

   ```shell
   npm run dev
   ```

8. Access the frontend on this URL `http://localhost:5173/`

9. Use password `dummy` as login password

### Other details

I have added comments on the controller and explained the purpose of each method. I have used this api key in my test cases `c5m7NTj6AlRj6pxmWCDvyVe48ArKB6XjQbfxR96tDj4OOH5VGDb4NiYSxTeb`
