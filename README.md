# Tarumaeats

![Tarumaeats Logo](https://repobeats.axiom.co/api/embed/ab2c52d0a0f2dff05a8852fbe84cff4edf25bf71.svg)

## Team 2-TI-A
- **Ivander** (535220020)
- **Justin Salim** (535220017)
- **Willsen Yogi Prasetia** (535220010)

## Introduction

Tarumaeats is a web application designed to help students and visitors at UNTAR (Universitas Tarumanagara) find places to eat within the campus. Often, hidden gems like canteens or food establishments within academic institutions can be challenging to discover, leading to students missing out on convenient dining options. Additionally, the platform serves as a hub for food and beverage business owners in the university to showcase their offerings.

## Features

- **User Registration and Authentication**: Users are required to register and verify their email addresses before accessing the platform. Authentication ensures secure access and allows users to manage their profiles.
  
- **Listing Search**: A search feature enables users to find food establishments based on various criteria such as price range, food type, special features, and opening hours.
  
- **Detailed Listings**: Detailed listings provide users with comprehensive information about each food establishment, including images, name, location, price range, tags, contact details, and a map showing the location.
  
- **Image Management**: Users can upload images for their listings, including a main image, banner image, and carousel images. Image management allows for a visually appealing representation of the food establishments.
  
- **User Profile Management**: Users can update their profile information, including email, password, and username.
  
- **Listing Management**: Business owners can manage their listings by adding, editing, creating, or deleting them. Each listing requires approval by an admin before being visible to other users, ensuring quality and relevance.

## Getting Started

To set up Tarumaeats locally, follow these steps:

1. **Clone the Repository**: 
   ```
   git clone https://github.com/your-username/tarumaeats.git
   ```

2. **Install Dependencies**: Navigate to the project directory and install the required dependencies using Composer.
   ```
   cd tarumaeats
   composer install
   ```

3. **Set Up Environment Variables**: Create a copy of the `.env.example` file and name it `.env`. Update the database and email configuration details in the `.env` file.

4. **Generate Application Key**: Generate an application key using the `php artisan key:generate` command.

5. **Migrate Database**: Run migrations to create the necessary tables in the database.
   ```
   php artisan migrate
   ```

6. **Start the Development Server**: Use the `php artisan serve` command to start the development server.
   ```
   php artisan serve
   ```

7. **Access the Application**: Open your web browser and navigate to `http://localhost:8000` to access Tarumaeats.

## Contributing

Contributions to Tarumaeats are welcome! To contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them with descriptive commit messages.
4. Push your changes to your fork.
5. Submit a pull request to the `main` branch of the original repository.

---
