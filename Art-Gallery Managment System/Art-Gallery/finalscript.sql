CREATE DATABASE my_gallery1;
use my_gallery1;
CREATE TABLE Artist (
Artist_ID INT PRIMARY KEY,
ar_name VARCHAR(255) NOT NULL,
Birthdate DATE,
Nationality VARCHAR(255),
Artistic_Style VARCHAR(255),
Biography TEXT,
Gallery_Collection TEXT
);

CREATE TABLE Exhibition (
Exhibition_ID INT PRIMARY KEY,
Artwork_ID INT NOT NULL,
ex_name VARCHAR(255) NOT NULL,
Start_Date DATE NOT NULL,
End_Date DATE NOT NULL,
Curator VARCHAR(255),
Featured_Artists TEXT,
Num_Artworks INT,
Description TEXT,
supplier_id INT,
CONSTRAINT fk_exhibition_artwork_id FOREIGN KEY (Artwork_ID) REFERENCES Artwork(Artwork_ID),
CONSTRAINT fk_exhibition_supplier_id FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id)
);

CREATE TABLE Auction (
auction_id INT PRIMARY KEY,
au_name VARCHAR(255),
au_date DATE,
auctioneer VARCHAR(255),
artwork_id INT,
reserve_price DECIMAL(10,2),
au_status ENUM('sold', 'unsold'),
supplier_id INT,
CONSTRAINT fk_auction_supplier_id FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id)
);

CREATE TABLE Customer (
customer_id INT PRIMARY KEY,
cust_name VARCHAR(50) NOT NULL,
email VARCHAR(50),
phone VARCHAR(20),
address VARCHAR(100),
notes VARCHAR(255),
created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
last_purchase_date DATE
);

CREATE TABLE Employee (
employee_id INT PRIMARY KEY,
emp_name VARCHAR(50),
contact_info VARCHAR(100),
role VARCHAR(50),
start_date DATE,
qualifications VARCHAR(100)
);

CREATE TABLE Artwork (
Artwork_ID INT PRIMARY KEY,
Title VARCHAR(255) NOT NULL,
Artist_ID INT NOT NULL,
Year_created INT,
Medium VARCHAR(255),
Dimensions VARCHAR(255),
Price DECIMAL(10, 2),
Availability BOOLEAN,
FOREIGN KEY (Artist_ID) REFERENCES Artist(Artist_ID)
);

CREATE TABLE Sale (
sale_id INT PRIMARY KEY,
customer_id INT,
artwork_id INT,
sale_price DECIMAL(10,2),
sale_date DATE,
tax DECIMAL(5,2),
fee DECIMAL(5,2),
FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
FOREIGN KEY (artwork_id) REFERENCES Artwork(artwork_id)
);

CREATE TABLE Supplier (
supplier_id INT PRIMARY KEY,
sup_name VARCHAR(255),
contact_info VARCHAR(255),
products_services VARCHAR(255)
);

