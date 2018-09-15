


-- Creating Company Schema

DROP SCHEMA IF EXISTS TAXI_SERVICE;
DROP TABLE if EXISTS  PERSON;
DROP TABLE if EXISTS  CUSTOMER;
DROP TABLE if EXISTS  DRIVER;
DROP TABLE if EXISTS  SERVICEREQUEST;
DROP TABLE if EXISTS  CAB;
DROP TABLE if EXISTS  CAB3;
DROP TABLE if EXISTS  SHIFTS1;
DROP TABLE if EXISTS  PAYMENT;
DROP TABLE if EXISTS  PAYMENT3;
DROP TABLE if EXISTS  ZONE;
DROP TABLE if EXISTS  ZONE1;
DROP TABLE if EXISTS  PEAK_TIME;
DROP TABLE if EXISTS  PRESENT_IN;
DROP TABLE if EXISTS  PEAK_TIME3;
DROP TABLE if EXISTS  ZONE_PEAKTIME_DECIDER;

CREATE TABLE PERSON (
  email        varchar(25) not null,
  PhoneNumber      char(10) not null,
  FirstName      char(20) not null, 
  LastName    char(10),
  BirthDate date,
  CONSTRAINT PK_Person primary key(email,PhoneNumber)

);

CREATE TABLE CUSTOMER (
  email        varchar(25) not null,
  PhoneNumber      char(10) not null,
  CustomerId    char(7),
  PromoCodes char(6),
 -- ServiceRequestNo char(9),
  CONSTRAINT PK_Customer primary key(email,PhoneNumber,CustomerId)

);

CREATE TABLE DRIVER(
  email        varchar(25) not null,
  PhoneNumber      char(10) not null,
  DriverId    char(4) not null,
 -- ServiceRequestNo char(9),
  LicenseNo char(6),
  LicenseExpiry date,
  NoOfShifts int,
  CONSTRAINT PK_Driver primary key(email,PhoneNumber,DriverId)

);


CREATE TABLE SERVICEREQUEST(
  SRId         char(6) not null,
  PickupLocation    varchar(10) ,
  DropLocation    varchar(10) ,
  Cancelled char(1),
  DriverId    char(4),
  CustomerId    char(7),
  RideStartTime time,
  RideEndTime time,
  CONSTRAINT PK_ServiceRequest primary key(SRId)

);

CREATE TABLE SHIFTS1(
DriverId    char(4),
StartTime time,
EndTime time,
CONSTRAINT PK_Shifts1 primary key(DriverId)
);

CREATE TABLE CAB(
CabId  char(5),
LicensePlate char(6),
Type char(10),
ModelName varchar(20),
NoOfSeats int,
CONSTRAINT PK_Cab primary key(CabId)
);

CREATE TABLE CAB3(
LicensePlate char(6),
State varchar(15),
CONSTRAINT PK_Cab3 primary key(LicensePlate)

);

CREATE TABLE PAYMENT (
  PAYMENT_ID       char(15) not null,
  AMOUNT           DECIMAL(6,2),
  PROMOTION_CODE_APPLIED      char(1) , 
  PAYMENT_TYPE     VARCHAR (10),
  SRId         char(6) not null,    
  
  CONSTRAINT PK_PAYMENT primary key(PAYMENT_ID)

);

CREATE TABLE PAYMENT3 (
  PAYMENT_TYPE     VARCHAR (10),
  DETAILS          VARCHAR (20),
  
  CONSTRAINT PK_PAYMENT3 primary key(PAYMENT_TYPE)

);

CREATE TABLE ZONE(
  ZONE_ID       char(7) not null,
  POPULATION         VARCHAR(7),
  
  CONSTRAINT PK_ZONE primary key(ZONE_ID)

);
CREATE TABLE ZONE1(
  ZONE_ID       char(7) not null,
  LANDMARKS       VARCHAR(10),
  CONSTRAINT PK_ZONE1 primary key(ZONE_ID)

);

CREATE TABLE PRESENT_IN (
   ZONE_ID       char(7) not null,
    DriverId    char(4)    NOT NULL,
  CONSTRAINT PK_PRESENT_IN primary key(ZONE_ID, DriverId)

);
CREATE TABLE PEAK_TIME (
   PEAKTIME_ID     CHAR(6)  NOT NULL,
   START_TIME   TIME,
   END_TIME    TIME,
   NUMBER_OF_REQUESTS    VARCHAR(4),
   
   
  CONSTRAINT PK_PEAK_TIME primary key(PEAKTIME_ID)

);

CREATE TABLE PEAK_TIME3(
  NUMBER_OF_REQUESTS    VARCHAR(4)    NOT NULL,
   CHARGE_MULTIPLIER    DECIMAL(3,2),
   
  CONSTRAINT PK_PEAK_TIME primary key(NUMBER_OF_REQUESTS)
  
);
CREATE TABLE ZONE_PEAKTIME_DECIDER (
   ZONE_ID       char(7) not null,
  PEAKTIME_ID     CHAR(6)  NOT NULL,
  CONSTRAINT PK_ZONE_PEAKTIME_DECIDER primary key(ZONE_ID, PEAKTIME_ID));