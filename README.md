# 🛒 Laravel Digital Store

A Persian RTL e-commerce application built with **Laravel 12, Livewire 3, PHP, and MySQL**.

This project was built as a hands-on learning project to practice backend development, business logic, authentication, product and order management, filtering, cart and wishlist functionality, and payment integration.

---

## 🎬 Demo

<!-- ADD GIF HERE
Show a short real workflow:
Product page → select color/variation → add to cart → cart → checkout
Recommended length: 10–20 seconds
-->

---

## 📸 Screenshots

<!-- ADD SCREENSHOT 1: Homepage / Product listing -->

<!-- ADD SCREENSHOT 2: Product details + color/attributes -->

<!-- ADD SCREENSHOT 3: Shopping cart / Checkout -->

<!-- ADD SCREENSHOT 4: Admin panel / Product management -->

<!-- ADD SCREENSHOT 5: Order management (optional) -->

---

## ✨ Features

### 🛍️ Storefront

* Product listing and details
* Categories, brands, colors, and dynamic attributes
* Dynamic pricing based on selected product color
* Product search, filtering, and pagination
* Shopping cart with stock validation
* Wishlist
* Dynamic product discounts
* User comments
* Address management
* Authentication and registration
* Payment gateway integration

### 🔧 Admin Panel

* User management and role-based access
* Product, category, brand, and color management
* Dynamic product attributes such as RAM, storage, and CPU
* Multiple images for each product
* Order management
* Comment moderation
* Blog and article management
* Dynamic footer/content management

### 📝 Blog

* Article listing with pagination
* Filtering by category and publish date
* Article comments

---

## 🧱 Tech Stack

* **PHP 8.2+**
* **Laravel 12**
* **Livewire 3**
* **MySQL**
* **Blade**
* **Tailwind CSS**
* **Alpine.js**
* **JavaScript**
* **Vite**
* **Git**

The interface is fully **Persian and RTL** and responsive across different screen sizes.

---

## 📋 Requirements

* PHP 8.2+
* Composer
* Node.js
* MySQL 5.7+ / 8.x

---

## ⚙️ Installation

Clone the repository:

```bash
git clone https://github.com/shaho2002/laravel-store.git
cd laravel-store
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your database in `.env`, then run:

```bash
php artisan migrate
```

Start the Laravel development server:

```bash
php artisan serve
```

For frontend assets:

```bash
npm run dev
```

---

## 📌 Project Status

This is a personal learning and portfolio project focused on practicing Laravel backend development and implementing a realistic set of e-commerce features.

It is not presented as a production e-commerce platform.

---

## 🤝 Feedback

Feedback, suggestions, and improvements are welcome.

Feel free to open an Issue or Pull Request if you have an idea for improving the project.
