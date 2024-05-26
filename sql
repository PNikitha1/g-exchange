-- Create the 'books' table to store information about books and notes being sold
CREATE TABLE books (
    title VARCHAR(255) NOT NULL,                      -- Title of the book or notes
    subject_code VARCHAR(8) NOT NULL,                 -- Subject code, typically in a format like ABCD1234
    price DECIMAL(10, 2) NOT NULL,                    -- Price of the book or notes, with two decimal places
    description TEXT NOT NULL,                        -- Description of the book or notes
    contact_name VARCHAR(100) NOT NULL,               -- Name of the person selling the book or notes
    contact_phone VARCHAR(20) NOT NULL,               -- Contact phone number of the seller
    contact_email VARCHAR(255) NOT NULL,              -- Contact email address of the seller
    filename VARCHAR(255) NOT NULL,                   -- Filename of the uploaded book or notes
    filedata LONGBLOB NOT NULL                        -- Binary data of the uploaded book or notes file
);

-- Create the 'users' table to store information about users
CREATE TABLE users (
    username VARCHAR(50) PRIMARY KEY,             -- Username, primary key
    roll_number VARCHAR(20) NOT NULL UNIQUE,          -- Roll number, must be unique
    email VARCHAR(100) NOT NULL UNIQUE,               -- Email address, must be unique
    password VARCHAR(255) NOT NULL,                   -- Password, stored securely (hashed)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP    -- Timestamp of when the user was created
);

-- Create the 'login' table for login information
CREATE TABLE login (
    username VARCHAR(50),                             -- Username, references the 'username' in the 'users' table
    password VARCHAR(20),                             -- Password
    FOREIGN KEY (username) REFERENCES users(username)  -- Foreign key constraint linking to 'username' in the 'users' table
);
