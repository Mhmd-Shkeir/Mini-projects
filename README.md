# Mini Projects - Laravel Web Applications

A collection of mini web applications built with Laravel framework, exploring various web development patterns, features, and best practices.

## 🎯 Overview

This repository contains multiple smaller Laravel projects and experiments that showcase:
- RESTful API development
- Database design and migrations
- User authentication and authorization
- Role-based access control (RBAC)
- Modern PHP practices
- Laravel ecosystem integration

## 🛠 Tech Stack

- **Framework:** Laravel (PHP)
- **Language:** PHP 8+
- **Frontend:** Blade templates, Vue.js/React components
- **Database:** MySQL/PostgreSQL
- **Build Tools:** Vite, npm/yarn
- **Development:** Composer, Artisan CLI

## 📁 Project Structure

```
├── app/                     Application logic
│   ├── Http/               HTTP controllers and middleware
│   ├── Models/             Eloquent models
│   └── Services/           Business logic services
├── database/               Database files
│   ├── migrations/         Schema migrations
│   ├── seeders/           Database seeders
│   └── factories/          Model factories
├── routes/                 Application routes
│   ├── web.php            Web routes
│   └── api.php            API routes
├── resources/              Frontend resources
│   ├── views/             Blade templates
│   ├── js/                JavaScript/Vue files
│   └── css/               Stylesheets
├── tests/                 Test suites
├── composer.json          PHP dependencies
├── package.json           Frontend dependencies
└── .env.example           Environment template
```

## 🚀 Getting Started

### Prerequisites

- PHP 8.0+
- Composer
- Node.js 14+ and npm/yarn
- MySQL/PostgreSQL
- Git

### Installation

1. Clone the repository:
```bash
git clone https://github.com/Mhmd-Shkeir/Mini-projects.git
cd Mini-projects
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install frontend dependencies:
```bash
npm install
# or
yarn install
```

4. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Setup database:
```bash
# Create database in MySQL/PostgreSQL first
# Then run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed
```

6. Start development server:
```bash
php artisan serve
```

7. Build frontend assets:
```bash
npm run dev
# or for production
npm run build
```

Visit `http://localhost:8000` in your browser.

## 📖 Features

### Common Features Across Projects

- **User Authentication**
  - Registration and login
  - Password reset functionality
  - Email verification

- **Authorization**
  - Role-based access control (Admin, User, Moderator)
  - Permission-based gates
  - Policy-based authorization

- **API Development**
  - RESTful API endpoints
  - Request validation
  - Error handling
  - API versioning

- **Database**
  - Eloquent ORM models
  - Database migrations
  - Relationship management
  - Query optimization

- **Frontend**
  - Responsive design
  - Form validation
  - AJAX interactions
  - Dark/light mode support

## 🏗️ Project Types

### Type 1: CRUD Applications
Full CRUD operations with user management and permissions.

### Type 2: API-Only Services
Headless APIs for mobile or external integrations.

### Type 3: Dashboard Applications
Administrative dashboards with analytics and reporting.

### Type 4: e-Commerce Mini Stores
Product management, shopping carts, orders.

### Type 5: Social Features
Posts, comments, follows, notifications system.

## 🔧 Configuration

### Environment Variables

```bash
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_projects
DB_USERNAME=root
DB_PASSWORD=

MAIL_DRIVER=log
MAIL_FROM_ADDRESS=noreply@example.com
```

### Database Setup

```bash
# Create database
mysql -u root -p -e "CREATE DATABASE mini_projects;"

# Run migrations
php artisan migrate

# Run specific migration
php artisan migrate --path=/database/migrations/2024_migration_file.php

# Rollback migrations
php artisan migrate:rollback
```

## 🎓 Learning Resources

### Laravel Concepts Covered

- ✅ Routing and controllers
- ✅ Eloquent ORM
- ✅ Database migrations
- ✅ Middleware
- ✅ Authentication & authorization
- ✅ API resources
- ✅ Form requests validation
- ✅ Events and listeners
- ✅ Job queues
- ✅ Testing (Unit & Feature)

### Best Practices

