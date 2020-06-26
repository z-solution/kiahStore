# Kiah Store Installation guide

This document provide the guide to install the Kiah Store system. 

# Requirement

This system require:
- Ubuntu 16 or higher
- Docker 19.03.8 or higher

# Step

1. To install or run the system using default setting, just execute the docker-compose file by running `docker-compose up` on the root of the project folder. ( First time running this command will take around 25-30 minutes based on the internet connection)

2. Once the docker-compose is finish running, you should be able to visit the main site at `http://localhost` and the admin site at `http://admin.localhost`. ( default admin user is username admin@admin.com and password 12341234. This can be change at file `database/migrations/2014_10_12_000000_create_users_table.php`)