CREATE TABLE Shipping (
shipping_id INT PRIMARY KEY,
artwork_id INT,
customer_id INT,
shipping_address VARCHAR(255),
tracking_number VARCHAR(50),
shipping_cost DECIMAL(10, 2),
insurance_cost DECIMAL(10, 2),
handling_cost DECIMAL(10, 2),
shipped_date DATE,
delivered_date DATE,
notes VARCHAR(255),
FOREIGN KEY (artwork_id) REFERENCES Artwork(artwork_id),
FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
);
CREATE TABLE Employee (
employee_id INT PRIMARY KEY,
emp_name VARCHAR(50),
contact_info VARCHAR(100),
role VARCHAR(50),
start_date DATE,
qualifications VARCHAR(100)
);
CREATE TABLE Restoration (
id INT PRIMARY KEY,
artwork_id INT NOT NULL,
conservator_name VARCHAR(255) NOT NULL,
date_restored DATE NOT NULL,
notes VARCHAR(1000),
FOREIGN KEY (artwork_id) REFERENCES Artwork(artwork_id)
);
CREATE TABLE finance (
  id INT PRIMARY KEY,
  pay_date DATE NOT NULL,
  revenue DECIMAL(10,2),
  expenses DECIMAL(10,2),
  net_income DECIMAL(10,2),
  budget DECIMAL(10,2),
  financial_statement TEXT
);
INSERT INTO Artist (Artist_ID, ar_name, Birthdate, Nationality, Artistic_Style, Biography, Gallery_Collection) 
VALUES
  (1, 'Leonardo da Vinci', '1452-04-15', 'Italian', 'High Renaissance', 'Leonardo da Vinci was an Italian polymath of the High Renaissance who is widely considered one of the greatest artists of all time.', 'Mona Lisa, The Last Supper'),
  (2, 'Vincent van Gogh', '1853-03-30', 'Dutch', 'Post-Impressionism', 'Vincent van Gogh was a Dutch post-impressionist painter who is among the most famous and influential figures in the history of Western art.', 'The Starry Night, Sunflowers'),
  (3, 'Pablo Picasso', '1881-10-25', 'Spanish', 'Cubism', 'Pablo Picasso was a Spanish painter, sculptor, printmaker, ceramicist and theatre designer who spent most of his adult life in France.', 'Les Demoiselles d''Avignon, Guernica'),
  (4, 'Claude Monet', '1840-11-14', 'French', 'Impressionism', 'Claude Monet was a French painter and a founder of the Impressionist movement who is known for his series of haystacks and water lilies.', 'Water Lilies, Haystacks'),
  (5, 'Salvador Dali', '1904-05-11', 'Spanish', 'Surrealism', 'Salvador Dali was a Spanish surrealist artist known for his bizarre, dreamlike paintings and sculptures.', 'The Persistence of Memory, The Elephants'),
  (6, 'Michelangelo', '1475-03-06', 'Italian', 'High Renaissance', 'Michelangelo was an Italian sculptor, painter, architect, and poet of the High Renaissance who is considered one of the greatest artists of all time.', 'David, Sistine Chapel ceiling'),
  (7, 'Frida Kahlo', '1907-07-06', 'Mexican', 'Surrealism', 'Frida Kahlo was a Mexican artist who is best known for her self-portraits and her depiction of indigenous Mexican culture.', 'The Two Fridas, Self-portrait with Thorn Necklace and Hummingbird'),
  (8, 'Rembrandt van Rijn', '1606-07-15', 'Dutch', 'Baroque', 'Rembrandt van Rijn was a Dutch painter and etcher who is generally considered one of the greatest painters and printmakers in European art history.', 'The Night Watch, Self-portrait with Two Circles'),
  (9, 'Jackson Pollock', '1912-01-28', 'American', 'Abstract expressionism', 'Jackson Pollock was an American painter and a major figure in the abstract expressionist movement.', 'No. 5, 1948, Lavender Mist'),
  (10, 'Edvard Munch', '1863-12-12', 'Norwegian', 'Expressionism', 'Edvard Munch was a Norwegian painter and printmaker whose intensely evocative treatment of psychological themes built upon some of the main tenets of late 19th-century Symbolism and greatly influenced German Expressionism in the early 20th century.', 'The Scream, Madonna');

