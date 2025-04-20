<?php
    $host = "localhost";
    $port = "5432";
    $database = "ana2ag";
    $user = "ana2ag";
    $password = "qKv1enVSf4cn"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database<br>\n";
    } else {
        die("An error occurred connecting to the database");
    }

    // Drop tables and sequences (that are created later)
    $res  = pg_query($dbHandle, "drop sequence if exists hobby_user_seq;");
    $res  = pg_query($dbHandle, "drop sequence if exists hobby_seq;");
    $res  = pg_query($dbHandle, "drop sequence if exists hobby_entry_seq;");
    $res  = pg_query($dbHandle, "drop table if exists hobby_users;");
    $res  = pg_query($dbHandle, "drop table if exists hobby_entries;");
    $res  = pg_query($dbHandle, "drop table if exists hobbies;");
    

    // Create sequences
    $res  = pg_query($dbHandle, "create sequence hobby_user_seq;");
    $res  = pg_query($dbHandle, "create sequence hobby_seq;");
    $res  = pg_query($dbHandle, "create sequence hobby_entry_seq;");
    $res  = pg_query($dbHandle, "ALTER SEQUENCE hobby_seq RESTART WITH 1;");
    

    // Create tables

    $res = pg_query($dbHandle, "
    CREATE TABLE hobby_users (
            id INT PRIMARY KEY DEFAULT nextval('hobby_user_seq'),
            name TEXT,
            email TEXT UNIQUE,
            password TEXT
        );
    ");
    if (!$res) {
        echo "Error creating hobby_users: " . pg_last_error($dbHandle) . "<br>\n";
    } else {
        echo "Created table hobby_users<br>\n";
    }

    $res  = pg_query($dbHandle, "create table hobbies (
        id int primary key default nextval('hobby_seq'),
        user_id int,
        hobby_name text,
        hobby_description text);");

    if (!$res) {
        echo "Error creating hobbies: " . pg_last_error($dbHandle) . "<br>\n";
    } else {
        echo "Created table hobbies<br>\n";
    }

    $res = pg_query($dbHandle, "
        CREATE TABLE hobby_entries (
        id INT PRIMARY KEY DEFAULT nextval('hobby_entry_seq'),
        hobby_id INT REFERENCES hobbies(id),
        entry_text TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");
    if (!$res) {
        echo "Error creating hobby_entries: " . pg_last_error($dbHandle) . "<br>\n";
    } else {
        echo "Created table hobby_entries<br>\n";
    }
?>
