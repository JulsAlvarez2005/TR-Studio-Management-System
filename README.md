# 🎵 TR Studio Management System

A professional, full-stack web application designed to streamline operations for audio recording studios. This system handles project tracking, financial reporting, service management, and engineering team coordination.

![Dashboard Preview](https://via.placeholder.com/1000x500?text=Insert+Dashboard+Screenshot+Here)
*(Add a screenshot of your dashboard here later)*

## 🚀 Key Features

* **📊 Executive Dashboard:** Real-time financial insights using **Chart.js**. Visualize monthly revenue and active project stats at a glance.
* **🎛️ Service Catalog:** Dynamic pricing tables with toggle switches to instantly enable/disable studio services.
* **📅 Deadline Tracking:** Automated tracking of project deadlines with visual status indicators.


## 🛠️ Tech Stack

* **Framework:** [Laravel 10](https://laravel.com/) (PHP)
* **Styling:** [Tailwind CSS](https://tailwindcss.com/)
* **Interactivity:** [Alpine.js](https://alpinejs.dev/) & JavaScript
* **Charts:** [Chart.js](https://www.chartjs.org/)
* **Database:** MySQL

## 💿 Installation Guide

If you want to run this project locally, follow these steps:

1.  **Clone the repository**
    ```bash
    git clone [https://github.com/JulsAlvarez2005/TR-Studio-Management-System.git](https://github.com/JulsAlvarez2005/TR-Studio-Management-System.git)
    cd TR-Studio-Management-System
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Configuration**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure Database**
    * Create a database named `studio_management` (or whatever you prefer).
    * Update your `.env` file with your database credentials (DB_DATABASE, DB_USERNAME, etc.).

5.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

6.  **Run the App**
    * Open two terminals:
    ```bash
    # Terminal 1
    php artisan serve

    # Terminal 2
    npm run dev
    ```

## 🛡️ Security
* **CSRF Protection:** Enabled on all forms.
* **Authentication:** Powered by Laravel Breeze/Jetstream.

---
*Built by JulsAlvarez2005*