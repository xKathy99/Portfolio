using System;
using SplashKitSDK;
namespace DT01
{
    public class ZombieCarrier: Player
    {
        private bool _caninfect;
        private int _infectcooldown;
        public ZombieCarrier(string name, Game currentGame, Icon currentIcon):base(name, currentGame, currentIcon)
        {
            _status = PlayerStatus.Unzombified;
            _caninfect = false;

            _votedby = 0;

            _infectcooldown = 0;
        }

        public int InfectCooldown
        {
            get {return _infectcooldown;}
            set {_infectcooldown = value;}
        }

        public bool CanInfect
        {
            get {return _caninfect;}
            set {_caninfect = value;}
        }

        public void CheckZombiefiedStatus()
        {
            if (_status == PlayerStatus.Zombified)
            {
                _caninfect = true;
            }

        }

        public void InfectAction(Game game)
        {
            bool near;

            if (Status == PlayerStatus.Zombified) 
            {
                foreach(Player player in game.AllPlayers)
                {
                    near = IsNear(player);

                    if (player != this)
                    {
                        if (near == true)
                        {
                            if (_infectcooldown == 0)
                            {
                                player.GetInfected();
                                break; 
                            }
                        
                        }
                    }
                
                    
                }
            }
        } 





        public override void CheckIsNearHighlight(Game game)
        {
            if (Status == PlayerStatus.Unzombified || Status == PlayerStatus.Alive)
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
            }

            else 
            {}
            

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