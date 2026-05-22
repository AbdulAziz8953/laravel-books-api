# Laravel Books Management API

## Installation

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL

### Setup Steps

1. **Clone the repository**
```bash
git clone <repository-url>
cd laravel-books-api

2. ## Install dependencies
composer install

3. ## Environment configuration
cp .env.example .env

4. ## Configure database in .env
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

5. ## Generate Application Key
php artisan key:generate

6. ## Run migrations
php artisan migrate

7. ## JWT Setup
php artisan jwt:secret

8. ## Start server
php artisan serve


## API Documentation

### Base URL
http://localhost:8000/api

### Authentication Endpoints
POST | `/auth/register` | Register new user |
POST | `/auth/login` | Login user |
GET | `/auth/profile` | Get user profile (Protected) |

### Book Endpoints (All Protected)
POST | `/books` | Create book |
GET | `/books` | List books with pagination & search |
| GET | `/books/{id}` | Get single book |
| PUT | `/books/{id}` | Update book |
| DELETE | `/books/{id}` | Soft delete book |

### 1. Register User
POST `/api/auth/register`
Request:
```json
{
    "name": "Abdul Aziz",
    "email": "abdul@gmail.com",
    "password": "password123"
}

## 2. Login User
POST /api/auth/login
Request:
```json
{
    "email": "abdul@gmail.com",
    "password": "password123"
}

## 3. Get Profile
GET /api/auth/profile
Header:
Authorization: Bearer YOUR_TOKEN

## 4. Create Book
POST /api/books
Header:
Authorization: Bearer YOUR_TOKEN
Request:
``json
{
    "title": "I M POSSIBLE!",
    "author": "Keya Hatkar",
    "price": 415,
    "published_date": "2000-04-10",
    "cover_image": "https://example.com/cover.jpg"
}

## 5. List Books (with Search & Pagination)
GET /api/books?search=gatsby&per_page=10&page=1
Header:
Authorization: Bearer YOUR_TOKEN

## 6. Get Single Book
GET /api/books/1
Header:
Authorization: Bearer YOUR_TOKEN

## 7. Update Book
PUT /api/books/1
Header:
Authorization: Bearer YOUR_TOKEN
Request:
{
    "title": "Updated Title",
    "price": 500
}

## 8. Delete Book (Soft Delete)
DELETE /api/books/1
Header:
Authorization: Bearer YOUR_TOKEN








