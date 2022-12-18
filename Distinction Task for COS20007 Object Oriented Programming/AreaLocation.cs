using System;
using SplashKitSDK;
namespace DT01
{
    public class AreaLocation
    {
        private double _x;
        private double _y;
        private double _width;
        private double _height;

        public AreaLocation(double x, double y, double width, double height)
        {
            _x = x;
            _y = y;
            _width = width;
            _height = height;

        }

        public double XCoord
        {
            get {return _x;}
        }

        public double YCoord
        {
            get {return _y;}
        }

        public double Width
        {
            get {return _width;}
        }

        public double Height
        {
            get {return _height;}
        }
    }
}