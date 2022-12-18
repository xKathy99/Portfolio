using System;
using SplashKitSDK;

namespace DT01{

    public class Icon //once class is abstract, we cannot build any Shape object anymore
    {
        private Color _color;
        private double _ix;
        private double _iy;
        private Game _game;
        private IconType _icontype;
        private string _iconname;

        private double _width;

        private double _height;

        private string _notifmsg;
		
		private Color _textcolor;

        private string _closenotifmsg;
        private string _secondnotifmsg;

        private Bitmap _img; 
        private Bitmap _dead; 
        private Bitmap _infected; 
        private bool _isshownbefore;

        private Color _blackoutlayer;

        public Icon(Bitmap img, Game game, double ix, double iy, IconType icontype, string iconname) // for tasks and eqp and tools
        {
            _img = img;
            _game = game;
            _ix = ix;
            _iy = iy;
            _icontype = icontype;
            _iconname = iconname;
			_textcolor = Color.Black;

            _blackoutlayer = MakeTransparent();

            _color = MakeTransparent();

        }

        public Icon(Bitmap avatar, Bitmap dead, Bitmap infected, Game game, double ix, double iy, IconType icontype, string iconname) // for player
        {
            _img = avatar;
            _dead = dead;
            _infected = infected;

            _game = game;
            _ix = ix;
            _iy = iy;
            _icontype = icontype;
            _iconname = iconname;
			
			_textcolor = Color.Black;
        
            _color = MakeTransparent();

        }

        public Icon(Game game, double ix, double iy, double width, double height, string iconname)  // For rooms
        {
            _color = game.GameBackgroundColor;

            _game = game;
            _ix = ix;
            _iy = iy;

            _icontype = IconType.Room;

            _iconname = iconname;

            _width = width;
            _height = height;
			
			_color = Color.Linen;
			_textcolor = Color.Black;
        }

        public Icon(Game game, string notifmsg, string secondnotifmsg, string closenotifmsg)  // For notifications
        {
            _game = game;
            _color = Color.Yellow;
            _ix = 275;
            _iy = 400;
            _icontype = IconType.Notification;

            _notifmsg = notifmsg;
            _secondnotifmsg = secondnotifmsg;
            _closenotifmsg = closenotifmsg;
			
			_color = Color.Yellow;
            _textcolor = Color.Black;
            _isshownbefore = false;
        }

        public Color Color
        {
            get {return _color;}
            set {_color = value;}
        }

        public Game CurrentGame
        {
            get {return _game;}
            set {_game = value;}
        }

        public double AtX
        {
            get {return _ix;}
            set {_ix = value;}
        }
        public double AtY
        {
            get {return _iy;}
            set {_iy = value;}
        }       

        public string IconName
        {
            get {return _iconname;}
            set {_iconname = value;}
        }

        public IconType TypeofIcon
        {
            get {return _icontype;}
            set {_icontype = value;}
        }

        public string NotifMsg
        {
            get {return _notifmsg;}
            set {_notifmsg = value;}
        }

        public Bitmap Image
        {
            get {return _img;}
            set {_img = value;}
        }       

        public bool IsShownBefore
        {
            get {return _isshownbefore;}
            set {_isshownbefore = value;}
        }

        public Color MakeTransparent()
        {
            Color trans = new Color();
            trans.A = 0;

            return trans;
        }

        public Color MakeTransparent(Color color)
        {
            color.A = 50;

            return color;
        }

