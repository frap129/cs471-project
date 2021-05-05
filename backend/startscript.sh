#!/bin/sh

# If we've specified a parameter, use it as the port, otherwise default the port
# to 1334 which will be the release port
if [ "$1" = "TEST" ]
then
  PORT=1335 # Test port
else
  PORT=1334 # Release port
fi

# This should be copied into the ec2-instance to run the jar
# Detach the process so that we can start from a Github Action
nohup java -jar -Dserver.port=$PORT studentLoanSystem-*.jar &
