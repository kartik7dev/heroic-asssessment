


***

```markdown
# HEROIC Breach Dashboard

An interactive cybersecurity breach statistics dashboard built using **Laravel 12** and **Livewire 3.6**.  
The application displays breach events with real‑time filtering, reactivity, and analytical charts.

---

## 🚀 Features

- **Reactive Livewire Dashboard:** Instantly filters breach events by identity without reloads.  
- **Dynamic Data Visualization:** Real‑time charts for resolution status and severity trends (Chart.js).  
- **Paginated Data Table:** Responsive table showing records with Bootstrap styling.  
- **REST API Endpoint:** Fetches breach data via API for integration or external consumption.  
- **Modern Stack:** Built using Laravel 12, Livewire 3.6, and Bootstrap 5.

---

## 🧱 Tech Stack

| Layer | Technology |
|-------|-------------|
| **Backend** | Laravel 12.34 (PHP 8.2+) |
| **Frontend** | Blade + Bootstrap 5 |
| **Reactive UI** | Livewire 3.6 |
| **Charts** | Chart.js |
| **Database** | MySQL / SQLite (configurable) |

---

## ⚙️ Project Setup

### 1. Clone and Install Dependencies
```

git clone https://github.com/yourusername/heroic-dashboard.git
cd heroic-dashboard
composer install
npm install

```

### 2. Environment Configuration
```

cp .env.example .env
php artisan key:generate

```

Edit `.env` with your DB credentials.

### 3. Run Migrations and Seeders
```

php artisan migrate --seed

```

### 4. Launch the Development Server
```

php artisan serve

```
Visit **http://127.0.0.1:8000**

---

## 🧭 Folder Structure Overview

```

app/
├─ Livewire/
│   └─ HeroicDashboard.php
├─ Http/Controllers/
│   └─ Api/
│       └─ BreachEventController.php
├─ Models/
│   ├─ Identity.php
│   └─ BreachEvent.php

resources/views/
├─ layouts/app.blade.php
└─ livewire/heroic-dashboard.blade.php

routes/
├─ web.php

```

---

## 🌐 API Endpoints

| Method | Endpoint | Description |
|--------|-----------|-------------|
| **GET** | `/api/breach-events` | Fetch all breach events |
| **GET** | `/api/breach-events/{identityId}` | Fetch events for a specific identity |

**Example Response**
```

{
"data": [
{
"id": 101,
"identity_id": 5,
"source": "example.com",
"severity": "High",
"status": "Resolved",
"date": "2025-10-12T08:45:00Z"
}
],
"meta": {
"total": 50,
"per_page": 10,
"page": 1
}
}

```

*(Currently defined in `web.php` while `api.php` setup is pending.)*

---

## 🧩 Livewire Component Summary

**File:** `App\Livewire\HeroicDashboard.php`  
Handles:
- Dropdown‑based filtering using `wire:model.live`.
- Pagination (`WithPagination` trait).
- Realtime chart updates triggered by Livewire events.

---

## 🧪 Testing

Run project tests:
```

php artisan test

```

You can extend test coverage for:
- Filtering logic  
- Chart data accuracy  
- API JSON response structure  

---

## 🧑‍💻 Development Notes

- **Chart Refresh** handled via Livewire `dispatch` and JS listener inside Blade template.  
- The dropdown triggers `updatedSelectedIdentity()`, which updates tables + charts in real‑time.  
- The `BreachEventController` powers API requests with pagination‑enabled Eloquent queries.  

---

## 📘 License

Licensed under the **MIT License**.  
© 2025 HEROIC Dashboard Project.

---
```


***