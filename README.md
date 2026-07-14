Here is the English translation of your Markdown file, maintaining the exact formatting, badges, and code blocks:
MyLiveJourney

MyLiveJourney is an integrated tourism management system built using the Laravel 10 framework. The system provides a platform that connects tourists with tour guides, integrating artificial intelligence technologies to streamline the user experience.
🚀 Key Features
🌍 Tourism Management System

    Destination Exploration: Browse tourist attractions categorized by regions and types.

    Guided Tours: View tour details, pricing, and schedules.

    Booking Management: An integrated system for requesting and booking tours with real-time status tracking (Pending, Accepted, Rejected).

🤖 AI Assistant

    Integrated Google Gemini AI technology to provide smart answers and personalized travel recommendations to users.

💬 Real-Time Chat System

    Live chat rooms between guides and tourists powered by Pusher.

    Real-time notifications and tour status updates.

🔐 Security & User Management

    Role-Based Access Control (ACL): An advanced role system (Admin, Guide, User).

    Two-Factor Authentication (2FA): Support for 2FA to enhance account security.

    Activity Logs: Monitoring of all actions and operations within the system.

    Social Login: Support for logging in via Google, Facebook, Twitter, and more.

🎨 User Interface

    A modern design combining Bootstrap and Tailwind CSS.

    Multi-language support (Arabic, English, etc.).

    Theme management system to easily change the appearance of the platform.

🛠 Tech Stack

    Backend: Laravel 10.x, PHP 8.1+

    Frontend: Blade, Vite, Tailwind CSS, Bootstrap 4

    Database: MySQL

    Real-time: Pusher

    AI: Google Gemini PHP Client

    Localization: Mcamara Laravel Localization

⚙️ Installation Instructions

    Clone the repository:
    Bash

    git clone https://github.com/your-repo/MyLiveJourney.git

    Install dependencies:
    Bash

    composer install
    npm install

    Create the configuration file:
    Bash

    cp .env.example .env

    Generate the application key:
    Bash

    php artisan key:generate

    Set up the database in your .env file, then run migrations and seed the database:
    Bash

    php artisan migrate --seed

    Build the assets:
    Bash

    npm run dev

👥 Demo Credentials (Seeded Users)
Email	Password	Role
admin@admin.com	password	Admin
user@user.com	password	User
📜 License

This project is licensed under the MIT License.
