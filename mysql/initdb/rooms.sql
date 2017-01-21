CREATE TABLE IF NOT EXISTS fuel_db.rooms(
   id        INT  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,name      VARCHAR(255) NOT NULL
  ,delete_pass INT NOT NULL
  ,is_deleted BOOLEAN DEFAULT FALSE
  ,created_at INT
  ,updated_at INT
);
INSERT INTO fuel_db.rooms(name, delete_pass) VALUES ('テストルーム', '1234');