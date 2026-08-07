# MyLiveJourney

A bilingual tourism platform connecting tourists with licensed tour guides across Saudi Arabia.

## Overview

MyLiveJourney solves the coordination problem between travelers seeking authentic experiences and guides offering curated tours of historical, natural, cultural, entertainment, and religious destinations. It manages the full tourism lifecycle — destination discovery, tour creation and scheduling, a multi-state booking workflow, real-time guide-tourist communication, and an AI concierge that answers tourist questions from live database context. The platform serves three roles: administrators, tour guides, and tourists, with Arabic as the default (RTL) locale.

## Highlights

- **Multi-role authentication** — role-based access control across Admin, Guide, and Tourist with granular CRUD permissions
- **Secure account lifecycle** — token-based email activation, optional two-factor authentication, social OAuth (9 providers), reCAPTCHA, user/IP/domain blocking, and full activity logging
- **Booking workflow** — request → approve/reject/cancel lifecycle with transactional seat decrement, status transitions, and email notifications
- **Real-time chat** — Pusher-driven rooms scoped to tours with unread counts, read receipts, and policy-based access
- **AI assistant** — Google Gemini concierge with RAG-style context injected from the tourism database and persistent multi-turn conversations
- **Bilingual i18n** — full Arabic (RTL) and English support across 20+ translation files and all UI views
- **Scheduled background jobs** — automatic tour status transitions and expired activation-token cleanup
- **Image processing** — server-side resizing for place, guide, and profile uploads via Intervention Image
- **Search & filtering** — destination search with district and place-type filters

## Architecture

- **Modular monolith** built on Laravel's MVC, with domain concerns isolated under the `app/` namespace
- **Service Layer** encapsulates third-party integrations (e.g., `GeminiService`) and **Repository Pattern** isolates activation logic (`ActivationRepository`)
- **Policy-based authorization** (e.g., chat room joins) combined with role/permission middleware
- **Cross-cutting concerns** extracted into reusable traits (activation, IP capture, captcha) and enums for tour and booking state machines
- **Event-driven real-time layer** via Laravel broadcasting events (`MessageSent`, `MessagesRead`) to Pusher channels
- **Blade views with embedded Vue 3 components**, compiled through a Vite pipeline with ESLint, Prettier, and Stylelint enforcement

## Core Features

- Destination catalog organized by districts and place types
- Tour creation with pricing, seat capacity, date ranges, and multi-place associations
- Complete booking request–approval–rejection lifecycle with automatic chat-room provisioning
- Real-time tour-scoped chat between guides and confirmed tourists
- AI-powered tourist assistant answering queries from curated tourism data
- Admin user management, soft-delete/restore, and log inspection
- Per-user theme selection across a library of UI themes

## Technology Stack

| Category | Technology |
|----------|------------|
| Backend | Laravel 10, PHP 8.1, Eloquent ORM |
| Frontend | Blade, Vue 3, Bootstrap, Tailwind CSS, Vite |
| Database | MySQL |
| Authentication | Laravel Sanctum, Socialite (9 OAuth providers), 2FA, email activation |
| Infrastructure | Redis, Pusher (WebSockets), Google Gemini API, scheduled Artisan jobs |
| Libraries | Intervention Image, reCAPTCHA, laravel-roles/permissions, laravel-localization, PHPUnit |

## Engineering Focus

This project demonstrates applied software architecture: layered modular design, design patterns (Service, Repository, Policy, Trait, Enum), transactional data integrity, state-machine modeling for business entities, secure authentication flows, API-shaped controllers, clean separation of concerns, bilingual domain modeling, and a frontend pipeline with enforced linting and automated deployment scripting.

## Project Structure

- `app/` — controllers, models, services, repositories, enums, policies, middleware, events, notifications, and scheduled commands
- `routes/` — web, API, console, and broadcasting route definitions
- `resources/views/` — 215+ Blade views, including frontend, backend, auth, and chat layouts
- `database/` — migrations, factories, and seeders (roles, permissions, districts, themes)
- `tests/` — PHPUnit feature and unit tests
- `config/` — environment-driven configuration for auth, broadcasting, localization, and settings
- `.scripts/` — automated deployment script

## Quick Start

1. `composer install && npm install`
2. Configure `.env` with database, Pusher, and Gemini credentials
3. `php artisan migrate --seed`
4. `npm run dev` (or `npm run build`)
5. `php artisan serve`

## License

Released under the MIT License.
