Basic script for viewing fonts on a system with fontconfig.  

This script should NEVER be run in a production environment, it uses the PHP shell_exec function and is definitely not secure by any stretch of the imagination.

To determine if you have fontconfig, open your terminal and run:

    fc-list

If you get a font list back, you're good to go.  If you don't, you may need to install [XQuartz](http://xquartz.macosforge.org/landing/).

I've only tested this on Mountain Lion 10.8.0 using Apache installed via MacPorts, though it is very generic so I'd expect that it would work on any OSX or Linux or possibly Windows machine with fontconfig.

