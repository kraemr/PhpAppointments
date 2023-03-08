Create DATABASE AppointmentDB;
use AppointmentDB;
Create Table Appointment(Date date,Time time,Details text,Name varchar(25),Who int,EndTime time,Appointment_id int AUTO_INCREMENT PRIMARY KEY);
Create Table User(Username varchar(25) NOT NULL,User_id int AUTO_INCREMENT PRIMARY KEY,Password char(128) NOT NULL);
Create Table Permissions(owner_user_id int , viewer_user_id int, Primary Key(owner_user_id,viewer_user_id));
Create Unique Index Username_unique_idx on User(Username);
Create Unique Index Appointment_Name_unique_idx on Appointment(Name);
CREATE USER 'user'@localhost IDENTIFIED BY 'lla1061:;.231GTTg';
