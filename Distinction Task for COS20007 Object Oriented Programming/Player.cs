using System;
using SplashKitSDK;
using System.Collections.Generic;

namespace DT01
{
    public abstract class Player 
    {
		//make a shape object pass into player?????
		//move?? draw and redraw shape at new cood??
		
        protected string _name;
        protected Color _color;

        protected PlayerStatus _status;
        protected int _votedby;
        private bool _hastool;
        private ToolType _currenttool;

        private Icon _currenticon;

        private Game _currentgame;

        public string Name
        {   
            get {return _name;}
            set {_name = value;}
        }

        public PlayerStatus Status
        {
            get {return _status;}
            set {_status = value;}
        }

        public int VotedBy
        {
            get {return _votedby;}
            set {_votedby = value;}
        }
        public bool HasTool
        {
            get {return _hastool;}
            set {_hastool = value;}
        }

        public ToolType CurrentTool
        {
            get {return _currenttool;}
            set {_currenttool = value;}
        }

        public Icon CurrentIcon
        {
            get {return _currenticon;}
            set {_currenticon = value;}
        }

        public Game CurrentGame
        {
            get {return _currentgame;}
            set {_currentgame = value;}
        }



        public Player(string name, Game currentGame, Icon currentIcon) //PlayerStatus playerstatus, int votedby
        {
            _hastool = false;
            _currenttool = ToolType.None;

            _name = name;

            _status = PlayerStatus.Alive;
            _votedby = 0;

            _currentgame = currentGame;
            _currenticon = currentIcon;

            //randomly generate???? within a border
           //randomly generate?? within a border maybe add an object called Boundary for non accessible locations???

        }

        public void CallEmergency(EmergencyButton ebutton)
        {   
            //if player point is near to the button
            ebutton.IsEButtonSelected = true;
        }

        public string Vote(Player player) //Zombie cannot vote, Ejected/Killed cannot vote
        {
            if ((_status == PlayerStatus.Alive) | (_status == PlayerStatus.Unzombified)| (_status == PlayerStatus.Zombified))
            {
                if ((player.Status == PlayerStatus.Alive) | (player.Status == PlayerStatus.Unzombified)| (player.Status == PlayerStatus.Zombified))
                {
                    player.VotedBy++;
                    return (_name + " has voted " + player.Name);
                }
            }

            return ("Sorry, " + player.Status + " players cannot vote!");
        }

        public string SkipVote()
        {
            return (_name + "has skipped vote!");
        }


        public bool IsNear(Equipment eqp)
        { 
            double radiuslimit = 30;

            if (((_currenticon.AtX  <= eqp.XPlacement + 2*radiuslimit) & (_currenticon.AtX  >= eqp.XPlacement - radiuslimit)) & ((_currenticon.AtY <= eqp.YPlacement + 2*radiuslimit) & (_currenticon.AtY >= eqp.YPlacement - radiuslimit)))
            {   
                eqp.PlayerisNear = true;
                eqp.CheckCallIconHighlight();
                return true;
            }
            else 
            {
                eqp.PlayerisNear = false;
                eqp.CheckCallIconHighlight();
                return false;
            }
        }

        public bool IsNear(Player player)
        {
            double radiuslimit = 10;

            if (((_currenticon.AtX <= player.CurrentIcon.AtX + 4*radiuslimit) & (_currenticon.AtX >= player.CurrentIcon.AtX - 4*radiuslimit)) & ((_currenticon.AtY <= player.CurrentIcon.AtY + 4*radiuslimit) & (_currenticon.AtY >= player.CurrentIcon.AtY - 4*radiuslimit)))
            {
                return true;
            }

            else 
            {
                return false;
            }
        }

        public bool IsNear(Task task)
        {
            double radiuslimit = 30;

            if (((_currenticon.AtX <= task.XPlacement + 3*radiuslimit) & (_currenticon.AtX >= task.XPlacement - radiuslimit)) & ((_currenticon.AtY <= task.YPlacement + 3*radiuslimit) & (_currenticon.AtY >= task.YPlacement - radiuslimit)))
            {
                task.PlayerisNear = true;
                //task.CheckCallIconHighlight();
                return true;
            }

            else 
            {
                task.PlayerisNear = false;
                //task.CheckCallIconHighlight();
                return false;
            }
        }

        public bool IsNear(Tool tool)
        {
            double radiuslimit = 20;

            if (((_currenticon.AtX <= tool.XPlacement + 3*radiuslimit) & (_currenticon.AtX >= tool.XPlacement - radiuslimit)) & ((_currenticon.AtY <= tool.YPlacement + 3*radiuslimit) & (_currenticon.AtY >= tool.YPlacement - radiuslimit)))
            {
                tool.PlayerisNear = true;
                //tool.CheckCallIconHighlight();
                return true;
            }

            else 
            {
                tool.PlayerisNear = false;
                //tool.CheckCallIconHighlight();
                return false;
            }
        }

        

