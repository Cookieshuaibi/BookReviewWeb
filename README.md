# BookReviewWeb

## Running Instructions

### Environment Setup

#### 1. Install Dependencies

First, ensure that you have Composer installed, then run the following command to install the project dependencies:

```bash
composer update
```

#### 2. Configure Environment

Next, you need to configure the project's environment variables. Edit the `.env` file in the project root directory to set up the database connection information:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_ratings  # Database name, ensure the database has been created
DB_USERNAME=root        # Database username
DB_PASSWORD=phpts       # Database password
```

### Database Migration and Seed Data

#### 3. Database Migration

Run the following command to create the database table structure:

```bash
php artisan migrate
```

#### 4. Seed Database

Use the following command to seed the database with initial data:

```bash
php artisan db:seed
```

After execution, you can check the database to confirm whether the table structure and seed data have been created successfully.

### Starting the Development Server

#### 5. Start Laravel Development Server

Run the following command to start the Laravel development server:

```bash
php artisan serve
```

#### 6. Access the Application

After the server has started, you can view the application by accessing `http://localhost:8000` in your browser.

#### 7. Create Storage Link

To ensure that the storage system works correctly, run the following command to create a symbolic link:

```bash
php artisan storage:link
```

#### 8. Default Administrator Credentials

The application comes with a default administrator account for ease of access. The default username is `admin@admin.com` and the password is `password`.


