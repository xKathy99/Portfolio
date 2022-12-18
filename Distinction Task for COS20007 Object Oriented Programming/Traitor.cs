using System;
using SplashKitSDK;
namespace DT01
{
    public class Traitor: Player
    {
        private bool _isinvent;
        //private int _killcooldown;
        private bool _cansabotage;

        //private bool _cankill;
        
        public Traitor(string name, Game currentGame, Icon currentIcon):base(name, currentGame, currentIcon)
        {
            _status = PlayerStatus.Alive;
            _votedby = 0;

            _isinvent = false;

            _cansabotage = true;

            //_killcooldown = 3; //WHAT TO DO ABOUT KILL COOLDOWN??????
            //_cankill = false;
        }

        /* public int KillCooldown
        {
            get {return _killcooldown;}
            set {_killcooldown = value;}
        } */
        public bool IsInVent
        {
            get {return _isinvent;}
            set {_isinvent = value;}
        }

        /* public bool CanKill
        {
            get {return _cankill;}
            set {_cankill = value;}
        } */

        public bool CanSabotage
        {
            get {return _cansabotage;}
            set {_cansabotage = value;}
        }




        public bool IsNear(Vent vent)
        {
            double radiuslimit = 10;

            if (((CurrentIcon.AtX <= vent.XPlacement + 2*radiuslimit) & (CurrentIcon.AtX >= vent.XPlacement - 4*radiuslimit)) & ((CurrentIcon.AtY <= vent.YPlacement + 4*radiuslimit) & (CurrentIcon.AtY >= vent.YPlacement - 2*radiuslimit)))
            {
                vent.TraitorisNear = true;
                return true;
            }

            else
            {
                vent.TraitorisNear = false;
                return false;
            }  

        }

        public void CheckCanSabotage(Game game)
        {
            foreach (Equipment e in game.AllEqp)
            {
                if (e.IsSabotaged == true)
                {
                    _cansabotage = false;
                    break;
                }
            } 

            _cansabotage = true;           
        }


        public void Sabotage(Game game) //how to make sabotage one eqp at only 1 rtime?
        {
            bool near;

            foreach(Equipment eqp in game.AllEqp)
            {
                near = IsNear(eqp);
                
                if (near == true)
                {
                    if (eqp.IsSabotaged == false)
                    {
                        CheckCanSabotage(game);
                        
                        if (_cansabotage == true)
                        {
                            eqp.BeSabotaged(game);
                            return;
                        }

                        else // _cansabotage == false
                        {
                            string next = ("Please wait until fix to sabotage.");
                            string closenext = ("Press [Enter] to close.");      

                            Icon nexticon = new Icon(game, next, "", closenext);
                            game.AddIcon(nexticon);
                        }
                    }

                    else
                    {
                        string next = ("Please wait until fix to sabotage.");
                        string closenext = ("Press [Enter] to close.");      

                        Icon nexticon = new Icon(game, next, "", closenext);
                        game.AddIcon(nexticon);
                    }
                }              
            }
            
        }


        public void VentAction(Game game)
        {
            bool near;

            foreach(Vent vent in game.AllVents)
            {
                near = IsNear(vent);                
                
                if (near == true)
                {
                    if (_isinvent == true)
                    {  
                        game.AddIcon(CurrentIcon);
                        _isinvent = false;
                        break;
                    }

                    else if (_isinvent == false)
                    {
                        CurrentIcon.AtX = vent.XPlacement;
                        CurrentIcon.AtY = vent.YPlacement;

                        game.RemoveIcon(CurrentIcon);
                        _isinvent = true;
                        break;
                    }

                    else
                    {
                    }
                    
                }

                else
                {}
          
            }

        }

        /* public void StartKillCoolDownTimer()
        {
            if (_cankill == false)
            {
                Console.WriteLine("Traitor Kill cooldown timer...");
                Console.WriteLine("Cooldown ending in " + _killcooldown + "s...");

                for (int i = _killcooldown; i > 0;  i--)
                {
                    //SplashKit.Delay(1000);
                    _killcooldown--;
                    Console.WriteLine(_killcooldown + "s...");
                }

                _killcooldown = 0;
                _cankill = true;

                Console.WriteLine("Kill mode enable.");
            }

        } 

        public void ResetKillCoolDownTimer()
        {       
            _cankill = false;
            _killcooldown = 3;

        }
        */