- MVC architecture
- Service-oriented architecture
- Repository pattern
- Dependency injection
- PSR-12 coding standards
- Security principles
- Performance optimization

## 🧪 Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/LoginTest.php

# Run with coverage
php artisan test --coverage

# Run only unit tests
php artisan test tests/Unit
```

### Test Structure

```
tests/
├── Feature/          Feature/integration tests
│   ├── AuthTest.php
│   └── UserTest.php
└── Unit/            Unit tests
    ├── ModelTest.php
    └── ServiceTest.php
```

## 📊 API Documentation

### Common Endpoints

#### Authentication
```
POST   /api/auth/register          - Register user
POST   /api/auth/login             - Login user
POST   /api/auth/logout            - Logout
GET    /api/auth/user              - Get current user
```

#### Resources
```
GET    /api/resource               - List all
POST   /api/resource               - Create new
GET    /api/resource/{id}          - Get specific
PUT    /api/resource/{id}          - Update
DELETE /api/resource/{id}          - Delete
```

## 🔐 Security Features

- CSRF protection
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade escaping)
- Password hashing (bcrypt)
- Rate limiting
- API token authentication
- CORS configuration
- Secure headers

## 🚧 Development Workflow

### Artisan Commands

```bash
# Create new model with migration
php artisan make:model Post -m

# Create controller
php artisan make:controller PostController --model=Post

# Create migration
php artisan make:migration create_posts_table

# Create seeder
php artisan make:seeder PostSeeder

# Create middleware
php artisan make:middleware CheckAdmin

# Clear cache
php artisan cache:clear
php artisan config:cache
```

## 📦 Dependencies

### Major Packages

- **laravel/framework** - Core framework
- **laravel/tinker** - Interactive shell
- **laravel/telescope** - Debugging tool
- **laravel/sanctum** - API authentication
- **laravel/passport** - OAuth2 server
- **spatie/laravel-permission** - RBAC
- **laravel/socialite** - OAuth social login

### Frontend

- **Vue.js** - Progressive JavaScript framework
- **Axios** - HTTP client
- **Tailwind CSS** - Utility CSS framework
- **Vite** - Build tool

## 🚀 Deployment

### Production Build

```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Build frontend
npm run build

# Generate cache
php artisan config:cache
php artisan route:cache

# Migrate database
php artisan migrate --force
```

### Deployment Checklist

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate application key
- [ ] Configure database
- [ ] Set up mail driver
- [ ] Configure storage
- [ ] Enable HTTPS
- [ ] Set up monitoring
- [ ] Configure backups

## 🐛 Troubleshooting

### Common Issues

**Permission denied on storage:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage
```

**Composer/npm dependency issues:**
```bash
composer install --no-interaction
npm install --no-optional
```

**Database connection error:**
```bash
# Check .env file
php artisan config:clear
php artisan cache:clear
```

**Assets not loading:**
```bash
npm run dev
# or for production
npm run build
```

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Eloquent ORM Guide](https://laravel.com/docs/eloquent)
- [Laravel Testing](https://laravel.com/docs/testing)
- [Blade Templates](https://laravel.com/docs/blade)
- [API Development](https://laravel.com/docs/api-resources)

## 🔄 Version History

- **Latest:** Master branch
- **Development:** develop branch

## 📄 License

MIT License - Use and modify freely

## 👤 Author

**Mhmd-Shkeir**

## 🤝 Contributing

Contributions welcome! Please:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Follow PSR-12 coding standards
4. Write tests for new features
5. Commit changes (`git commit -m 'Add amazing feature'`)
6. Push to branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

## 📋 Project Roadmap

- [ ] Add more mini projects
- [ ] Implement additional features
- [ ] Improve documentation
- [ ] Add comprehensive test coverage
- [ ] Performance optimization
- [ ] API versioning system
- [ ] Advanced caching strategies

## 🆘 Support

For questions or issues:
- Open an issue on GitHub
- Check documentation
- Review existing code examples
- Ask in Laravel community forums

---

**Note:** Each project in this collection is self-contained and can serve as a learning resource for specific Laravel concepts and patterns.
