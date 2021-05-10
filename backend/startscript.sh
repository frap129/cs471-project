#!/bin/sh

# If we've specified the TEST parameter, use 1335 which is publicly exposed.
# Otherwise port 1334 is used for production/release
if [ "$1" = "TEST" ]
then
  PORT=1335 # Test port
else
  PORT=1334 # Release port
fi

# This should be copied into the ec2-instance to run the jar
# Detach the process so that we can start from a Github Action
java -jar -Dserver.port=$PORT studentLoanSystem-*.jar &
disown -h
