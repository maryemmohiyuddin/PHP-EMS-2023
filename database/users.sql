CREATE DATABASE EMS;
USE EMS;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unique_id VARCHAR(50) UNIQUE, -- Adding a unique identifier column
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    city VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    picture BLOB -- Add the picture field to store user's profile picture
);
INSERT INTO users (name, email, gender, city, password, type) VALUES
    ('Maryam M', 'maryammohiyuddin123@Gmail.com', 'Female', 'Lahore', 'Admin@123', 'Admin'),
    ('Jane Smith', 'jane@example.com', 'Female', 'Los Angeles', 'pass456', 'User'),
    ('Alex Johnson', 'alex@example.com', 'Other', 'Chicago', 'qwerty', 'User'),
    ('Emily Williams', 'emily@example.com', 'Female', 'San Francisco', 'securepass', 'Event Organizer'),
    ('Michael Brown', 'michael@example.com', 'Male', 'Houston', 'mypass321', 'User'),
    ('Sarah Lee', 'sarah@example.com', 'Female', 'Miami', '12345', 'User'),
    ('Robert Johnson', 'robert@example.com', 'Male', 'Dallas', '98765', 'Event Organizer'),
    ('Linda Wilson', 'linda@example.com', 'Female', 'Seattle', 'testpass', 'User'),
    ('William Chen', 'william@example.com', 'Male', 'San Diego', 'pass1234', 'User'),
    ('Karen Wang', 'karen@example.com', 'Female', 'Boston', 'password', 'Event Organizer'),
    ('David Kim', 'david@example.com', 'Male', 'Atlanta', 'samplepass', 'User'),
    ('Jessica Liu', 'jessica@example.com', 'Female', 'Philadelphia', 'password123', 'User'),
    ('Daniel Lee', 'daniel@example.com', 'Male', 'Phoenix', 'test123', 'Event Organizer'),
    ('Michelle Wu', 'michelle@example.com', 'Female', 'Denver', 'mypass', 'User'),
    ('Andrew Nguyen', 'andrew@example.com', 'Male', 'Washington D.C.', 'mypassword', 'User');

CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    location VARCHAR(100) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    picture BLOB,
    organizer_name VARCHAR(100) NOT NULL,
    description TEXT,
    city VARCHAR(100) NOT NULL,
    submission_time DATETIME NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'active'
);


CREATE TABLE pending_events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    location VARCHAR(100) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    picture BLOB,
    organizer_name VARCHAR(100) NOT NULL,
    description TEXT,
    city VARCHAR(100) NOT NULL,
    submission_time DATETIME NOT NULL
);

CREATE TABLE interests (
    interest_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);
  ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;