        public void Draw()
        {
            if (_icontype == IconType.Player)
            {   
                _game.gameWindow.FillCircle(_color, _ix+17.5, _iy+17.5, 25);
                _game.gameWindow.DrawBitmap(_img, _ix, _iy);
                _game.gameWindow.DrawText(_iconname, _textcolor, "Helvetica-Oblique.ttf", 14, _ix +5, _iy + 35);
                _game.gameWindow.FillCircle(_blackoutlayer, _ix+17.5, _iy+17.5, 25);
            }

            else if (_icontype == IconType.KilledPlayer)
            {
                _textcolor = Color.Red;
                _game.gameWindow.DrawBitmap(_dead, _ix, _iy);
                _game.gameWindow.DrawText(_iconname + ": Dead", _textcolor, "Helvetica.ttf", 14, _ix +5, _iy + 30);
            }

            else if (_icontype == IconType.InfectedPlayer)
            {
                _textcolor = Color.MediumSpringGreen;
                _game.gameWindow.DrawBitmap(_infected, _ix, _iy);
                _game.gameWindow.DrawText(_iconname + ": Infected", _textcolor, "Helvetica.ttf", 14, _ix +5, _iy + 40);
            }

            else if (_icontype == IconType.Room)
            {
                _game.gameWindow.FillRectangle(_color, _ix, _iy, _width, _height);
                _game.gameWindow.DrawText(_iconname, _textcolor, "Helvetica-BoldOblique.ttf", 20, (_ix - 20 + _width/2), (_iy + _height/2));
                _game.gameWindow.FillRectangle(_blackoutlayer, _ix, _iy, _width, _height);

            }

            else if (_icontype == IconType.EmergencyButton)
            {
                double radius = 15;
                _game.gameWindow.FillCircle(_color, _ix, _iy, radius);
            }

            else if (_icontype == IconType.Task)
            {
                _game.gameWindow.FillCircle(_color, _ix+20, _iy+25, 35);
                _game.gameWindow.DrawBitmap(_img, _ix, _iy);
                _game.gameWindow.FillCircle(_blackoutlayer, _ix+20, _iy+25, 35);

            }

            else if (_icontype == IconType.Equipment)
            {
                _game.gameWindow.FillCircle(_color, _ix+22, _iy+22, 35);
                _game.gameWindow.FillCircle(_blackoutlayer, _ix+22, _iy+22, 35);
                _game.gameWindow.FillCircle(_blackoutlayer, _ix+22, _iy+22, 35);
                _game.gameWindow.FillCircle(_blackoutlayer, _ix+22, _iy+22, 35);

                _game.gameWindow.DrawBitmap(_img, _ix, _iy);
                _game.gameWindow.FillCircle(_blackoutlayer, _ix+22, _iy+22, 35);
            }

            else if (_icontype == IconType.Tool)
            {
                _game.gameWindow.FillRectangle(_color, _ix-5, _iy-5, 50, 60);
                _game.gameWindow.DrawBitmap(_img, _ix, _iy);
                _game.gameWindow.DrawText(_iconname, _textcolor, "Helvetica.ttf", 16, (_ix - 20 + _width/2), (_iy + _height/2));
                _game.gameWindow.FillRectangle(_blackoutlayer, _ix-5, _iy-5, 80, 60);

            }

            else if (_icontype == IconType.Vent) //Vent
            {
                _game.gameWindow.FillRectangle(_color, _ix-5, _iy-5, 60, 55);
                _game.gameWindow.DrawBitmap(_img, _ix, _iy);
                _game.gameWindow.FillRectangle(_blackoutlayer, _ix-5, _iy-5, 60, 55);

            }

            else if (_icontype == IconType.Notification)
            {
                int width = 450;
                int height = 150;
                _game.gameWindow.FillRectangle(_color, _ix, _iy, width, height);
                _game.gameWindow.DrawText("ALERT:", _textcolor, "Helvetica-Bold.ttf", 18, _ix+20, _iy +20 );
                _game.gameWindow.DrawText(_notifmsg, _textcolor, "Helvetica.ttf", 16, _ix+20, _iy +40 );
                _game.gameWindow.DrawText(_secondnotifmsg, _textcolor, "Helvetica-Oblique.ttf", 14, _ix+20, _iy +60 );
                _game.gameWindow.DrawText(_closenotifmsg, _textcolor, "Helvetica.ttf", 16, _ix+20, _iy +120);
                _game.gameWindow.DrawRectangle(_textcolor, _ix, _iy, width, height);

            }

            else
            {}
        }

        public void Highlight()
        {
            if (_icontype == IconType.Player)
            {
                _color = Color.OrangeRed;

            }

            else if (_icontype == IconType.EmergencyButton)
            {
                double radius = 15;
                _game.gameWindow.DrawCircle(Color.Orange, _ix, _iy, radius);
            }

            else if (_icontype == IconType.Task)
            {
                _color = Color.Yellow;
            }

            else if (_icontype == IconType.Equipment)
            {
                _color = Color.Red;
            }

            else if (_icontype == IconType.Tool)
            {
               _color = Color.Yellow;
            }

            else if (_icontype == IconType.Vent)
            {   
                _color = Color.Red;

            }

            else{}
        }

        public void Unhighlight()
        {
            if (_icontype == IconType.Player)
            {
                _color = MakeTransparent();
            }

            else if (_icontype == IconType.EmergencyButton)
            {
                double radius = 10;
                _game.gameWindow.DrawCircle(_color, _ix, _iy, radius);
            }

            else if (_icontype == IconType.Task)
            {
                _color = MakeTransparent();
            }

            else if (_icontype == IconType.Equipment)
            {
                _color = MakeTransparent();
            }

            else if (_icontype == IconType.Tool)
            {
                _color = MakeTransparent();
            }

            else if (_icontype == IconType.Vent)
            {   
                _color = MakeTransparent();           
            }

            else{}
        }


        public void Blackout()
        {
            if (_icontype == IconType.Player)
            {
                _color = MakeTransparent();
                _blackoutlayer = MakeTransparent(Color.Black);

            }

            else if (_icontype == IconType.Room)
            {
                _color = Color.Black;
                _textcolor = MakeTransparent(Color.Linen);

            }

            else if (_icontype == IconType.Task)
            {
                _blackoutlayer = Color.Black;
            }


            else if (_icontype == IconType.Equipment)
            {
                _color = MakeTransparent();
                _blackoutlayer = MakeTransparent(Color.Black);

            }

            else if (_icontype == IconType.Vent) //Vent
            {
                _blackoutlayer = MakeTransparent(Color.Black);
            }

            else if (_icontype == IconType.Tool)
            {
                _blackoutlayer = Color.Black;

            }

            else{}
        }

        public void NonBlackout()
        {
            if (_icontype == IconType.Player)
            {
                _blackoutlayer = MakeTransparent();

            }
            
            else if (_icontype == IconType.Room)
            {
                _color = Color.Linen;
                _textcolor = Color.Black;

            }

            else if (_icontype == IconType.Task)
            {
                _blackoutlayer = MakeTransparent();
            }


            else if (_icontype == IconType.Equipment)
            {
                _color = Color.Red;

                _blackoutlayer = MakeTransparent();

            }

            else if (_icontype == IconType.Vent) //Vent
            {
                _blackoutlayer = MakeTransparent();
            }

            else if (_icontype == IconType.Tool)
            {
                _blackoutlayer = MakeTransparent();

            }

            else{}
        }

        public void UnDraw()
        {
            if (_icontype == IconType.Notification)
            {
                _color = MakeTransparent();
                _textcolor = MakeTransparent();
            }

            else
            {}

        }
    }
}