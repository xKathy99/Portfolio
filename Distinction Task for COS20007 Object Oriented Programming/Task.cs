using System;
using SplashKitSDK;

namespace DT01
{
    public class Task: InteractableThing
    {
        //private uint _taskduration;
        private bool _iscomplete;
        private ToolType _toolneeded;
        private bool _isneedingtool;

        public Task(Icon currentIcon):base(currentIcon)
        { 
            _iscomplete = false;
            _isneedingtool = false;
            //_taskduration = 15;
            _toolneeded = ToolType.None;
            _playerisnear = true;
        }

        public Task(Icon currentIcon, ToolType toolneeded):base(currentIcon)
        { 
            _iscomplete = false;
            _isneedingtool = true;

            _toolneeded = toolneeded;

            //_taskduration = 2;
        }

        /*public uint TaskDuration //readonly
        {
            get {return _taskduration;}
        }*/

        public bool IsComplete
        {
            get {return _iscomplete;}
            set {_iscomplete = value;}
        }

        public bool IsNeedingTool //readonly
        {
            get {return _isneedingtool;}
        }

        public ToolType ToolNeeded
        {
            get {return _toolneeded;}
        }


        public virtual void GetDone(Game game)
        {
            if (_iscomplete == false)
            {
                _iscomplete = true;
                _currenticon.Unhighlight();
                                
                Console.WriteLine("\n=========================================");

                Console.WriteLine("Performing " + _currenticon.IconName + "... Task duration: 5s");
                SplashKit.Delay(1500);
                Console.WriteLine("4s");
                SplashKit.Delay(1500);
                Console.WriteLine("3s");
                SplashKit.Delay(1500);
                Console.WriteLine("2s");
                SplashKit.Delay(1500);
                Console.WriteLine("1s");
                Console.WriteLine("Equipment fixed!");

                string output = (_currenticon.IconName + " is completed!");
                string closeoutput = ("Press [Enter] to close.");
                string nextoutput = ("Total tasks completion: " + Math.Round(game.CountPercentageTaskCompletion(), 2) + "%");
                Icon icon = new Icon(game, output, nextoutput, closeoutput);
                game.AddIcon(icon);
            }

            else if (_iscomplete == true)
            {
                string output = ("This task has already been completed!");
                string closeoutput = ("Press [Enter] to close.");      

                string nextoutput = ("Total tasks completion: " + Math.Round(game.CountPercentageTaskCompletion(), 2) + "%");
                Icon icon = new Icon(game, output, nextoutput, closeoutput);
                game.AddIcon(icon);
            }

            else
            {
                
            }
        }


    }
}