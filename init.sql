

CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO profiles (label, active) VALUES
('Admin', TRUE),
('Manager', TRUE),
('User', TRUE);


CREATE TABLE IF NOT EXISTS habilitations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE
);


INSERT INTO habilitations (label, active) VALUES
('CREATE_USER', TRUE),
('DELETE_USER', TRUE),
('EDIT_USER', TRUE),
('VIEW_USER', TRUE);




CREATE TABLE IF NOT EXISTS profile_habilitation (
    id_profile INT NOT NULL,
    id_habilitation INT NOT NULL,
    PRIMARY KEY (id_profile, id_habilitation),
    FOREIGN KEY (id_profile) REFERENCES profiles(id) ON DELETE CASCADE,
    FOREIGN KEY (id_habilitation) REFERENCES habilitations(id) ON DELETE CASCADE
);

-- Manager peut voir et modifier
-- Admin a tous les droits
-- User peut seulement voir

INSERT INTO profile_habilitation (id_profile , id_habilitation) VALUES
(1, 1),
(1, 2), 
(1, 3),
(1, 4),
(2, 3),
(2, 4),
(3, 4);



CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    id_profile INT,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (id_profile) REFERENCES profiles(id)
);



INSERT INTO users (nom, email, id_profile, active) VALUES
('Alice', 'alice@example.com', 1, TRUE),
('Bob', 'bob@example.com', 2, TRUE),
('Charlie', 'charlie@example.com', 3, TRUE),
('David', 'david@example.com', 3, TRUE),
('Eve', 'eve@example.com', 3, TRUE),
('Frank', 'frank@example.com', 3, TRUE),
('Grace', 'grace@example.com', 3, TRUE),
('Heidi', 'heidi@example.com', 3, TRUE),
('Ivan', 'ivan@example.com', 3, TRUE),
('Judy', 'judy@example.com', 3, TRUE),
('Karl', 'karl@example.com', 3, TRUE),
('Leo', 'leo@example.com', 3, TRUE),
('hamza', 'hamza@example.com', 3, TRUE),
('khalid', 'khalid@example.com', 3, TRUE),
('othmane', 'othmane@example.com', 3, TRUE),
('abderrafia', 'abderrafia@example.com', 3, TRUE),
('ilyass', 'ilyass@example.com', 3, TRUE),
('faissal', 'faissal@example.com', 3, TRUE),
('oussama', 'oussama@example.com', 2, TRUE),
('mohamed', 'mohamed@example.com', 2, TRUE),
('soufiane', 'soufiane@example.com', 2, TRUE),
('fatimazahra', 'fatimazahra@example.com', 3, TRUE),
('donia', 'donia@example.com', 3, TRUE),
('douae', 'douae@example.com', 3, TRUE),
('akram', 'akrame@example.com', 2, TRUE),
('ayoub', 'ayoub@example.com', 2, TRUE),
('aissam', 'aissam@example.com', 3, TRUE);








