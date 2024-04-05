SET global local_infile = 1;

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/login_data.csv" INTO TABLE login_info
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/sys_user_data.csv" INTO TABLE sys_user
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/client_user_data.csv" INTO TABLE client_user
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/goal_data.csv" INTO TABLE goal
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/food_data.csv" INTO TABLE food
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/food_log_data.csv" INTO TABLE food_log
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/exercise_data.csv" INTO TABLE exercise
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/set_based_exercise_data.csv" INTO TABLE set_based_exercise
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/duration_based_exercise_data.csv" INTO TABLE duration_based_exercise
FIELDS TERMINATED BY ',';

LOAD DATA INFILE "C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/exercise_log_data.csv" INTO TABLE exercise_log
FIELDS TERMINATED BY ',';