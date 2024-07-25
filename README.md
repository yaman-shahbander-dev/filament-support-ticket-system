# Support Ticket System

## Introduction

This project is an admin panel built using Laravel and the Filament package, designed to provide a comprehensive and user-friendly interface for managing various aspects of an application. The admin panel includes essential features such as category management, user administration, ticket handling, and role-based permissions. Additionally, it incorporates custom widgets and console commands to enhance functionality and streamline operations.

The panel is structured to facilitate easy management and visualization of data. With the use of stub files for generating class definitions, this project allows for quick and consistent creation of metric widgets and their overviews, providing valuable insights at a glance.

## Features

* **Category Management**: Create, read, update, and delete categories for better organization of content.

* **User Management**: Administer users with capabilities to manage roles and permissions effectively.

* **Ticket Management**: Handle support tickets efficiently, ensuring a smooth user experience.

* **Role-Based Permissions**: Implement granular control over user access with customizable roles and permissions.

* **Custom Widgets**: Enhance the dashboard with metric overview widgets that serve as wrappers for other widgets, providing a comprehensive view of key metrics.

* **Console Commands**: Utilize console commands to easily create metric overview widgets and individual metric widgets, streamlining the development process.

* **Relation Managers**: Manage relationships between different resources effortlessly, improving data integrity and accessibility.

## Installation

1. **Clone the repository**:
      ```
      git clone https://github.com/yaman-shahbander-dev/filament-support-ticket-system.git
      ```

2. **Navigate to the project directory**:
      ```
      cd filament-support-ticket-system
      ```

3. **Install dependencies**:
      ```
      composer install
      ```

4. **Create a new .env file and configure the environment variables**:
      ```
      cp .env.example .env
      ```
      Open the .env file and update the following settings:
      
      * **DB_CONNECTION**: Set the database connection type (e.g., mysql, postgresql, sqlite).
      * **DB_HOST**, **DB_PORT**, **DB_DATABASE**, **DB_USERNAME**, **DB_PASSWORD**: Set the database connection details.

5. **Generate an application key**:
      ```
      php artisan key:generate
      ```

6. **Run the database migrations**:
      ```
      php artisan migrate
      ```

7. **Seed the database (optional)**:
      ```
      php artisan db:seed
      ```

8. **Create a Filament User**:
      ```
      php artisan make:filament-user
      ```

9. **Start the development server**:
      ```
      php artisan serve
      ```

10. **Access the Filament admin dashboard**:

      Open your web browser and navigate to http://localhost/admin/login
    
      Use the Filament admin credentials you have provided in step eight
