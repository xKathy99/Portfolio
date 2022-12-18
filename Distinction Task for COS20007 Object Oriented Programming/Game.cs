using System;
using SplashKitSDK;
using System.Collections.Generic;

//Many aspects need to be changed. Refer to UML diagram

namespace DT01
{
    public class Game
    {
        private List<Player> _allplayers;
        private List<Task> _alltasks;
        private List<Equipment> _alleqp;
        private List<Tool> _alltools;
        private List<Vent> _allvents;
        private List<EmergencyButton> _allebuttons;
        private List<Icon> _allicons;
        private List<Border> _allborders;

        public Window gameWindow;  
        private Color _bgcolor;

        public Game()
        {

            _allplayers = new List<Player>();
            _alltasks = new List<Task>();
            _alleqp = new List<Equipment>();
            _alltools = new List<Tool>();
            _allvents = new List<Vent>();
            _allebuttons = new List<EmergencyButton>();
            _allicons = new List<Icon>();
            _allborders = new List<Border>();

            gameWindow = new Window("New Game", 800, 800);

            _bgcolor = Color.Linen;

        }

        public Color GameBackgroundColor
        {
            get {return _bgcolor;}
        }

        public List<Player> AllPlayers //readonly property
        {
            get {return _allplayers;}
        }

        public List<Task> AllTasks //readonly property
        {
            get {return _alltasks;}
        }

        public List<Equipment> AllEqp //readonly property
        {
            get {return _alleqp;}
        }

        public List<Tool> AllTools //readonly property
        {
            get {return _alltools;}
        }

        public List<Vent> AllVents //readonly property
        {
            get {return _allvents;}
        }

        public List<EmergencyButton> AllEButtons //readonly property
        {
            get {return _allebuttons;}
        }

        public List<Icon> AllIcons //readonly property
        {
            get {return _allicons;}
        }

        public List<Border> AllBorders //readonly property
        {
            get {return _allborders;}
        }

        /*public int TotalPlayers
        {
            get {return _allplayers.Count;}
        }

        public int TotalEqp
        {
            get {return _alleqp.Count;}
        }*/

        public int TotalTasks
        {
            get {return _alltasks.Count;}
        }

        /* public int TotalVents
        {
            get {return _allvents.Count;}
        } */

        public int CountCompletedTasks()
        {
            int total = 0;

            foreach (Task t in _alltasks)
            {
                if (t.IsComplete == true)
                {
                    total++;
                }
            }

            return total;
        }

        public int CountPlayingPlayers()
        {  
            int total = 0;

            foreach (Player p in _allplayers)
            {
                if ((p.Status == PlayerStatus.Alive) || (p.Status == PlayerStatus.Unzombified) || (p.Status == PlayerStatus.Zombified))
                {
                    total++;
                }
            }

            return (total);
        }  

        public int CountPlayerbyStatus(PlayerStatus status)
        {  
            int total = 0;

            foreach (Player p in _allplayers)
            {
                if (p.Status == status)
                {
                    total++;
                }
            }

            return (total);
        }          

        public void AddPlayer(Player p)
        {
            _allplayers.Add(p);
            
        }

        public void RemovePlayer(Player p)
        {
            _allplayers.Remove(p);
            
        }

        public void CallMeeting()
        {
            Console.WriteLine("A meeting has been called!");
        }

        public string EjectPlayer()
        {
            string a="";

            foreach(Player p in _allplayers)
            {
                if ((p.Status == PlayerStatus.Alive) |(p.Status == PlayerStatus.Zombified) | (p.Status == PlayerStatus.Unzombified))
                {

                    if (p.VotedBy >= (CountPlayingPlayers())/2)
                    {
                        p.GetEjected();
                        
                        //P.color = faded

                        if (p is Crewmate)
                        {
                            a = (p.Name + " was a crewmate.");
                        }

                        else if (p is Traitor)
                        {
                            a = (p.Name + " was a traitor.");
                        }

                        else if (p is ZombieCarrier)
                        {
                            a = (p.Name + " was a zombie carrier.");
                        }
                        
                    }
                }
            }

            foreach(Player p in _allplayers)
            {
                p.VotedBy = 0;
            }

            if (string.IsNullOrEmpty(a))
            {
            
                return ("Nobody was ejected.");
            }

            else
            {
                return ("Ejected: " + a);
            }
        }

        public void AddTask(Task task)
        {
            _alltasks.Add(task);
        }

        public void RemoveTask(Task task)
        {
            _alltasks.Remove(task);
        }

        public void AddEqp(Equipment eqp)
        {
            _alleqp.Add(eqp);
        }

        public void RemoveEqp(Equipment eqp)
        {
            _alleqp.Remove(eqp);
        }

        public void AddTool(Tool tool)
        {
            _alltools.Add(tool);
        }

        public void RemoveTool(Tool tool)
        {
            _alltools.Remove(tool);
        }

        public void AddVent(Vent vent)
        {
            _allvents.Add(vent);
        }

        public void RemoveVent(Vent vent)
        {
            _allvents.Remove(vent);
        } 

        public void AddEButton(EmergencyButton ebutton)
        {
            _allebuttons.Add(ebutton);
        }

        public void RemoveEButton(EmergencyButton ebutton)
        {
            _allebuttons.Remove(ebutton);
        } 


        public void AddIcon(Icon icon)
        {
            _allicons.Add(icon);
        }

        public void RemoveIcon(Icon icon)
        {
            _allicons.Remove(icon);
        }

        public void AddBorder(Border border)
        {
            _allborders.Add(border);
        }

        public void RemoveBorder(Border border)
        {
            _allborders.Remove(border);
        }

        public double CountPercentageTaskCompletion()
        {
            return ((Convert.ToDouble(CountCompletedTasks()) / Convert.ToDouble((TotalTasks)))*100);
        }
    

        public void DetermineGameEnd()
        {
            int dead = 0;
            int alive = 0;
            int infected = 9;
            int zombie = 0;

            dead = CountPlayerbyStatus(PlayerStatus.Dead);
            alive = CountPlayerbyStatus(PlayerStatus.Alive);
            infected = CountPlayerbyStatus(PlayerStatus.Infected);
            zombie = CountPlayerbyStatus(PlayerStatus.Unzombified) + CountPlayerbyStatus(PlayerStatus.Zombified);

            if (CountCompletedTasks() == TotalTasks)
            {
                string output = ("Game over-- Crewmates win.");
                string closeoutput = ("Press [Esc] to exit.");
                Icon icon = new Icon(this, output, "", closeoutput);
                this.AddIcon(icon);

            }

            else if ((alive <= 1) & (zombie <= 1) & (infected > dead))
            {
                string output = ("Game over-- Zombie Carrier wins.");
                string closeoutput = ("Press [Esc] to exit.");
                Icon icon = new Icon(this, output, "", closeoutput);
                this.AddIcon(icon);
                
            }

            else if ((alive <= 1) & (zombie <= 1) & (dead > infected))
            {
                string output = ("Game over-- Traitor wins.");
                string closeoutput = ("Press [Esc] to exit.");
                Icon icon = new Icon(this, output, "", closeoutput);
                this.AddIcon(icon);
            }

            else
            {
            }
        }
        
    }
}