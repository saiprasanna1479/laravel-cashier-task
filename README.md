# Laravel Cashier (Stripe) 

A simple Laravel application built with **Laravel Cashier (Stripe)** that allows users to browse products, view details, and make payments via Stripe.  

The project demonstrates product listing, checkout flow, and integration with Stripe using Laravel Cashier.  

---

## 🚀 Features  

- Laravel **Cashier (Stripe)** integration  
- Product listing with name, price & "Buy Now" button  
- Product detail page with Stripe payment form  
- Payment processing via Stripe  
- Authentication using **Laravel Breeze**  
- Modern UI with **Vite + Tailwind CSS**  

---

## 🛠️ Tech Stack  

- **Laravel** 
- **Laravel Cashier (Stripe)**  
- **Laravel Breeze** (for auth scaffolding)  
- **Vite + Tailwind CSS** (for UI)  
- **MySQL** (Database)  

---

## ⚙️ Installation & Setup  

### 1️⃣ Clone the Repository  
```bash
git clone https://github.com/saiprasanna1479/laravel-cashier-task.git
```

### 2️⃣ Install Dependencies  
```bash
composer install
npm install
```

### 3️⃣ Configure Environment  
Copy the example `.env` file and update database   

```bash
cp .env.example .env
```



### 4️⃣ Run Migrations & Seed Data  
```bash
php artisan migrate:fresh --seed
```

This will create tables and populate the database with **sample products**.  

### 5️⃣ Run Vite (Tailwind CSS)  
```bash
npm run dev
```

### 6️⃣ Start the Laravel Server  
```bash
php artisan serve
```
