<!-- User db table -->
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'teacher', 'student') NOT NULL,
  status TINYINT(1) DEFAULT 1,
  reset_token VARCHAR(255),
  reset_token_expires DATETIME,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

<!-- Teacher DB #designation -> role based designation  -->
CREATE TABLE teachers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL UNIQUE,
  gender ENUM('Male', 'Female', 'Other') DEFAULT 'Other',
  qualification VARCHAR(100),
  department VARCHAR(50),
  subject_speciality VARCHAR(100),
  address TEXT,
  permanent_address TEXT,
  profile_pic VARCHAR(255) DEFAULT 'default.png',
  blood_group VARCHAR(5),
  national_id VARCHAR(50) UNIQUE,
  experience_years INT DEFAULT 0,
  date_of_birth DATE,
  joining_date DATE,  
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  position VARCHAR(100),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
<!-- Student Table Creation SQL -->
CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  student_id VARCHAR(20) UNIQUE,
  roll_number VARCHAR(10),
  class VARCHAR(100),
  section VARCHAR(10),
  department VARCHAR(100),
  session_year YEAR,
  date_of_birth DATE,
  gender ENUM('Male', 'Female', 'Other') DEFAULT 'Other',
  blood_group VARCHAR(5),
  religion VARCHAR(50),
  national_id VARCHAR(50),
  address TEXT,
  permanent_address TEXT,
  guardian_name VARCHAR(100),
  guardian_phone VARCHAR(20),
  guardian_relation VARCHAR(50),
  admission_date DATE,
  photo VARCHAR(255),
  
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

<!-- Staff(Moderator And Accounts) Table creation SQL -> role based designation  -->
<!-- user teachers  tables for staff -->

<!-- class table -->
CREATE TABLE class (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    class_code VARCHAR(20) UNIQUE NOT NULL,
    section VARCHAR(10),
    class_teacher VARCHAR(100),
    room_number VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

<!-- section table -->
CREATE TABLE section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(10) NOT NULL,
    class_id INT NOT NULL,
    section_teacher VARCHAR(100),
    room_number VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE
);
