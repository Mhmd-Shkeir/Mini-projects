# User & Admin Role-Based Authentication System

## Overview
This Laravel application now includes a complete role-based authentication system with two user roles: **Admin** and **User**.

## Features Implemented

### 1. Authentication System
- **Login Page** (`/login`): Users can log in with email and password
- **Signup Page** (`/signup`): New users can register with:
  - First name and last name
  - Date of birth (age is calculated automatically)
  - Gender selection (Male/Female)
  - Email
  - Password
- **Email Verification**: Users receive verification links (email setup required)
- **Logout**: Securely log out from any dashboard

### 2. Role-Based Dashboard Routing
After login, users are automatically redirected to their respective dashboard:

#### Admin Dashboard (`/admin/dashboard`)
- **Red navbar** (danger color)
- Shows statistics:
  - Total users count
  - Verified users count
  - Unverified users count
- Access to user management panel
- Full CRUD access to all users

#### User Dashboard (`/user/dashboard`)
- **Blue navbar** (primary color)
- Display personal profile information:
  - First name, last name
  - Email, date of birth, calculated age
  - Gender
  - Account verification status
- Limited to viewing own profile

### 3. Middleware Protection
- **AdminMiddleware**: Protects admin routes, only admins can access `/admin/*` routes
- **Auth Middleware**: Protects all dashboards, users must be logged in

### 4. User Management (Admin Only)
Located at `/users`, admins can:
- View all users in a searchable grid
- Search by name or email
- Click on any user to view full profile
- Edit user information (name, DOB)
- Delete users with confirmation
- View user statistics

## Database Schema

### Users Table New Fields
- `role` (enum): 'user' or 'admin' - defaults to 'user'
- `date_of_birth` (date): User's birth date
- Age is calculated automatically from date_of_birth

## User Model Methods

```php
// Check if user is admin
$user->isAdmin()

// Check if user is regular user  
$user->isUser()

// Get calculated age (read-only attribute)
$user->age
```

## Routes Structure

### Public Routes
- `GET /` - Home/Landing page
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /signup` - Signup form
- `POST /signup` - Process signup
- `GET /user/verify/{token}` - Email verification

### User Routes (Protected with 'auth' middleware)
- `GET /user/dashboard` - User dashboard

### Admin Routes (Protected with 'auth' and 'admin' middleware)
- `GET /admin/dashboard` - Admin dashboard with statistics
- `GET /users` - Users list with search and filter
- `GET /users/{user}` - View user details
- `GET /users/{user}/edit` - Edit user form
- `PUT /users/{user}` - Update user
- `DELETE /users/{user}` - Delete user

## Demo Credentials

You can use these test accounts to explore the system:

### Admin Account
- **Email**: admin@example.com
- **Password**: password123
- **Role**: Administrator

### Regular User Account
- **Email**: john@example.com
- **Password**: password123
- **Role**: User

### Another User (Unverified)
- **Email**: jane@example.com
- **Password**: password123
- **Role**: User (not verified)

## Key Files Modified/Created

### Controllers
- `AuthController.php` - Handles login/logout
- `DashboardController.php` - Manages both dashboards
- `UserController.php` - Updated with role checks
- `MiddlewareAdminMiddleware.php` - Role verification

### Views
- `auth/login.blade.php` - Login form
- `dashboard/user.blade.php` - User dashboard
- `dashboard/admin.blade.php` - Admin dashboard
- `home.blade.php` - Updated landing page with role-based navigation

### Database
- Migration: `2025_11_12_000000_add_role_to_users_table.php` - Added role column

## User Flow

1. **Guest User**
   - Visits home page
   - Sees login/signup options
   - Can sign up or login

2. **Login Process**
   - Enters email and password
   - System verifies credentials
   - Checks user role
   - Redirects to appropriate dashboard

3. **Admin User**
   - Redirected to `/admin/dashboard`
   - Can view and manage all users
   - Has full CRUD capabilities
   - Sees system statistics

4. **Regular User**
   - Redirected to `/user/dashboard`
   - Can see their own profile
   - Can view and edit their information
   - Cannot access other users' data

## Security Features

1. **Password Hashing**: All passwords are hashed using Laravel's Hash facade
2. **CSRF Protection**: All forms include CSRF tokens
3. **Role-Based Access Control**: Middleware checks role before allowing access
4. **Input Validation**: All inputs are validated on both client and server side
5. **Model Protection**: Only authorized roles can access specific routes

## Next Steps (Optional Enhancements)

1. Add email verification functionality
2. Add password reset feature
3. Add user profile image upload
4. Add more detailed audit logs
5. Add role assignment/editing in admin panel
6. Add export users to CSV feature
