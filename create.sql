DROP DATABASE IF EXISTS FitQuest;
CREATE DATABASE FitQuest;
USE FitQuest;

CREATE TABLE trainer_user (
	trainer_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    email VARCHAR(50) NOT NULL,
    PRIMARY KEY (trainer_id)
);

CREATE TABLE client_user (
	client_id INT NOT NULL,
    trainer_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    email VARCHAR(50) NOT NULL,
    weight FLOAT,
    height FLOAT,
    PRIMARY KEY (client_id),
    FOREIGN KEY (trainer_id) REFERENCES trainer_user(trainer_id)
);

CREATE TABLE goal (
	client_id INT NOT NULL,
	goal_id INT NOT NULL,
    goal_description VARCHAR(100) NOT NULL,
    target_date DATE,
    PRIMARY KEY (client_id, goal_id),
    FOREIGN KEY (client_id) REFERENCES client_user(client_id)
);

CREATE TABLE food (
	food_id INT NOT NULL,
    calories INT NOT NULL,
    carbohydrates FLOAT,
    fat FLOAT,
    protein FLOAT,
    PRIMARY KEY (food_id)
);

CREATE TABLE food_log (
	client_id INT NOT NULL,
    food_log_id INT NOT NULL,
    food_log_date DATE NOT NULL,
    food_id INT NOT NULL,
    PRIMARY KEY (client_id, food_log_id),
    FOREIGN KEY (client_id) REFERENCES client_user(client_id),
    FOREIGN KEY (food_id) REFERENCES food(food_id)
);

CREATE TABLE exercise (
	exercise_id INT NOT NULL,
    PRIMARY KEY (exercise_id)
);

CREATE TABLE set_based_exercise (
	exercise_id INT NOT NULL,
    sets INT NOT NULL,
    repetitions INT NOT NULL,
    PRIMARY KEY (exercise_id),
    FOREIGN KEY (exercise_id) REFERENCES exercise(exercise_id)
);

CREATE TABLE duration_based_exercise (
	exercise_id INT NOT NULL,
    duration_min FLOAT NOT NULL,
    calories_burned INT,
    PRIMARY KEY (exercise_id),
    FOREIGN KEY (exercise_id) REFERENCES exercise(exercise_id)
);

CREATE TABLE exercise_log (
    client_id INT NOT NULL,
    exercise_log_id INT NOT NULL,
    exercise_log_date DATE NOT NULL,
    exercise_id INT NOT NULL,
    PRIMARY KEY (client_id, exercise_log_id),
    FOREIGN KEY (client_id) REFERENCES client_user(client_id),
    FOREIGN KEY (exercise_id) REFERENCES exercise(exercise_id)
);