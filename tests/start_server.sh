#!/usr/bin/env sh
######################################################################
# Starting local mailcatcher server.
######################################################################

docker run -d -i -t -p 1080:1080 -p 1025:1025 schickling/mailcatcher
sleep 5