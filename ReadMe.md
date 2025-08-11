# E-School - Online Learning Management System

A comprehensive web-based learning management system designed to facilitate online education for schools. Developed using PHP, HTML5, CSS3, JavaScript, AJAX, and MySQL, this system enables seamless interaction between students, teachers, academic officers, and administrators.

## 🌟 Key Features

- **Multi-Role Access Control**: 4 distinct user types with specific permissions
- **Assignment Management**: Create, distribute, and grade assignments with deadline control
- **Notes Distribution**: Secure upload/download of study materials organized by grade
- **Payment Integration**: PayHere gateway integration for enrollment fee processing
- **Trial Period System**: 30-day free access for new students
- **Grade Management**: Teacher grading with academic officer approval workflow
- **Dark Theme Support**: User-friendly interface with dark mode option
- **Security Features**: Two-factor authentication and role-based access control

## 🛠️ Technology Stack

| Component | Technology |
|-----------|------------|
| **Frontend** | HTML5, CSS3, JavaScript, AJAX |
| **Backend** | PHP |
| **Database** | MySQL |
| **Payment Gateway** | PayHere |
| **Development IDE** | Visual Studio Code |

## 👥 User Roles & Capabilities

### 🔧 Administrator
- Complete system management and configuration
- User registration and management (teachers, officers, students)
- Class and subject assignment
- School setup and grade structure configuration
- System analytics and reporting

### 👨‍🏫 Teacher
- Upload and manage course notes by grade level
- Create and manage assignments with custom deadlines
- Grade student submissions with detailed feedback
- Monitor class progress and student performance
- Manage assigned subjects and classes

### 👨‍🎓 Student
- Access grade-specific notes and study materials
- Download and submit assignments before deadlines
- View assignment results after approval
- Manage personal profile and account settings
- Process enrollment fee payments

### 👨‍💼 Academic Officer
- Register and manage student accounts
- Approve and release assignment grades
- Monitor student enrollment and payment status
- Oversee academic processes and workflows

## 🚀 Installation Guide

### Prerequisites
- Web server with PHP 7.4+ support (Apache/Nginx)
- MySQL 5.7+ or MariaDB
- Modern web browser
- Internet connection for payment gateway

### Step-by-Step Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/JaniduChamika/e-school.git
   cd e-school
   ```

2. **Database Setup**
   ```sql
   -- Create database
   CREATE DATABASE eschool;
   
   -- Import the provided SQL file
   mysql -u username -p eschool_db < database/eschool.sql
   ```

3. **Configuration**
   - Update database credentials in `connection/connection.php`
   - Configure PayHere payment gateway settings
   - Set up email SMTP settings for user invitations

4. **Initial Access**
   - Navigate to your domain/localhost
   - Complete main admin setup
   - Configure school details and academic structure

## 📚 User Documentation

Comprehensive user manuals are available for each user role:

### 📘 Administrator Manual
**File**: [`doc/Administrator_Manual.pdf`](doc/user-manual/Admin-Manual.pdf)

### 📗 Teacher Manual
**File**: [`doc/Teacher_Manual.pdf`](doc/user-manual/Teacher-Manual.pdf)

### 📙 Student Manual
**File**: [`doc/Student_Manual.pdf`](doc/user-manual/Student-Manual.pdf)

### 📕 Academic Officer Manual
**File**: [`doc/Academic_Officer_Manual.pdf`](doc/user-manual/Academic-Officer-Manual.pdf)

## 🔐 Security Features

- **Role-Based Access Control**: Strict permission management
- **Secure Authentication**: Email verification and password policies
- **Payment Security**: HTTPS encryption for all transactions
- **Data Protection**: Regular automated backups
- **URL Protection**: Direct file access prevention
- **Two-Factor Authentication**: Enhanced admin security

## 🔄 System Architecture

The system follows a modular MVC-like structure:

```
e-school/
├── admin/              # Administrator panel
├── teacher/            # Teacher interface
├── student/            # Student portal
├── officer/            # Academic officer panel
├── assets/             # CSS, JS, images
├── connection/         # Database and system config
├── eschool.sql/        # SQL files
└── doc/                # User manuals & File storage
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 Development Guidelines

- Follow PSR-4 coding standards for PHP
- Use meaningful variable and function names
- Comment complex logic thoroughly
- Test all new features with provided test credentials
- Ensure responsive design compatibility

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in `connection/connection.php`
   - Ensure MySQL service is running

2. **File Upload Issues**
   - Verify file permissions on `uploads/` directory
   - Check PHP upload limits in `php.ini`

3. **Payment Gateway Errors**
   - Confirm PayHere credentials are correct
   - Test with sandbox credentials first

## 📞 Support

For technical support or questions:

1. 📖 Check the appropriate user manual for your role
2. 🐛 Create an issue in this repository
3. 📚 Review the troubleshooting section


### ⚠️ Important Security Notes

- 🔐 Keep login credentials confidential
- 📧 Do not share invitation emails with unauthorized persons
- 💾 Database backups are performed automatically daily
- 🔒 All payment transactions use HTTPS encryption
- 🚫 Direct access to system files is blocked via .htaccess

**Made with ❤️ for the education community**


