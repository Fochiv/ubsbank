# UBS Bank - Banking Web Application

## Overview

This is a web-based banking application for UBS Bank, designed to provide customers with an international banking interface. The application features a modern, responsive design with dual-theme support (dark/light mode), multi-language capabilities via Google Translate integration, and transaction lookup functionality. The application is built primarily with PHP for backend processing and vanilla JavaScript for frontend interactivity, styled with custom CSS following a modern design system.

## User Preferences

Preferred communication style: Simple, everyday language.

## Recent Changes (October 31, 2025)

**Complete Redesign of User-Facing Pages**
- Transformed `index.html` with modern gradient hero section, services grid, statistics cards, and testimonials
- Modernized `avancement.php` and `condition2.php` by removing background images and applying new admin theme
- Created comprehensive `user-theme.css` with dark/light theme toggle support
- Integrated and styled Google Translate widget to match modern design aesthetic
- Updated all user-facing email references from `ubsbank045@gmail.com` to `aldofoch@gmail.com`
- Changed user interface terminology from "Code swift" to "Identifiant de la transaction" (database field names unchanged)
- Implemented responsive design with mobile-first approach
- Added fixed navigation with backdrop blur effects
- Admin pages (`admin.php`) remain unchanged to preserve administrative functionality

## System Architecture

### Frontend Architecture

**Design System**
- The application implements a comprehensive theming system using CSS custom properties (CSS variables) for seamless dark/light mode switching
- Two separate theme files exist: `user-theme.css` for customer-facing pages and `admin-theme.css` for administrative interfaces
- Theme preferences are persisted in browser localStorage
- Color palette uses modern indigo/purple accent colors with professional dark backgrounds

**JavaScript Organization**
- Vanilla JavaScript with no framework dependencies for core functionality
- Modular approach with separate files: `main.js` for general utilities, `theme.js` for theme management
- Event-driven architecture for user interactions (theme toggling, search, mobile menu)

**UI Components**
- Modern navigation bar with fixed positioning and backdrop blur effects
- Responsive design using CSS Grid and Flexbox
- Bootstrap Icons for iconography
- Animation library (AOS - Animate On Scroll) for enhanced user experience

**Third-party Frontend Libraries**
- Bootstrap 5.3.2 (CSS framework)
- Bootstrap Icons
- AOS (Animate on Scroll)
- Swiper (touch slider)
- GLightbox (lightbox gallery)
- Isotope (filtering and layout)
- PureCounter (animated counters)
- Waypoints (scroll-based triggers)

### Backend Architecture

**Server-side Language**
- PHP-based backend for form processing and email functionality
- No evident framework usage - appears to use procedural/native PHP

**Code Organization**
- PHP files organized in `/php` directory
- Transaction lookup functionality through `php/code.php`
- Email functionality separated into dedicated PHPMailer directory

**Email System Design**
- PHPMailer library (versions 5.2 and 6.8 detected) for reliable email delivery
- SMTP authentication support for secure email sending
- Support for multiple mail protocols: SMTP, sendmail, PHP mail()
- HTML email templates with UTF-8 encoding support
- OAuth2 integration capabilities for modern email providers (Gmail, Yahoo, Azure)

### Design Patterns

**Theme Management Pattern**
- CSS variable-based theming allows runtime theme switching without page reload
- Data attributes (`data-theme="light"` or `data-theme="dark"`) on root element control global theme state
- Preference persistence through Web Storage API (localStorage)

**Responsive Design Pattern**
- Mobile-first approach with progressive enhancement
- Breakpoint-based media queries for tablet and desktop layouts
- Toggle-based mobile menu system

**Form Handling Pattern**
- Client-side validation before submission
- PHP backend processing for form data
- Email notification system for transaction confirmations

## External Dependencies

### CSS Frameworks and Libraries
- **Bootstrap 5.3.2**: Primary CSS framework providing grid system and responsive utilities
- **Bootstrap Icons 1.11.1**: Icon library for UI elements
- **Boxicons**: Additional icon set
- **AOS**: Animation library for scroll-triggered animations
- **Swiper 8.4.7**: Touch-enabled slider/carousel component
- **GLightbox**: Lightbox solution for images and videos with Plyr integration

### JavaScript Libraries
- **Isotope 3.0.6**: Filtering and sorting layouts
- **PureCounter 1.5.0**: Animated number counters
- **Waypoints 4.0.1**: Scroll-based event triggers
- **XRegExp**: Enhanced regular expression support

### Email Services
- **PHPMailer**: Primary email library (dual versions 5.2 and 6.8 present)
  - Composer-managed dependency in `/php/phpMailler/vendor`
  - Supports SMTP, sendmail, and mail() protocols
  - OAuth2 authentication for Gmail, Yahoo, Microsoft Azure
  - DKIM signing capability
  - Multi-byte encoding support

### Integration Points
- **Google Translate API**: Embedded via `google_translate_element` for multi-language support
- **SMTP Servers**: Configurable for various email providers (Gmail, generic SMTP)
- **POP3**: Optional POP-before-SMTP authentication for legacy mail servers

### Font Services
- **Google Fonts**: Inter font family from Google Fonts CDN
- Custom icon fonts from Bootstrap Icons and Boxicons

### Composer Dependencies
The PHPMailer implementation uses Composer for dependency management with the following requirements:
- PHP >=5.5.0
- ext-ctype, ext-filter, ext-hash extensions
- Optional: ext-mbstring for multibyte encoding, ext-openssl for secure SMTP