        public void KillAction(Game game)
        {
            bool near;

            //if (_cankill == true)
            //{
                foreach(Player p in game.AllPlayers)
                {
                    near = IsNear(p);

                    if (p != this)
                    {
                        if (near == true)
                        {
                            //if (_killcooldown == 0)
                            //{
                                if (p.Status == PlayerStatus.Alive)
                                {
                                    game.RemoveIcon(p.CurrentIcon);

                                    p.GetKilled();

                                    game.AddIcon(p.CurrentIcon);
                                    
                                    //ResetKillCoolDownTimer();
                                }

                                else if (p.Status == PlayerStatus.Unzombified)
                                {
                                    p.GetZombified();
                                }   
                            //}
                        }
                    
                    }   
                }
                       
            //}
            
        }


        public override void Action(Game game)
        {
            bool near;

            if ((_status == PlayerStatus.Alive ) | (_status == PlayerStatus.Zombified ) | (_status == PlayerStatus.Unzombified))
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
                    //Do nothing
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


        public override void Up(Game game)
        {
            if (_isinvent == true)
            {   
                int i = 0;
                int r = 0;
                double temp;
                double next;    

                foreach (Vent v in game.AllVents)
                {
                    i++;
                }
                
                double[] nextVentY = new double[i];


                foreach (Vent v in game.AllVents)
                {
                    nextVentY[r] = v.YPlacement;
                    r++;
                }

                for (int j = 0; j <= nextVentY.Length - 2; j++) // use bubble sort to find closest y placement
                {
                    for (int k = 0; k <= nextVentY.Length - 2; k++)
                    {
                        if (nextVentY[k] < nextVentY[k + 1])
                        {
                            temp = nextVentY[k + 1];
                            nextVentY[k + 1] = nextVentY[k];
                            nextVentY[k] = temp;
                        }
                    }
                }                           

                foreach (double d in nextVentY)
                {
                    if ((d != CurrentIcon.AtY) & (d < CurrentIcon.AtY))
                    {
                        next = d;

                        foreach (Vent v in game.AllVents)
                        {
                            if (v.YPlacement == next)
                            {
                                CurrentIcon.AtY = v.YPlacement;
                                CurrentIcon.AtX = v.XPlacement;
                            }
                        }
                        break;
                    }
                }
            }

            else
            {
                if (HasTool == true)
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtY = CurrentIcon.AtY - 10;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            CurrentIcon.AtY = CurrentIcon.AtY + 10; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(0, -10);  
                    CurrentGame.AddIcon(CurrentIcon);

                    CurrentGame.AddIcon(CurrentIcon);
                }

                else 
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtY = CurrentIcon.AtY - 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            CurrentIcon.AtY = CurrentIcon.AtY + 18; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }                
                    SplashKit.MoveCameraBy(0, -18);  
                    CurrentGame.AddIcon(CurrentIcon);
                }

            }


              
                    
        }

        

        public override void Down(Game game)
        {
            if (_isinvent == true)
            {   
                int i = 0;
                int r = 0;
                double temp;
                double next;    

                foreach (Vent v in game.AllVents)
                {
                    i++;
                }
                double[] nextVentY = new double[i];


                foreach (Vent v in game.AllVents)
                {
                    nextVentY[r] = v.YPlacement;
                    r++;
                }

                for (int j = 0; j <= nextVentY.Length - 2; j++) // use bubble sort to find closest y placement
                {
                    for (int k = 0; k <= nextVentY.Length - 2; k++)
                    {
                        if (nextVentY[k] > nextVentY[k + 1])
                        {
                            temp = nextVentY[k + 1];
                            nextVentY[k + 1] = nextVentY[k];
                            nextVentY[k] = temp;
                        }
                    }
                }                           

                foreach (double d in nextVentY)
                {
                    if ((d != CurrentIcon.AtY) & (d > CurrentIcon.AtY))
                    {
                        next = d;

                        foreach (Vent v in game.AllVents)
                        {
                            if (v.YPlacement == next)
                            {
                                CurrentIcon.AtY = v.YPlacement;
                                CurrentIcon.AtX = v.XPlacement;
                            }
                        }
                        break;
                    }
                }
            }

            else
            {

                if (HasTool == true)
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtY = CurrentIcon.AtY + 10;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            CurrentIcon.AtY = CurrentIcon.AtY - 10; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(0, +10);  
                    CurrentGame.AddIcon(CurrentIcon);
                }

                else 
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtY = CurrentIcon.AtY + 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            CurrentIcon.AtY = CurrentIcon.AtY - 18; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }                
                    SplashKit.MoveCameraBy(0, +18);  
                    CurrentGame.AddIcon(CurrentIcon);
                }
            }
            
        }

        public override void Left(Game game)
        {
            if (_isinvent == true)
            {   
                int i = 0;
                int r = 0;
                double temp;
                double next;    

                foreach (Vent v in game.AllVents)
                {
                    i++;
                }
                
                double[] nextVentX = new double[i];


                foreach (Vent v in game.AllVents)
                {
                    nextVentX[r] = v.XPlacement;
                    r++;
                }

                for (int j = 0; j <= nextVentX.Length - 2; j++) // use bubble sort to find closest y placement
                {
                    for (int k = 0; k <= nextVentX.Length - 2; k++)
                    {
                        if (nextVentX[k] < nextVentX[k + 1])
                        {
                            temp = nextVentX[k + 1];
                            nextVentX[k + 1] = nextVentX[k];
                            nextVentX[k] = temp;
                        }
                    }
                }                           

                foreach (double d in nextVentX)
                {
                    if ((d != CurrentIcon.AtX) & (d < CurrentIcon.AtX))
                    {
                        next = d;

                        foreach (Vent v in game.AllVents)
                        {
                            if (v.XPlacement == next)
                            {
                                CurrentIcon.AtY = v.YPlacement;
                                CurrentIcon.AtX = v.XPlacement;
                            }
                        }
                        break;
                    }
                }
            }

            else
            {
                if (HasTool == true)
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtX = CurrentIcon.AtX - 10;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            CurrentIcon.AtX = CurrentIcon.AtX + 10; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(-10, 0);  
                    CurrentGame.AddIcon(CurrentIcon);
                }

                else 
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtX = CurrentIcon.AtX - 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            CurrentIcon.AtX = CurrentIcon.AtX + 18; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(-18, 0);                  
                    CurrentGame.AddIcon(CurrentIcon);                
                }
            }

        }

        public override void Right(Game game)
        {
            if (_isinvent == true)
            {   
                int i = 0;
                int r = 0;
                double temp;
                double next;    

                foreach (Vent v in game.AllVents)
                {
                    i++;
                }

                double[] nextVentX = new double[i];

                foreach (Vent v in game.AllVents)
                {
                    nextVentX[r] = v.XPlacement;
                    r++;
                }

                for (int j = 0; j <= nextVentX.Length - 2; j++) // use bubble sort to find closest y placement
                {
                    for (int k = 0; k <= nextVentX.Length - 2; k++)
                    {
                        if (nextVentX[k] > nextVentX[k + 1])
                        {
                            temp = nextVentX[k + 1];
                            nextVentX[k + 1] = nextVentX[k];
                            nextVentX[k] = temp;
                        }
                    }
                }                           

                foreach (double d in nextVentX)
                {
                    if ((d != CurrentIcon.AtX) & (d > CurrentIcon.AtX))
                    {
                        next = d;

                        foreach (Vent v in game.AllVents)
                        {
                            if (v.XPlacement == next)
                            {
                                CurrentIcon.AtY = v.YPlacement;
                                CurrentIcon.AtX = v.XPlacement;
                            }
                        }
                        break;
                    }
                }
            }

            else
            {


                if (HasTool == true)
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtX = CurrentIcon.AtX + 10;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true) //checks first if meets condition
                        {
                            CurrentIcon.AtX = CurrentIcon.AtX - 10; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }
                    SplashKit.MoveCameraBy(+10, 0);                  
                    CurrentGame.AddIcon(CurrentIcon);
                }

                else 
                {
                    CurrentGame.RemoveIcon(CurrentIcon);
                    CurrentIcon.AtX = CurrentIcon.AtX + 18;

                    foreach (Border b in game.AllBorders)
                    {
                        if (IsNear(b) == true)
                        {
                            CurrentIcon.AtX = CurrentIcon.AtX - 18; // back to normal position
                            CurrentGame.AddIcon(CurrentIcon);
                            break;
                        }                          
                    }                
                    SplashKit.MoveCameraBy(+18, 0);                                  
                    CurrentGame.AddIcon(CurrentIcon);
                }
            }
        }



        public override void CheckIsNearHighlight(Game game)
        {
            foreach(Equipment eqp in game.AllEqp)
            {
                bool near = IsNear(eqp);
                
                if (near == true)
                {
                    eqp.PlayerisNear = true;
                }

                else 
                {
                    eqp.PlayerisNear = false;
                }
                eqp.CheckCallIconHighlight();
            } // no need, since equipment is onlyhighlighted when sabotaged?

           
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

            foreach (Vent v in game.AllVents)
            {
                bool near = IsNear(v);

                if (near == true)
                {
                    v.PlayerisNear = true;
                }

                else 
                {
                    v.PlayerisNear = false;
                }
                
                v.CheckCallIconHighlight();
            }

            foreach (Player p in game.AllPlayers)
            {
                bool near = IsNear(p);

                if (p != this)
                {
                    if (near == true)
                    {
                        p.CurrentIcon.Highlight();
                    }

                    else 
                    {
                        p.CurrentIcon.Unhighlight();   
                    }
                }

                
                
            }
        }

        

    }
}