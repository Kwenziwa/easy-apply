# Eazi Apply - Simplifying University Applications for Matriculants

## About Us

"Eazi Apply" is a transformative web application designed to empower matriculants in South Africa by simplifying the university application process. Born from the personal experiences and challenges faced by its creators, who hail from the rural townships of KZN and are proud graduates of South African universities, this platform stands as a beacon of hope for students aiming to further their education without the hurdles of traditional application processes.

## Vision

Fostering education, one matriculant at a time: Your journey to a good career starts here. We envision a future where every aspiring student has the opportunity and the tools to pursue higher education in a field that not only matches their academic achievements but also aligns with their career aspirations.

## Mission

Our mission is to eliminate the barriers faced by matriculants during the university application process, especially during the late application period. By providing a user-friendly online platform, we aim to guide students in making informed decisions about their future, ensuring they apply to relevant courses and meet the minimum requirements set by South African institutes of higher learning.

## Features

- **Guided Application Process**: Step-by-step assistance in choosing courses that match the student's final matriculation points.
- **Course Relevance Matching**: Intelligent matching of students' academic achievements with suitable university courses.
- **Late Application Support**: Specialized support for students applying to universities during the late application period, reducing pressure and cost.
- **User-Friendly Interface**: A simple, intuitive web interface designed for ease of use, accommodating even those with minimal technical savvy.

## Why Eazi Apply?

- **Personal Experience**: Created by individuals who have navigated the challenges of university applications from rural backgrounds.
- **Community Driven**: Inspired by the desire to assist matriculants with limited access to guidance and support during their application process.
- **Cost-Effective**: Reduces the financial burden of applying to multiple institutions without certainty of acceptance.
- **Empowering**: Enables students to make informed decisions, fostering a sense of independence and confidence in their academic journey.

## Getting Started

### Prerequisites

Before you begin, ensure you have the following installed on your system:
- PHP >= 7.3
- Composer
- Node.js and npm
- A web server like Apache or Nginx
- MySQL or another compatible database system

### Installation

Follow these steps to set up the Eazi Apply project locally:

1. **Clone the Repository**

```bash
git clone https://github.com/Kwenziwa/easy-apply.git
```

2. **Navigate to the Project Directory**

```bash
cd easy-apply
```

3. **Install PHP Dependencies**

```bash
composer install
```

4. **Install JavaScript Dependencies**

```bash
npm install && npm run dev
```

5. **Create a .env File**

Copy the `.env.example` file to a new file named `.env`.

```bash
cp .env.example .env
```

6. **Generate an Application Key**

```bash
php artisan key:generate
```

7. **Set Up the Database**

Edit the `.env` file to include your database connection details. Then, run the migrations:

```bash
php artisan migrate
```

8. **Seed the Database **

If you have seed data, you can populate your database using:

```bash
php artisan db:seed
```

9. **Serve the Application**

```bash
php artisan serve
```

This command will start a development server at [http://localhost:8000](http://localhost:8000).

### Contribution

As a portfolio project concluding our specialization study period at ALX Africa, Eazi Apply is open for contributions from the developer community. Whether it's improving the platform's functionality, enhancing user experience, or adding new features, we welcome collaboration to make a meaningful impact in the lives of South African matriculants.

## Contact Us

For support, further information, or to join our cause, please reach out to us at:

- **Email**: contact@eaziapply.co.za
- **Twitter**: @EaziApply
- **Facebook**: Eazi Apply

Together, let's make higher education accessible for every aspiring student in South Africa. Your journey to a good career starts with Eazi Apply.