INSERT INTO Supplier (supplier_id, sup_name, contact_info, products_services)
VALUES
(1, 'Art Supplies Inc.', 'contact@artsupplies.com', 'Art supplies and materials'),
(2, 'Frames R Us', 'info@framesrus.com', 'Custom framing services'),
(3, 'Art Shippers', 'info@artshippers.com', 'Art packing and shipping services'),
(4, 'Art Restoration Co.', 'restorationco@gmail.com', 'Art restoration services'),
(5, 'Art Prints Ltd.', 'sales@artprints.com', 'Fine art prints'),
(6, 'Artistic Materials', 'info@artisticmaterials.com', 'Art supplies and materials'),
(7, 'Artful Decor', 'info@artfuldecor.com', 'Home decor and accessories'),
(8, 'Artisanal Furniture', 'contact@artisanalfurniture.com', 'Handcrafted furniture'),
(9, 'Artisanal Lighting', 'info@artisanallighting.com', 'Handcrafted lighting fixtures'),
(10, 'Fine Art Publishers', 'sales@fineartpublishers.com', 'Fine art prints and publications');
INSERT INTO Artwork (Artwork_ID, Title, Artist_ID, Year_created, Medium, Dimensions, Price, Availability) 
VALUES 
(1, 'Starry Night', 1, 1889, 'Oil on canvas', '73.7 cm × 92.1 cm (29 in × 36 1/4 in)', 123000.00, 1),
(2, 'Mona Lisa', 2, 1503, 'Oil on poplar panel', '77 cm × 53 cm (30 in × 21 in)', 200000000.00, 1),
(3, 'The Persistence of Memory', 3, 1931, 'Oil on canvas', '24 cm × 33 cm (9.4 in × 13 in)', 4000000.00, 1),
(4, 'The Scream', 4, 1893, 'Oil, tempera, and pastel on cardboard', '91 cm × 73.5 cm (36 in × 28 7/8 in)', 1199220.00, 1),
(5, 'The Night Watch', 5, 1642, 'Oil on canvas', '363 cm × 437 cm (142.9 in × 172.0 in)', 600000.00, 1),
(6, 'Guernica', 6, 1937, 'Oil on canvas', '349 cm × 776 cm (137 in × 306 in)', 2000000.00, 1),
(7, 'Water Lilies', 7, 1915, 'Oil on canvas', '100 cm × 200 cm (39 in × 79 in)', 540000.00, 1),
(8, 'Les Demoiselles d''Avignon', 8, 1907, 'Oil on canvas', '243.9 cm × 233.7 cm (96 in × 92 in)', 30000000.00, 1),
(9, 'The Birth of Venus', 9, 1485, 'Tempera on canvas', '172.5 cm × 278.9 cm (67.9 in × 109.8 in)', 10000000.00, 1),
(10, 'American Gothic', 10, 1930, 'Oil on beaverboard', '74 cm × 62 cm (29 in × 24 1/2 in)', 4000000.00, 1);


INSERT INTO Exhibition (Exhibition_ID, Artwork_ID, ex_name, Start_Date, End_Date, Curator, Featured_Artists, Num_Artworks, Description, supplier_id)
VALUES
(1, 3, 'Impressionist Paintings', '2023-06-01', '2023-06-30', 'John Smith', 'Monet, Degas, Renoir', 20, 'An exhibition featuring some of the most famous impressionist paintings of all time.', 3),
(2, 5, 'Contemporary Sculpture', '2023-07-15', '2023-08-15', 'Emily Jones', 'Ai Weiwei, Yayoi Kusama', 15, 'An exhibition showcasing the latest contemporary sculpture pieces from around the world.', 5),
(3, 2, 'Medieval Art', '2023-09-01', '2023-10-01', 'Sarah Lee', 'Unknown', 30, 'An exhibition featuring a wide range of medieval art pieces, including paintings, sculptures, and tapestries.', 2),
(4, 7, 'Modern Photography', '2023-11-15', '2023-12-15', 'David Brown', 'Ansel Adams, Cindy Sherman', 25, 'An exhibition featuring the latest modern photography works from some of the world’s top photographers.', 7),
(5, 4, 'Ancient Egyptian Artifacts', '2024-01-01', '2024-02-01', 'Emma Davis', 'Unknown', 40, 'An exhibition showcasing some of the most significant ancient Egyptian artifacts ever discovered.', 4),
(6, 8, 'Abstract Art', '2024-03-15', '2024-04-15', 'Sophie Johnson', 'Jackson Pollock, Mark Rothko', 18, 'An exhibition featuring a range of abstract art pieces, from the early 20th century to the present day.', 8),
(7, 1, 'Renaissance Art', '2024-05-01', '2024-06-01', 'James Wilson', 'Leonardo da Vinci, Michelangelo', 25, 'An exhibition showcasing some of the most famous and influential Renaissance art pieces.', 1),
(8, 9, 'Asian Ceramics', '2024-07-15', '2024-08-15', 'Maggie Brown', 'Unknown', 35, 'An exhibition featuring a collection of Asian ceramics from various countries and time periods.', 9),
(9, 6, 'Baroque Paintings', '2024-09-01', '2024-10-01', 'Oliver Green', 'Caravaggio, Rembrandt', 15, 'An exhibition showcasing some of the most significant Baroque paintings from the 17th century.', 6),
(10, 10, 'Surrealist Art', '2024-11-15', '2024-12-15', 'Lena Taylor', 'Salvador Dali, Rene Magritte', 20, 'An exhibition featuring a range of surrealist art pieces, from the early 20th century to the present day.', 10);



