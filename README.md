# Projects Filter & Fix Challenge (CES Standards)

Welcome to the technical assessment! This codebase is set up as a standard Laravel, React, and Inertia.js application. It follows our company's domain-driven architectural patterns.

Your objective is to complete a **"Filter & Fix"** challenge which should take around **15 - 20 minutes**. 

---

## 🛠️ The Challenge Tasks

### 1. Fix the Application Crash (The "Fix")
When you first boot up the application and navigate to `/projects`, you will find that the application crashes (or fails to render the client details correctly).
* **The Goal:** Diagnose why this crash is happening. Locate the root cause within our domain-driven structure and resolve it so that the page loads properly and performs with optimal database query efficiency.
* **Constraint:** Do not simply patch the frontend to ignore the missing data; resolve the underlying query issue.

### 2. Implement the Status Filter Logic (Backend)
The incoming filter request is validated and mapped to a Data Transfer Object (DTO) in the controller, but the query filtering logic is currently just a placeholder.
* **The Goal:** Implement the dynamic filtering logic inside the appropriate domain layer using the status enum provided by the `ProjectFilterData` DTO.

### 3. Wire Up the Frontend Filter Dropdown (React)
The status select dropdown in the React page does not currently trigger updates.
* **The Goal:** Wire up the `onChange` event in `Index.tsx`. Use Inertia's routing utilities to trigger a GET request that redirects the user to the projects page with the correct `status` query parameter, ensuring the dropdown retains its selected state after the page reloads.

---

## 🏗️ Architectural Rules to Follow

To pass the assessment, you must follow our strict architectural boundaries:
1. **Thin Controllers:** Controllers only route requests, validate inputs, transform inputs into DTOs, call single-use Actions, and return Inertia responses. Do not write queries or business logic in [ProjectController.php](file:///Users/richardbanks/Sites/ces_challenge/app/Domains/Projects/Http/Controllers/ProjectController.php).
2. **Form Requests:** Must validate fields and contain a `toDto()` method for mapping inputs to DTOs.
3. **DTOs:** Must be immutable (using `readonly` fields) and strongly typed.
4. **Enums:** Never use magic strings for statuses; always use the `ProjectStatus` backed enum.

---

## 🚀 Setup Instructions (Under 2 Minutes)

Get up and running by executing the following commands in your terminal:

1. **Install PHP and Node dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Initialise SQLite database & Seed Data:**
   The application uses a file-based SQLite database configured automatically in your `.env` file.
   ```bash
   php artisan migrate:fresh --seed
   ```

3. **Start the Frontend and Backend Dev Servers:**
   Use the Vite dev server to compile frontend assets:
   ```bash
   npm run dev
   ```
   And start the PHP development server:
   ```bash
   php artisan serve
   ```
    Now open your browser and navigate to:
    [http://localhost:8000/projects](http://localhost:8000/projects)
    
    *(You can log in with: **test@example.com** and password: **password**)*

---

## 🧪 Running Tests

A suite of tests has been pre-written to verify your implementation. Run them to check your progress:

```bash
php artisan test --filter=ProjectsTest
```

* **Before fixing the code:** Two tests will fail (`authenticated users can view projects list` and `projects can be filtered by active status`).
* **After your fixes:** All tests should pass!
