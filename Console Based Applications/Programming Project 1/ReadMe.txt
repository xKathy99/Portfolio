This program requires the setup of SFML Library in Visual Studio to run.
The library can be found here:
https://www.sfml-dev.org/download/sfml/2.5.1/

To setup:
1. Install and extract the files
2. Open Programming Project 1 on Visual Studio

3. properties > set Configurations to All Configurations
4. C/C++ > General > Add the directory where the  SFML/include files are in the “Additional Include Directories” field
5. Linker > General
6. Enter the full path to SFML\lib in Additional Library Directories

7. set Configurations to Debug
8. Linker > General
9. Enter: sfml-graphics-d.lib;sfml-window-d.lib;sfml-system-d.lib;sfml-network-d.lib;sfml-audio-d.lib; into Additional Dependencies
10. OK
