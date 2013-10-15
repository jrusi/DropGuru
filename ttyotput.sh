#! /bin/sh
  
#  stty -F /dev/ttyUSB0 ispeed 19200 ospeed 19200 cs8 -parenb -cstopb -echo -hupcl
    
# Loop
while [ 1 ]; do
READ=`dd if=/dev/ttyUSB2 count=4`
echo $READ
done