# Learning Management System (LMS)

The Learning Management System is a comprehensive, multi-tenant **Student Information System (SIS)** and **Learning Management System (LMS)** designed for K-12 schools, universities, and large educational districts. It combines a secure, highly scalable **Django** backend with a high-performance **React.js (Vite)** frontend to manage entire institutional workflows.

## Features

### Enterprise & School Administration 

- **Multi-Tenant Architecture**: Isolate data completely for different school branches, campuses, or independent districts under a single deployment.
- **Advanced Role-Based Access Control (RBAC)**: Fine-grained permissions matching academic hierarchies: Super Admins, Principal, Registrars, Finance Officers, Teachers, Students, and Parents.
- **Parent-Teacher Portal**: Dedicated secure view for guardians to track attendance, report cards, fee balances, and communicate directly with teachers.
- **Student Information System (SIS)**: Handle admissions, digital student profiles, records management, and automatic generation of transcripts.
- **Attendance & Timetable Automation**: Automated scheduling engines to handle complex recurring timetables, class allocations, and daily biometric/digital attendance.

### Academic & LMS Features
- **Course Creation and Enrollment**: Dynamic curriculum mapping, syllabus management, and enrollment thresholds.
- **Content Delivery**: Secure streaming for course materials, integration with AWS S3 for media storage, and timed quizzes.
- **Progress Tracking & AI Analytics**: Executive dashboard monitoring class performance, attrition indicators, and performance trends.
- **Discussion Forums**: Real-time collaborative channels featuring moderation controls for compliance.

### Finance & Operations (Missing Enterprise Additions)
- **Automated Fee Management**: Invoice creation, automated payment reminders, custom fee structures, and scholarship allocations.
- **Payment Gateway Integration**: Production-ready support for Stripe, Razorpay, or PayPal with secure multi-currency processing.
- **Audit Trails & Security Compliance**: Comprehensive tracking logs logging every administrative action (who changed a grade, who authorized a refund) for compliance audits.

## Technologies Used

<p align="left">
   <a href="https://www.djangoproject.com/" target="blank" rel="noreferrer"> <img src="https://cdn.worldvectorlogo.com/logos/django.svg" alt="django" width="40" height="40"/> </a>
    <a href="https://reactjs.org/" target="blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/react/react-original-wordmark.svg" alt="react" width="40" height="40"/> </a>
   <a href="https://redux.js.org" target="blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/redux/redux-original.svg" alt="redux" width="40" height="40"/> </a>
   <a href="https://www.postgresql.org" target="blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/postgresql/postgresql-original-wordmark.svg" alt="postgresql" width="40" height="40"/> </a> 
   <a href="https://docker.com" target="blank" rel="noreferrer"> <img src="https://githubusercontent.com" alt="docker" width="40" height="40"/> </a>
   <a href="https://redis.io" target="blank" rel="noreferrer"> <img src="https://githubusercontent.com" alt="redis" width="40" height="40"/> </a>
</p>

- **Django & DRF**: Python web framework paired with Django REST Framework for building enterprise-grade APIs.
- **React.js & Redux Toolkit**: Client-side state hydration and dynamic dashboard UI architecture.
- **PostgreSQL**: Relational database engine utilizing schema-based multi-tenancy.
- **Redis & Celery**: (Added) Background task queueing engine managing heavy administrative workloads like mass-email reports, fee invoices, and PDF generation.
- **Docker**: (Added) Standardized containerization across staging, development, and production clusters.

---

## Configuration & Environment Variables

Before executing the steps below, you **must** configure your environment variables. Create a `.env` file in both the `backend` and `frontend` directories using the reference templates below:

### Backend Configuration (`backend/.env`)
```env
DEBUG=False
SECRET_KEY=your-production-super-secret-key
ALLOWED_HOSTS=://yourschool.com,localhost

# Database Configuration
DATABASE_URL=postgres://user:password@localhost:5432/school_db

# Redis & Celery
CELERY_BROKER_URL=redis://localhost:6373/0

# Storage & Payment Keys
AWS_ACCESS_KEY_ID=your_aws_key
AWS_SECRET_ACCESS_KEY=your_aws_secret
STRIPE_SECRET_KEY=sk_live_your_key
```

### Frontend Configuration (`frontend/.env`)
```env
VITE_API_BASE_URL=http://localhost:8000/api/v1
VITE_STRIPE_PUBLIC_KEY=pk_test_your_key
```

---

## Getting Started

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/learning-zone/python-project.git
   ```

2. **Backend Setup**:
   - Navigate to the `backend` directory.
   - Install dependencies:
     ```bash
     pip install poetry
     poetry install
     ```
   - Set up the database:
     ```bash
     poetry run python manage.py migrate
     ```
   - (Added) Start your background workers (Celery/Redis):
     ```bash
     poetry run celery -A school_system worker --loglevel=info
     ```
   - Run the development server:
     ```bash
     poetry run python manage.py runserver
     ```
   - Run the test suite:
     ```bash
     poetry run coverage run manage.py test
     poetry run coverage report
     ```

3. **Frontend Setup**:
   - Navigate to the `frontend` directory.
   - Install dependencies:
     ```bash
     yarn install
     ```
   - Start the frontend application locally:
     ```bash
     yarn dev
     ```

4. **Access the Application**:
   - Backend API Docs: http://localhost:8000/api/docs/
   - Frontend Client: http://localhost:5173

---

## Docker Deployment Setup

For automated cloud deployment (AWS, GCP, Render), we recommend containerization using the built-in configuration.

To spin up the entire ecosystem (Django, React, Postgres, Redis, Celery) run:
```bash
docker-compose up --build
```

---

## Development Flow

1. Create a new feature branch: `git checkout -b feature/<issue-number>-<short-description>`
2. Develop the feature, committing atomic changes.
3. Ensure backend and frontend tests pass:
   ```bash
   yarn run test
   poetry run python manage.py test
   ```
4. Create a Pull Request and get feedback.
5. After approval, merge into the `develop` branch.

## Contributing

Contributions are more than welcome! Please follow the guidelines in CONTRIBUTING.md.

## License

This project is licensed under the GPL-3.0 License. See [LICENSE](LICENSE) for details.