INSERT INTO Auction (auction_id, au_name, au_date, auctioneer, artwork_id, reserve_price, au_status, supplier_id)
VALUES 
(1, 'Modern Art Auction', '2023-05-20', 'John Smith', 1, 100000, 'unsold', 2),
(2, 'Contemporary Art Auction', '2023-06-15', 'Jane Doe', 2, 75000, 'sold', 3),
(3, 'Impressionist Art Auction', '2023-07-01', 'David Lee', 3, 200000, 'unsold', 1),
(4, 'Asian Art Auction', '2023-08-05', 'Emily Chen', 4, 50000, 'sold', 4),
(5, 'Old Masters Auction', '2023-09-10', 'Michael Johnson', 5, 150000, 'unsold', 5),
(6, 'Photography Auction', '2023-10-15', 'Sarah Lee', 6, 30000, 'sold', 2),
(7, 'Sculpture Auction', '2023-11-20', 'Steven Brown', 7, 80000, 'unsold', 1),
(8, 'Design Auction', '2023-12-01', 'Rachel Green', 8, 40000, 'sold', 3),
(9, 'Fine Art Auction', '2024-01-15', 'Thomas Davis', 9, 100000, 'unsold', 5),
(10, 'Abstract Art Auction', '2024-02-20', 'Olivia White', 10, 50000, 'sold', 4);


INSERT INTO Customer (customer_id, cust_name, email, phone, address, notes, last_purchase_date)
VALUES (1, 'John Smith', 'johnsmith@email.com', '555-1234', '123 Main St, Anytown, USA', 'Regular customer', '2022-02-15'),
       (2, 'Jane Doe', 'janedoe@email.com', '555-5678', '456 High St, Anytown, USA', 'VIP customer', '2022-03-23'),
       (3, 'Bob Johnson', 'bobjohnson@email.com', '555-9012', '789 Broadway, Anytown, USA', 'First-time customer', '2022-04-05'),
       (4, 'Samantha Lee', 'samlee@email.com', '555-3456', '321 Elm St, Anytown, USA', 'Regular customer', '2022-01-01'),
       (5, 'David Kim', 'davidkim@email.com', '555-7890', '654 Oak Ave, Anytown, USA', 'VIP customer', '2022-03-01'),
       (6, 'Mary Brown', 'marybrown@email.com', '555-2345', '987 Pine St, Anytown, USA', 'Regular customer', '2022-02-28'),
       (7, 'Alex Chen', 'alexchen@email.com', '555-6789', '246 Cherry Ln, Anytown, USA', 'First-time customer', '2022-04-10'),
       (8, 'Stephanie Jones', 'stephjones@email.com', '555-1234', '369 Maple Rd, Anytown, USA', 'VIP customer', '2022-03-15'),
       (9, 'Michael Nguyen', 'michaelnguyen@email.com', '555-5678', '852 Walnut Blvd, Anytown, USA', 'Regular customer', '2022-02-10'),
       (10, 'Ashley Davis', 'ashleydavis@email.com', '555-9012', '753 Cedar Ave, Anytown, USA', 'First-time customer', '2022-04-01');


