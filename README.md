# Medical Leave Management System

The Medical Leave Management System is a web-based application developed to simplify and automate the medical leave application and approval process in educational institutions. It replaces the traditional paper-based workflow with a centralized digital platform where students can submit leave requests along with supporting medical documents, and authorized faculty members can review and approve them through a structured approval workflow.

The application is developed using PHP, MySQL, HTML, CSS, and Bootstrap, providing role-based access, secure authentication, and real-time leave status tracking.

---

## Features

- Secure role-based authentication
- Student registration and login
- Online medical leave application
- Medical document upload
- Multi-level leave approval workflow
- Real-time leave status tracking
- Leave request history
- Separate dashboards for different user roles
- Responsive user interface using Bootstrap

---

## User Roles

The system provides dedicated dashboards for the following users:

- Student
- Doctor
- Teacher
- Head of Department (HOD)
- Dean

Each user can access only the functionalities assigned to their role.

---

## Modules

### Authentication

- User Registration
- Secure Login
- Logout
- Session Management

### Student Module

- Submit medical leave requests
- Upload supporting medical documents
- Track application status
- View leave history

### Doctor Module

- Review leave requests
- Approve or reject applications

### Dean Module

- Review doctor-approved requests
- Approve or reject applications

### HOD Module

- Review dean-approved requests
- Approve or reject applications

### Teacher Module

- Review HOD-approved requests
- Approve or reject applications

---

## Leave Approval Workflow

```text
Student
    │
    ▼
Doctor Review
    │
    ▼
Dean Approval
    │
    ▼
HOD Approval
    │
    ▼
Teacher Approval
    │
    ▼
Final Status Updated
```

---

## Technologies Used

### Frontend

- HTML5
- CSS3
- Bootstrap 5

### Backend

- PHP

### Database

- MySQL

### Development Environment

- XAMPP
- Apache

---

## Project Structure

```text
Medical_Leave_Management_System/
│
├── auth/                 # Authentication and session management
├── config/               # Database configuration
├── dashboards/           # Role-based dashboards
├── leave/                # Leave application and approval modules
├── medical/              # Medical document handling
├── screenshots/          # Project screenshots
├── index.php             # Application entry point
├── medical.sql           # Database schema
└── README.md
```

---

## Database

The application uses MySQL for storing user information, leave requests, and uploaded medical documents.

### Main Tables

### users

Stores user credentials and role information.

### leave_requests

Stores leave applications and approval status.

### uploads

Stores uploaded medical documents.

---

## Installation

### Clone the repository

```bash
git clone https://github.com/MahimaSinghRathore/medical-leave-management-system.git
```

### Move the project

Copy the project folder into the **htdocs** directory.

Example:

```
C:\xampp\htdocs\
```

### Start XAMPP

Start the following services:

- Apache
- MySQL

### Import the database

Open **phpMyAdmin** and import:

```
medical.sql
```

### Configure the database

Update the database credentials inside the configuration file if required.

### Run the application

Open your browser and visit:

```
http://localhost/Medical_Leave_Management_System/
```

---

## Screenshots

Add screenshots of the application inside the **screenshots** folder.

Example:

- Login Page
- Student Dashboard
- Doctor Dashboard
- Leave Application Form
- Leave History
- Approval Dashboard

---

## Applications

- College Leave Management
- University Medical Leave Portal
- School Leave Approval System
- Educational Institution Management
- Digital Leave Processing

---

## Future Enhancements

- Admin Dashboard
- Email notifications
- SMS notifications
- OTP-based authentication
- PDF report generation
- Excel export
- Analytics dashboard
- Leave statistics and charts
- Cloud deployment

---

## Author

**Mahima Singh**

B.Tech Computer Science Engineering

Jaypee University of Information Technology (JUIT)

GitHub: https://github.com/MahimaSinghRathore

---

## License

This project was developed for educational purposes to demonstrate web application development using PHP, MySQL, and Bootstrap.