        public bool IsNear(EmergencyButton ebutton)
        {
            double radiuslimit = 10;

            if (((_currenticon.AtX <= ebutton.XPlacement + 4*radiuslimit) & (_currenticon.AtX >= ebutton.XPlacement - 4*radiuslimit)) & ((_currenticon.AtY <= ebutton.YPlacement +  4*radiuslimit) & (_currenticon.AtY >= ebutton.YPlacement -  4*radiuslimit)))
            {
                ebutton.PlayerisNear = true;
                //ebutton.CheckCallIconHighlight();
                return true;
            }

            else 
            {
                ebutton.PlayerisNear = false;
                //ebutton.CheckCallIconHighlight();
                return false;
            }
        }

        public bool IsNear(Border b)
        {
            double radiuslimit = 2;

            if (((_currenticon.AtX >= b.BorderX - 10*radiuslimit) & (_currenticon.AtX <= b.BorderX + b.BorderWidth + 4*radiuslimit)) & ((_currenticon.AtY >= b.BorderY - 3*radiuslimit) & (_currenticon.AtY <= b.BorderY + b.BorderHeight + 3*radiuslimit)))
            {
                return true;
            }

            else 
            {
                return false;
            }
        }
        

        public virtual void TakeTool(Tool tool)
        {
            _hastool = true;
            _currenttool = tool.TypeOfTool;
        }

        public virtual void DropTool()
        {
            _hastool = false;
            _currenttool = ToolType.None;
        }

        public virtual void ToolAction(Game game)
        {
            bool near;
            if ((_status == PlayerStatus.Alive ) || (_status == PlayerStatus.Zombified ) || (_status == PlayerStatus.Unzombified))
            {

                foreach(Tool tool in game.AllTools)
                {
                    near = IsNear(tool);

                    if (_hastool == true)
                    {
                        if (near == true)
                        {
                            DropTool();
                            TakeTool(tool);

                            string output = ("Tool "  + _currenttool + " has been taken!");
                            string closeoutput = ("Press [Enter] to close.");
                            Icon icon = new Icon(game, output, "", closeoutput);
                            game.AddIcon(icon);

                            return;
                        }

                        else // near = false
                        {                              
                            DropTool();

                            string output = ("Tool "  + _currenttool + " has been dropped!");
                            string closeoutput = ("Press [Enter] to close.");
                            Icon icon = new Icon(game, output, "", closeoutput);
                            game.AddIcon(icon);
                            return;

                        }

                    }
                
                    else 
                    {

                        if (near == true)
                        {
                            TakeTool(tool);

                            string output = ("Tool "  + _currenttool + " has been taken!");
                            string closeoutput = ("Press [Enter] to close.");
                            Icon icon = new Icon(game, output, "", closeoutput);
                            game.AddIcon(icon);

                            return;
                        }

                        else // near = false
                        {  

                        }
                    }                 
                }
            }

        }

        public virtual void Action(Game game)
        {
            bool near;

            if ((_status == PlayerStatus.Alive ) || (_status == PlayerStatus.Zombified ) || (_status == PlayerStatus.Unzombified))
            {

                foreach(Equipment eqp in game.AllEqp)
                {
                    near = IsNear(eqp);
                
                    if (near == true)
                    {
                        if (eqp.IsSabotaged == true)
                        {
                            eqp.GetFixed(game);
                            return; //Return will exit the function when calling it. Whatever is below the return statement will thus not be executed.
                        }
                    }
                 
                }

                foreach(Task task in game.AllTasks)
                {
                    near = IsNear(task);

                    if (near == true)
                    {
                        if(task.IsNeedingTool == true)
                        {
                            if(_hastool == true)
                            {
                                if(_currenttool == task.ToolNeeded) //if the tool i hold == tool needed
                                {
                                    task.GetDone(game);
                                    return;
                                }

                                else
                                {
                                    string output = ("This task requires " + task.ToolNeeded + " to be completed!");
                                    string closeoutput = ("Press [Enter] to close.");      

                                    Icon icon = new Icon(game, output, "", closeoutput);
                                    game.AddIcon(icon);
                                    
                                    return;

                                }
                            }

                            else
                            {
                                string output = ("This task requires " + task.ToolNeeded + " to be completed!");
                                string closeoutput = ("Press [Enter] to close.");      

                                Icon icon = new Icon(game, output, "", closeoutput);
                                game.AddIcon(icon);
                                
                                return;
                            }
                        }

                        else
                        {                            
                            task.GetDone(game);
                            return;
                        }
                    }
                }

                foreach(EmergencyButton ebutton in game.AllEButtons)
                {
                    near = IsNear(ebutton);

                    if (near == true)
                    {
                        if(ebutton.CanBeSelected == true)
                        {
                            ebutton.IsEButtonSelected = true;
                            return;
                        }
                    }
                }
            }
        }

