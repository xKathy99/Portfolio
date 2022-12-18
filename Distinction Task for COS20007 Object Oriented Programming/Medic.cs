using System;
using SplashKitSDK;

namespace DT01
{
    public class Medic: Player
    {
        private  int _healchance;

        public Medic(string name, Game currentGame, Icon currentIcon):base(name, currentGame, currentIcon)
        {
            _healchance = 1;
        }

        public int HealChance
        {
            get {return _healchance;}
        }

        public void HealAction(Game game)
        {
            bool near;

            foreach(Player player in game.AllPlayers)
            {
                near = IsNear(player);

                if (player != this)
                {
                    if (_healchance == 1)
                    {
                        if (near == true)
                        {
                            if (player.Status == PlayerStatus.Unzombified || player.Status == PlayerStatus.Zombified)
                            {
                                _healchance = 0;
                                player.GetHealed();

                                string output = (player.Name + " has been successfully healed!");
                                string closeoutput = ("Press [Enter] to close.");
                                Icon icon = new Icon(game, output, "", closeoutput);
                                game.AddIcon(icon);
                                break;
                            }

                            else 
                            {
                                _healchance = 0;
                                player.GetHealed();

                                string output = (player.Name + " was not the Zombie Carrier! Vaccine wasted.");
                                string closeoutput = ("Press [Enter] to close.");
                                Icon icon = new Icon(game, output, "", closeoutput);
                                game.AddIcon(icon);
                                break;

                            }
                        }

                    }

                    else
                    {
                        string output = ("Unable to heal! No more vaccines to use.");
                        string closeoutput = ("Press [Enter] to close.");
                        Icon icon = new Icon(game, output, "", closeoutput);
                        game.AddIcon(icon);

                    }
                }
            }
            
        }






        public override void CheckIsNearHighlight(Game game)
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