<?php
    $host = "db";
    $port = "5432";
    $database = "example";
    $user = "localuser";
    $password = "cs4640LocalUser!"; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database<br>\n";
    } else {
        die("An error occurred connecting to the database");
    }

    // Drop tables and sequences (that are created later)
    $res  = pg_query($dbHandle, "drop sequence if exists user_seq cascade;");
    $res  = pg_query($dbHandle, "drop sequence if exists hobby_seq cascade;");
    $res  = pg_query($dbHandle, "drop table if exists users cascade;");
    $res  = pg_query($dbHandle, "drop table if exists hobbies cascade;");

    // Create sequences
    $res  = pg_query($dbHandle, "create sequence user_seq;");
    $res  = pg_query($dbHandle, "create sequence hobby_seq;");

    // Create tables

    $res  = pg_query($dbHandle, "create table users (
            id  int primary key default nextval('user_seq'),
            name text,
            email text,
            password text,
            fav_hobby_id int);");

    $res  = pg_query($dbHandle, "create table hobbies (
        id  int primary key default nextval('hobby_seq'),
        user_id int,
        hobby_name text,
        hobby_description text);");