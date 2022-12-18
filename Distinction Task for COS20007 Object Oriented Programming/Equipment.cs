using System;
using SplashKitSDK;

namespace DT01
{
    public class Equipment: InteractableThing
    {
        //private int _fixduration;
        private bool _issabotaged;

        public Equipment(Icon currentIcon):base(currentIcon)
        { 
            _issabotaged = false;
           // _fixduration = 20;
            _playerisnear = false;

        }

       
        /*public int FixDuration
        {
            get {return _fixduration;}
            set {_fixduration = value;}
        }*/

        public bool IsSabotaged
        {
            get {return _issabotaged;}
            set {_issabotaged = value;}
        }



        public virtual void BeSabotaged(Game game)
        {
            if (_issabotaged == false)
            {  
                foreach (Icon i in game.AllIcons)
                {
                    i.Blackout();
                }

                foreach (Border b in game.AllBorders)
                {
                    b.Blackout();
                }
    
                string next = (_currenticon.IconName + " has been sabotaged!");
                string closenext = ("Press [Enter] to close.");      

                Icon nexticon = new Icon(game, next, "", closenext);
                game.AddIcon(nexticon);
                

                _issabotaged = true;
                Console.WriteLine(_currenticon.IconName + " has been sabotaged!");
            }
            
            else
            {
                string next = (_currenticon.IconName + " is already sabotaged!");
                string closenext = ("Press [Enter] to close.");      

                Icon nexticon = new Icon(game, next, "", closenext);
                game.AddIcon(nexticon);
            }
        }


        public virtual void GetFixed(Game game)
        {
            if (IsSabotaged == true)
            {            
                Console.WriteLine("\n=========================================");

                Console.WriteLine("Fixing "+  _currenticon.IconName +" ... Duration: 5s");
                SplashKit.Delay(1500);
                Console.WriteLine("4s");
                SplashKit.Delay(1500);
                Console.WriteLine("3s");
                SplashKit.Delay(1500);
                Console.WriteLine("2s");
                SplashKit.Delay(1500);
                Console.WriteLine("1s");
                Console.WriteLine("Equipment fixed!");

                foreach (Icon i in game.AllIcons)
                {
                    i.NonBlackout();
                }

                foreach (Border b in game.AllBorders)
                {
                    b.NonBlackout();
                }

                string next = (_currenticon.IconName + " is fixed!");
                string closenext = ("Press [Enter] to close.");      

                Icon nexticon = new Icon(game, next, "", closenext);
                game.AddIcon(nexticon);


                _currenticon.Unhighlight();
                IsSabotaged = false;
            }
        }

        public override void CheckCallIconHighlight()
        {
            if (_issabotaged == true)
            {
                _currenticon.Highlight();
            }
            
            else
            {
                _currenticon.Unhighlight();
            }
            
        }



    }
}
