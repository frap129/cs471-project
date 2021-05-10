#!/bin/sh

# We cannot use environment variables on build, so instead we'll work around it
# by replacing the proper sections of text with the environment variable.
sed -i 's/${DB_ADDRESS}/'"$DB_ADDRESS"'/g' src/main/resources/application.properties
sed -i 's/${DB_USERNAME}/'"$DB_USERNAME"'/g' src/main/resources/application.properties
sed -i 's/${DB_PASSWORD}/'"$DB_PASSWORD"'/g' src/main/resources/application.properties