INSERT INTO Sale (sale_id, customer_id, artwork_id, sale_price, sale_date, tax, fee) 
VALUES 
  (1, 3, 2, 500.00, '2022-01-15', 25.00, 50.00),
  (2, 5, 1, 1000.00, '2022-02-01', 50.00, 75.00),
  (3, 1, 7, 1500.00, '2022-02-10', 75.00, 100.00),
  (4, 6, 3, 800.00, '2022-03-05', 40.00, 60.00),
  (5, 4, 5, 1200.00, '2022-04-02', 60.00, 90.00),
  (6, 2, 10, 700.00, '2022-04-10', 35.00, 55.00),
  (7, 7, 8, 2000.00, '2022-05-01', 100.00, 125.00),
  (8, 9, 4, 900.00, '2022-06-15', 45.00, 70.00),
  (9, 8, 6, 1800.00, '2022-07-01', 90.00, 110.00),
  (10, 10, 9, 600.00, '2022-08-20', 30.00, 45.00);

INSERT INTO Shipping (shipping_id, artwork_id, customer_id, shipping_address, tracking_number, shipping_cost, insurance_cost, handling_cost, shipped_date, delivered_date, notes)
VALUES 
(1, 2, 4, '123 Main St, Anytown, USA', '1234abcd', 15.99, 2.50, 1.00, '2023-05-01', '2023-05-03', 'Fragile, handle with care'),
(2, 5, 1, '456 Elm St, Anycity, USA', '5678efgh', 8.50, 1.50, 0.50, '2023-05-02', '2023-05-06', 'Signature required upon delivery'),
(3, 8, 6, '789 Maple Ave, Anyville, USA', '9012ijkl', 12.99, 3.00, 1.50, '2023-05-03', '2023-05-08', 'Do not leave in direct sunlight'),
(4, 1, 2, '234 Oak St, Anytown, USA', '3456mnop', 20.00, 5.00, 2.00, '2023-05-04', '2023-05-09', 'Handle with gloves'),
(5, 3, 7, '567 Pine Dr, Anycity, USA', '7890qrst', 9.99, 2.00, 1.00, '2023-05-05', '2023-05-10', 'Fragile, do not stack'),
(6, 6, 9, '890 Cedar Rd, Anytown, USA', '1234abcd', 15.99, 2.50, 1.00, '2023-05-06', '2023-05-11', 'Handle with care'),
(7, 4, 3, '123 Maple St, Anyville, USA', '5678efgh', 8.50, 1.50, 0.50, '2023-05-07', '2023-05-12', 'Signature required upon delivery'),
(8, 9, 10, '456 Oak St, Anytown, USA', '9012ijkl', 12.99, 3.00, 1.50, '2023-05-08', '2023-05-13', 'Do not leave in direct sunlight'),
(9, 7, 5, '789 Elm St, Anycity, USA', '3456mnop', 20.00, 5.00, 2.00, '2023-05-09', '2023-05-14', 'Handle with gloves'),
(10, 10, 8, '567 Pine Dr, Anyville, USA', '7890qrst', 9.99, 2.00, 1.00, '2023-05-10', '2023-05-15', 'Fragile, do not stack');

INSERT INTO Restoration (id, artwork_id, conservator_name, date_restored, notes) VALUES
(1, 1, 'John Smith', '2022-01-01', 'Cleaned and repaired minor tears.'),
(2, 2, 'Jane Doe', '2021-11-15', 'Conserved the frame and replaced damaged glass.'),
(3, 3, 'James Lee', '2022-02-28', 'Repaired paint cracks and added protective varnish.'),
(4, 4, 'Samantha Williams', '2021-12-10', 'Cleaned and restored colors to original brightness.'),
(5, 5, 'Robert Johnson', '2022-03-20', 'Stabilized the canvas and repaired minor damages.'),
(6, 6, 'Emily Davis', '2021-10-05', 'Removed mold and treated canvas with preservative.'),
(7, 7, 'David Garcia', '2022-04-01', 'Cleaned and repaired minor scratches.'),
(8, 8, 'Linda Rodriguez', '2021-11-30', 'Strengthened the frame and replaced backing board.'),
(9, 9, 'Michael Martinez', '2022-05-15', 'Repaired water damage and added protective coating.'),
(10, 10, 'Sophia Hernandez', '2022-06-30', 'Repaired torn canvas and added protective varnish.');


