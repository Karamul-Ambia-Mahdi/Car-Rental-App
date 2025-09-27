# Car Rental App

A simple **Car Rental Application** built using **Laravel 10** that allows users to rent or pre-book cars. When a rent or pre-booking takes place, a confirmation email is sent to both the user and the admin.

---

## Features

- User registration, authentication, and dashboard  
- View available cars, rent immediately or pre-book a car  
- Car management (admin)  
- Booking management, status updates  
- Notification via email to both user and admin  
- Basic validations and error handling  

---

## Technologies & Dependencies

- PHP (version compatible with Laravel 10)  
- Laravel 10  
- Blade templates for frontend views  
- MySQL 
- Composer (for PHP package management)    
- Mail / SMTP for sending email notifications

---

## Installation & Setup

1. **Clone the Repository**  
   ```bash
   git clone https://github.com/Karamul-Ambia-Mahdi/Car-Rental-App.git
   cd Car-Rental-App
   ```

2. **Install Dependencies**  
   ```bash
   composer install
   ```

3. **Copy `.env` File**  
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**  
   ```bash
   php artisan key:generate
   ```

---

## Configuration & Environment

Edit your `.env` file to set up:

- Database settings
  ```ini
  DB_CONNECTION=mysql  
  DB_HOST=127.0.0.1  
  DB_PORT=3306  
  DB_DATABASE=car-rental-app
  DB_USERNAME=your_db_user  
  DB_PASSWORD=your_db_password 
  ```

- Mail / SMTP settings (for sending booking confirmation emails)
  ```ini
  MAIL_MAILER=smtp  
  MAIL_HOST=your_smtp_host  
  MAIL_PORT=your_smtp_port  
  MAIL_USERNAME=your_smtp_username  
  MAIL_PASSWORD=your_smtp_password  
  MAIL_ENCRYPTION=tls  
  MAIL_FROM_ADDRESS="noreply@example.com"  
  MAIL_FROM_NAME="Car Rental App"
  ```

- Add JWT Key
  ```ini
  JWT_KEY=123456ABCXYZAAABBBBCCCC123546
  ```

---

## Database

1. Run migrations
   ```bash
   php artisan migrate
   ```

2. You can import sample data using the `car-rental-app.sql` file in the repository.

---

## Usage / How to Run

- Start the development server:
  ```bash
  php artisan serve
  ```
App will run at:
`http://127.0.0.1:8000`

---

## Project Showcase Video

Please follow the link below to watch the project showcase video. I tried to explain as fast as possible. So it won't take too much of your time, only 6:58 min.

Project-Showcase-Video-Link : https://drive.google.com/file/d/1zFmStavSqK-kRbZimbqdJMFR2aKXYtuW/view?usp=sharing.

---
