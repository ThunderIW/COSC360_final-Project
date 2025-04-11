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
To run the project head over: [Live Website](https://cosc360.ok.ubc.ca/iwiessle/Website/homePage.php)

---
## 🔐 Admin Access 

<details>
<summary>Click to reveal admin login credentials</summary>

To test admin functionalities, use the following credentials:

**Email:**  
<code>admin@jurassiccare.com</code>

**Password:**  
<code>Admin123!</code>

> **Note:** This account has full access to the admin dashboard, including user management and dinosaur listings. Please use responsibly during testing.

</details>


---

## 👥 Team Members & Statements of Contribution

---

### 🧑‍💻 **Keeran Naidu(93948883) – Full-stack Developer**

#### Statement of Contribution

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
- Created the cart database to store wanted dinosaurs
- Built a cart system with add/remove/update quantity capabilities in `viewcart.php`.
- Allowed users to submit and view reviews in `product.php`.
- Developed `checkout.php` for final cart review and order submission.
- Restricted access to protected pages for logged-in users only.
- Added profile tables for order and review history.
- Co-authored final project documentation.

---

### 🧑‍💻 **Immanuel Wiessler(20803375) – Full-stack Developer**

#### Statement of Contribution
##### Milestone 1: Planning and Design
- Participated in project planning and initial design discussions.
- Designed the overall look and feel of the website, including its layout and navigational flow.

##### Milestone 2: Client-side Experience
- Helped set up the project repository and organized the folder structure.
- Contributed to the HTML and CSS layout for the home and login pages and implemented them into the site.
- Added client-side form validation for the login and sign-up systems using JavaScript.

##### Milestone 3: Core Functionality
- Implemented a PHP-based user authentication system with session management.
- Assisted with server deployment on the COSC360 server and resolved login bugs related to session persistence.
- Created the registration and profile update forms, including server-side validation and profile image upload functionality.
- Developed the user profile system, allowing users to update their image, email, and password. Real-time success messages were added to confirm updates.
- Enforced login session rules so users must be signed in to view or modify their profile. Conditional navigation links (e.g., sign in/register vs. profile/sign out) were implemented using a drop-down interface.

##### Milestone 4: Full Site Completion
- Modified the admin dashboard to include a popup confirmation for user deletions and added error-handling to indicate successful or failed deletions.
- Replaced the outdated MD5 password hashing system with PHP’s `password_hash()` and `password_verify()` for improved security.
- Created a password verification system in the user profile to confirm password match with a red/green border and feedback message.
- Modified `deleteFromDb.php` to ensure deletion of associated reviews and orders when a user is removed.
- Finalized updates and patches on the live server.

---

### 🧑‍💻 **Manjot Singh(99067191) – Back-end & Data Management**

#### Statement of Contribution


##### Milestone 1: Planning and Design
- Determined the idea for the website (dinosaur services) and project direction.
- Outlined essential functionalities and page requirements.
- Mapped out navigation flow and user privileges.
- Modeled the website based on anime merchandise stores for inspiration.
- Authored documentation detailing page purposes and user flows.
- Contributed minimally to UI/visuals due to visual impairment.

##### Milestone 2: Client-side Experience
- Built a static user profile page with fields like username, email, job, location, wishlist, and order history.
- Introduced product and profile pages, linked via nav bar and shop page.
- Added social media icons and client-side email validation for newsletter.
- Updated navigation bar and added static content to various pages.

##### Milestone 3: Core Functionality
- Added dinosaur images and created the dinosaur catalog database.
- Populated product entries and connected product/shop pages to DB using GET.
- Implemented search and tag-based filtering for products.
- Enabled multi-filter search with live updates.
- Refactored and simplified outdated HTML code into PHP.
- Performed bug testing and edge-case handling.
- Documented features and contributions.

##### Milestone 4: Full Site Completion
- Created `orders` and `reviews` databases.
- Made reviews on the product page display dynamically based on the dinosaur.
- Enabled logged-in users who purchased a dinosaur to submit reviews.
- Restricted review access to only verified purchasers.
- Refactored code by removing deprecated or duplicate logic.
- Implemented password hashing on sign-up and login.
- Extensively tested site behavior for edge cases and unwanted outcomes.
- Created a dinosaur recommendation quiz based on user input.
- Authored walkthrough and summary documentation.