INSERT INTO finance (id, pay_date, revenue, expenses, net_income, budget, financial_statement)
VALUES
(1, '2022-01-01', 10000.00, 5000.00, 5000.00, 10000.00, 'Financial statement for January 2022'),
(2, '2022-02-01', 12000.00, 6000.00, 6000.00, 11000.00, 'Financial statement for February 2022'),
(3, '2022-03-01', 15000.00, 7500.00, 7500.00, 12000.00, 'Financial statement for March 2022'),
(4, '2022-04-01', 18000.00, 9000.00, 9000.00, 13000.00, 'Financial statement for April 2022'),
(5, '2022-05-01', 20000.00, 10000.00, 10000.00, 14000.00, 'Financial statement for May 2022'),
(6, '2022-06-01', 22000.00, 11000.00, 11000.00, 15000.00, 'Financial statement for June 2022'),
(7, '2022-07-01', 25000.00, 12500.00, 12500.00, 16000.00, 'Financial statement for July 2022'),
(8, '2022-08-01', 28000.00, 14000.00, 14000.00, 17000.00, 'Financial statement for August 2022'),
(9, '2022-09-01', 30000.00, 15000.00, 15000.00, 18000.00, 'Financial statement for September 2022'),
(10, '2022-10-01', 32000.00, 16000.00, 16000.00, 19000.00, 'Financial statement for October 2022');

INSERT INTO Employee (employee_id, emp_name, contact_info, role, start_date, qualifications)
VALUES
(1, 'John Smith', 'john.smith@email.com', 'Manager', '2020-01-01', 'MBA'),
(2, 'Jane Doe', 'jane.doe@email.com', 'Developer', '2020-05-01', 'BSc in Computer Science'),
(3, 'Michael Johnson', 'michael.johnson@email.com', 'Sales Representative', '2021-03-15', 'BBA'),
(4, 'Emily Davis', 'emily.davis@email.com', 'Marketing Specialist', '2019-11-01', 'BA in Marketing'),
(5, 'David Lee', 'david.lee@email.com', 'Analyst', '2022-02-15', 'MSc in Mathematics'),
(6, 'Karen Chen', 'karen.chen@email.com', 'Designer', '2021-09-01', 'BFA'),
(7, 'Daniel Kim', 'daniel.kim@email.com', 'Developer', '2022-04-01', 'BSc in Computer Engineering'),
(8, 'Amy Wong', 'amy.wong@email.com', 'Accountant', '2020-07-01', 'BA in Accounting'),
(9, 'Andrew Davis', 'andrew.davis@email.com', 'Project Manager', '2022-01-01', 'MBA'),
(10, 'Lucy Yang', 'lucy.yang@email.com', 'Human Resources Manager', '2018-08-01', 'BA in Psychology');


 


SELECT COUNT(*) AS num_exhibitions FROM Exhibition;
SELECT COUNT(*) AS num_active_exhibitions
FROM Exhibition
WHERE end_date >= NOW();


SELECT COUNT(*) AS num_past_exhibitions
FROM Exhibition
WHERE end_date < NOW();


SELECT SUM(pay_price) AS total_revenue
FROM Sale;

SELECT ex_name, ar_name, Title 
FROM Exhibition 
JOIN Artwork ON Exhibition.Artwork_ID = Artwork.Artwork_ID 
JOIN Artist ON Artwork.Artist_ID = Artist.Artist_ID;

SELECT ex_name, Start_Date, End_Date, SUM(Price) AS total_price 
FROM Exhibition 
JOIN Artwork ON Exhibition.Artwork_ID = Artwork.Artwork_ID 
GROUP BY Exhibition.Exhibition_ID;

SELECT COUNT(*) AS total_products FROM Exhibition 
JOIN Artwork ON Exhibition.Artwork_ID = Artwork.Artwork_ID