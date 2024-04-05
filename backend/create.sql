DROP DATABASE IF EXISTS FitQuest;
CREATE DATABASE FitQuest;
USE FitQuest;

CREATE TABLE sys_user (
    user_id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    pass_word VARCHAR(50) NOT NULL,
    CONSTRAINT userPK PRIMARY KEY (user_id),
    CONSTRAINT userSK UNIQUE (email)
);

CREATE TABLE client_user (
    client_id INT NOT NULL,
    trainer_id INT,
    weight FLOAT,
    height FLOAT,
    CONSTRAINT clientPK PRIMARY KEY (client_id),
    CONSTRAINT clientFK FOREIGN KEY (client_id)
        REFERENCES sys_user (user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT trainerFK FOREIGN KEY (trainer_id)
        REFERENCES sys_user (user_id)
        ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE goal (
    client_id INT NOT NULL,
    goal_id INT NOT NULL AUTO_INCREMENT,
    goal_description VARCHAR(100) NOT NULL,
    target_date DATE,
    CONSTRAINT goalPK PRIMARY KEY (goal_id),
    CONSTRAINT goal_clientFK FOREIGN KEY (client_id)
        REFERENCES client_user (client_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE food (
    food_id INT NOT NULL AUTO_INCREMENT,
    calories INT NOT NULL DEFAULT 0,
    carbohydrates FLOAT,
    fat FLOAT,
    protein FLOAT,
    CONSTRAINT foodPK PRIMARY KEY (food_id)
);

CREATE TABLE food_log (
    client_id INT NOT NULL,
    food_log_id INT NOT NULL AUTO_INCREMENT,
    food_log_date DATE NOT NULL,
    food_id INT,
    servings INT NOT NULL DEFAULT 1,
    CONSTRAINT food_logPK PRIMARY KEY (food_log_id),
    CONSTRAINT food_log_clientFK FOREIGN KEY (client_id)
        REFERENCES client_user (client_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT food_logPK FOREIGN KEY (food_id)
        REFERENCES food (food_id)
        ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE exercise (
    exercise_id INT NOT NULL AUTO_INCREMENT,
    CONSTRAINT exercisePK PRIMARY KEY (exercise_id)
);

CREATE TABLE set_based_exercise (
    exercise_id INT NOT NULL,
    sets INT NOT NULL DEFAULT 1,
    repetitions INT NOT NULL DEFAULT 1,
    CONSTRAINT set_based_exercisePK PRIMARY KEY (exercise_id),
    CONSTRAINT set_based_exerciseFK FOREIGN KEY (exercise_id)
        REFERENCES exercise (exercise_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE duration_based_exercise (
    exercise_id INT NOT NULL,
    duration_min FLOAT NOT NULL DEFAULT 0,
    calories_burned INT NOT NULL DEFAULT 0,
    CONSTRAINT duration_based_exercisePK PRIMARY KEY (exercise_id),
    CONSTRAINT duration_based_exerciseFK FOREIGN KEY (exercise_id)
        REFERENCES exercise (exercise_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE exercise_log (
    client_id INT NOT NULL,
    exercise_log_id INT NOT NULL AUTO_INCREMENT,
    exercise_log_date DATE NOT NULL,
    exercise_id INT,
    CONSTRAINT exercise_logPK PRIMARY KEY (exercise_log_id),
    CONSTRAINT exercise_log_clientFK FOREIGN KEY (client_id)
        REFERENCES client_user (client_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT exercise_log_exerciseFK FOREIGN KEY (exercise_id)
        REFERENCES exercise (exercise_id)
        ON DELETE SET NULL ON UPDATE CASCADE
);