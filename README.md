# Laravel Borrowing Management System

This project is a web application built with Laravel that facilitates the management of borrowing tools, items, and rooms. It is designed to streamline the borrowing and return process, track inventory, and manage user access.

---

## Features

- **User Management**: Admins can manage users and their roles (e.g., admin, borrower).
- **Inventory Tracking**: Add, update, and manage items, tools, or rooms available for borrowing.
- **Borrowing Requests**: Users can request to borrow items, tools, or rooms.
- **Approval Workflow**: Admins can approve or reject borrowing requests.
- **Return Management**: Track the return of borrowed items and update their availability.
- **Notifications**: Email notifications for borrowing approvals, rejections, and reminders for overdue returns.
- **Reports**: Generate detailed reports on borrowing activity, overdue items, and inventory status.

---

## Prerequisites

Before setting up the project, ensure you have the following installed:

- PHP >= 8.1
- Composer
- Laravel >= 10.x
- MySQL or any supported database
- Node.js & npm
- A web server (e.g., Apache, Nginx)

---

## Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/borrowing-management.git
   cd borrowing-management
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Environment Configuration:**
   Copy the `.env.example` file and configure it:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials and other settings.

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seed Database:**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Development Server:**
   ```bash
   php artisan serve
   ```

7. **Access the Application:**
   Open your browser and navigate to `http://localhost:8000`.

---

## Usage

### Roles:
- **Admin**: Manage users, inventory, and approve/reject borrowing requests.
- **Borrower**: Request items, tools, or rooms and return borrowed items.

### Borrowing Process:
1. Borrower logs in and views available items.
2. Borrower submits a borrowing request.
3. Admin reviews and approves/rejects the request.
4. If approved, the borrower collects the item.
5. Borrower marks the item as returned.
6. Admin confirms the return and updates the item's status.

---

## Testing

To run tests:
```bash
php artisan test
```
Ensure all tests pass before deploying the application.

---

## Deployment

1. **Set Up a Production Server:**
   Ensure the server meets the prerequisites.

2. **Deploy the Application:**
   - Upload the project files to the server.
   - Set up the `.env` file with production credentials.
   - Run migrations and seed the database.
   - Configure the web server (e.g., set up a virtual host).

3. **Optimize for Production:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## Contributing

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Make your changes and commit them:
   ```bash
   git commit -m "Add your feature description"
   ```
4. Push to your branch:
   ```bash
   git push origin feature/your-feature-name
   ```
5. Open a pull request.

---

## License

This project is licensed under the [MIT License](LICENSE).

---

## Contact

For questions or support, please contact [your-email@example.com].