        public virtual void CheckIsNearHighlight(Game game)
        {
    
            foreach(Task t in game.AllTasks)
            {
                bool near = IsNear(t);
                
                if (near == true)
                {
                    t.PlayerisNear = true;
                }

                else 
                {
                    t.PlayerisNear = false;
                }
                
                t.CheckCallIconHighlight();
            }

            foreach(EmergencyButton ebutton in game.AllEButtons)
            {
                bool near = IsNear(ebutton);

                if (near == true)
                {
                    ebutton.PlayerisNear = true;
                }

                else 
                {
                    ebutton.PlayerisNear = false;
                }
                
                ebutton.CheckCallIconHighlight();
            }

            foreach (Tool t in game.AllTools)
            {
                bool near = IsNear(t);

                if (near == true)
                {
                    t.PlayerisNear = true;
                }

                else 
                {
                    t.PlayerisNear = false;
                }
                
                t.CheckCallIconHighlight();
            }

        }

        public virtual void GetKilled()
        {
            _status = PlayerStatus.Dead;
            _currenticon.TypeofIcon = IconType.KilledPlayer;
        }

        public virtual void GetInfected()
        {
            _status = PlayerStatus.Infected;
            _currenticon.TypeofIcon = IconType.InfectedPlayer;

        }

        public void GetEjected()
        {
            _status = PlayerStatus.Ejected;
        }

        public void GetZombified()
        {
            if (_status == PlayerStatus.Unzombified)
            {
                _status = PlayerStatus.Zombified;                
            }
        }

        public void GetHealed()
        {
            if (_status == PlayerStatus.Unzombified)
            {
                _status = PlayerStatus.Alive;
            }
        }

        public virtual void Up(Game game)
        {
            if ((_status == PlayerStatus.Alive) || (_status == PlayerStatus.Zombified) || (_status == PlayerStatus.Unzombified))
            {
                    if (_hastool == true)
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtY = _currenticon.AtY - 10;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            _currenticon.AtY = _currenticon.AtY + 10; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }

                    SplashKit.MoveCameraBy(0, -10);  
                    _currentgame.AddIcon(_currenticon);

                }

                else 
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtY = _currenticon.AtY - 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            _currenticon.AtY = _currenticon.AtY + 18; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }
                   SplashKit.MoveCameraBy(0, -18);  
                    _currentgame.AddIcon(_currenticon);
                }

            }
              
                    
        }

        

        public virtual void Down(Game game)
        {
            if ((_status == PlayerStatus.Alive) || (_status == PlayerStatus.Zombified) || (_status == PlayerStatus.Unzombified))
            {

                if (_hastool == true)
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtY = _currenticon.AtY + 10;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            _currenticon.AtY = _currenticon.AtY - 10; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(0, +10);  
                    _currentgame.AddIcon(_currenticon);
                }  

                else 
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtY = _currenticon.AtY + 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            _currenticon.AtY = _currenticon.AtY - 18; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(0, +18);  
                    _currentgame.AddIcon(_currenticon);
                }
            }
            
        }

        public virtual void Left(Game game)
        {
            if ((_status == PlayerStatus.Alive) || (_status == PlayerStatus.Zombified) || (_status == PlayerStatus.Unzombified))
            {
                if (_hastool == true)
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtX = _currenticon.AtX - 10;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            _currenticon.AtX = _currenticon.AtX + 10; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(-10, 0);  
                    _currentgame.AddIcon(_currenticon);
                }

                else 
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtX = _currenticon.AtX - 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            _currenticon.AtX = _currenticon.AtX + 18; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }                
                    SplashKit.MoveCameraBy(-18, 0);                  
                    _currentgame.AddIcon(_currenticon);
                }
            }

        }

        public virtual void Right(Game game)
        {
            if ((_status == PlayerStatus.Alive) || (_status == PlayerStatus.Zombified) || (_status == PlayerStatus.Unzombified))
            {

                if (_hastool == true)
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtX = _currenticon.AtX + 10;

                    foreach (Border b in game.AllBorders)
                    {   
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            _currenticon.AtX = _currenticon.AtX - 10; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }   
                    SplashKit.MoveCameraBy(+10, 0);                  
                    _currentgame.AddIcon(_currenticon);
                }

                else 
                {
                    _currentgame.RemoveIcon(_currenticon);
                    _currenticon.AtX = _currenticon.AtX + 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            _currenticon.AtX = _currenticon.AtX - 18; // back to normal position
                            _currentgame.AddIcon(_currenticon);
                            break;
                        }                          
                    }                
                    SplashKit.MoveCameraBy(+18, 0);                                  
                    _currentgame.AddIcon(_currenticon);
                }
            }
        
        }    

    }
}