################################################################################
##	This .login file customized by the DUC
##	Network Services Group 12-16-94
##	
################################################################################
##
##	This file is sourced everytime you first login to a machine.
##
################################################################################

### if we are not logged into the console then we can finish now

if (`tty` != "/dev/console") exit

### set the number of seconds to delay before starting window system
set delay = 5

echo -n "Starting OpenWindows (Control C to abort)"
while ( $delay > 0)
        echo -n " $delay"; sleep 1
        @ delay --
end
echo " go"

openwin

### set the number of seconds to delay before logging out
set delay = 5

echo " " 
echo -n "Automatic logout? (ctrl-C to stop) "
while ( $delay > 0)
        echo -n " $delay"; sleep 1
        @ delay --
end

echo " bye-bye"
logout
