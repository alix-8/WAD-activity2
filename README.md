# Real Estate Management System - Laravel Integration

## Requirements

### 1. Controllers (CRUD Logic)
- [x] Agent Controller
- [x] Property Controller
- [x] Amenity Controller

### 2. User Interface (Blade Views)
- [x] Agent Views (Index, Create, Edit, Show)
- [x] Property Views (Index, Create, Edit, Show)
- [x] Amenity View List
- [x] Address View List

### 3. Middleware & Security
- [x] Implement Admin Middleware
- [x] Role-based Access Control (RBAC)
- [x] Conditional UI (Hide/Show buttons based on Role)

---

# Real Estate Listing System (for Activity 2)

<img width="2964" height="1848" alt="image" src="https://github.com/user-attachments/assets/40ff4337-d472-401b-9899-76362bd01201" />

ERD
[Link here!](https://drive.google.com/file/d/1hi-ZKq3cXWmSpvZ5RMAPbagfrp5yjh6N/view?usp=sharing)


---

## Database Relationships Overview

| Relationship | Entities | Logic (Business Rule) | Laravel Method |
| :--- | :--- | :--- | :--- |
| **One-to-One (1:1)** | `Property` ↔ `Address` | A propety has one physical address record. | `hasOne()` / `belongsTo()` |
| **One-to-Many (1:N)** | `Agent` ↔ `Property` | An agent has many listings. | `hasMany()` / `belongsTo()` |
| **Many-to-Many (N:M)** | `Property` ↔ `Amenity` | A Property has many features/amenities (Pool, Gym); a feature can be common accross properties | `belongsToMany()` |

---
## Functionalities to be enhanced (outside the activity requirements)
- [ ] Constraints or limits on fill-up fields (number and character constraint)
- [ ] Message after exucutions of CRUD

## Tech Stack & Implementation

* **Framework:** Laravel 13 (Laravel Installer 5.25.1)
* **Language:** PHP 8.3
* **Database:** SQLite
