CREATE TABLE IF NOT EXISTS fuel_db.canvases(
   id         INT NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,start_x    INT 
  ,start_y    INT 
  ,end_x      INT 
  ,end_y      INT 
  ,status_id  INT NOT NULL
  ,color      VARCHAR(31) 
  ,alpha      FLOAT 
  ,diameter   FLOAT 
  ,room_id    INT NOT NULL
  ,session_id VARCHAR(31) NOT NULL
  ,is_deleted BOOLEAN DEFAULT FALSE
  ,created_at INT
  ,updated_at INT
);
INSERT INTO fuel_db.canvases(start_x, start_y, end_x, end_y, status_id, color, alpha, diameter, room_id, session_id) VALUES (10, 10, 10, 10, 1, '#000000', 1.0, 1.0, 1, 'init_value');