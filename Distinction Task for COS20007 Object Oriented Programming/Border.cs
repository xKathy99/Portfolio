using System;
using SplashKitSDK;

namespace DT01{

    public class Border //once class is abstract, we cannot build any Shape object anymore
    {
        private double _bx;
        private double _by;
        private double _bwidth;
        private double _bheight;
        private Color _color;

        private Game _bgame;

        public Border(Game game, double x, double y, double width, double height)
        {
            _bgame = game;

            _bx = x;
            _by = y;
            _bwidth = width;
            _bheight = height;

            _color = Color.Black;
        }

        public double BorderX
        {
            get {return _bx;}
        }

        public double BorderY
        {
            get {return _by;}
        }

        public double BorderWidth
        {
            get {return _bwidth;}
        }

        public double BorderHeight
        {
            get {return _bheight;}
        }


        public Game CurrentGame
        {
            get {return _bgame;}
            set {_bgame = value;}
        }
        
        
        public void DrawMapBorders()
        {
            _bgame.gameWindow.FillRectangle(_color, _bx, _by, _bwidth, _bheight);
        }

        public void Blackout()
        {
            _color = Color.White;

        }

        public void NonBlackout()
        {
            _color = Color.Black;
        }


    }
}
