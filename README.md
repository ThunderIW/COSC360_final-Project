# 🦖 Jurassic-Care  
**COSC 360 – Final Project | Web Development**  
**Team Project Repository**

---

## 📌 Project Overview

**Jurassic-Care** is a dynamic web application simulating an online dinosaur adoption store. Users can register, log in, browse products (dinosaurs), add them to a cart, leave reviews, and complete checkouts. An admin portal supports product management and user moderation.

This site was built for the COSC 360 course at UBC Okanagan, combining front-end and back-end technologies with secure session-based features and a user-friendly interface.

---

## 🧰 Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Hosting:** COSC360 Web Server (Apache)
- **Tools:** GitHub, VS Code

---

## 🌟 Features

### 🧑 User Features
- Register and log in with session tracking
- Browse dinosaur listings with descriptions
- Add/remove dinosaurs to/from cart
- Adjust item quantities in the cart
- Submit and view reviews on dinosaurs
- View order history and review history in user profile

### 🛠 Admin Features
- Role-based access control for admins
- View and delete users
- Add new dinosaur listings
- Access admin dashboard (admin.php)

---

## 🚀 How to Run the Project

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-team-name/jurassic-care.git
   cd jurassic-care
   ```

2. **Configure the database**
   - Import the MySQL schema provided.
   - Update your `SeverConfigs.php` with your local MySQL credentials.

3. **Deploy**
   - Use an Apache server with PHP and MySQL (XAMPP, MAMP, or UBC COSC server).
   - Ensure write permissions for image or file uploads if applicable.

---

## 👥 Team Members & Statements of Contribution

---

### 🧑‍💻 **Keeran Naidu – Full-stack Developer**

#### Statement of Contribution
I contributed to our project's front-end and back-end development across all milestones.

##### Milestone 1: Planning and Design
- Proposed the structure and navigation for website pages.
- Designed mockups and outlined interconnectivity between components.
- Wrote documentation summarizing the intended functionality of each page.

##### Milestone 2: Client-side Experience
- Helped initialize the project repository and folder organization.
- Built HTML/CSS layouts for the sign-up and checkout pages.
- Added client-side form validation using JavaScript.

##### Milestone 3: Core Functionality
- Implemented `login.php` and `logout.php` using PHP and session management.

##### Milestone 4: Full Site Completion
- Added an admin role field in the users table and created `admin.php` for managing accounts and adding dinosaurs.
- Built a cart system with add/remove/update quantity capabilities in `viewcart.php`.
- Allowed users to submit and view reviews in `product.php`.
- Developed `checkout.php` for final cart review and order submission.
- Restricted access to protected pages for logged-in users only.
- Added profile tables for order and review history.
- Co-authored final project documentation.

---

### 🧑‍💻 **[Developer 2 Name] – [Role]**

#### Statement of Contribution
> _[Describe Developer 2’s contributions here. Include details per milestone (planning, frontend, backend, final site), such as which pages they created, forms validated, database tables managed, sessions implemented, and any team coordination or debugging assistance provided.]_

---

### 🧑‍💻 **[Developer 3 Name] – [Role]**

#### Statement of Contribution
> _[Describe Developer 3’s contributions here. Mention their work on layout styling, database creation, checkout logic, admin security, profile management, asynchronous features (if any), or other backend/frontend logic they helped develop or refine.]_

---

## 📄 License

This project is for academic use only and developed under the COSC 360 course at UBC Okanagan. Please do not redistribute without permission from the project authors.

---

## 📧 Contact

For any project-related questions, feel free to reach out to the contributors or your COSC 360 instructors.
