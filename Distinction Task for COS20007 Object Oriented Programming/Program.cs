using System;
using SplashKitSDK;

namespace DT01
{
    class Program
    {
        public static void Main()
        {
            Game myFirstgame = new Game();  

            Bitmap crewmate =  new Bitmap("Player01", "Picture1.png");
            Bitmap traitor =  new Bitmap("Player02", "Picture2.png");  
            Bitmap medic =  new Bitmap("Player03", "Picture3.png");  
            Bitmap zombiecarrier =  new Bitmap("Player04", "Picture4.png");      
            Bitmap dead = new Bitmap("Dead", "dead.png");
            Bitmap infected = new Bitmap("Infected", "infected.png");
            
            Icon[] myRooms= {new Icon(myFirstgame, 0, 0, 300, 200, "Left Engine"),
            new Icon(myFirstgame, 300, 0, 400, 200, "Reactor"),
            new Icon(myFirstgame, 700, 0, 300, 200, "Right Engine"),
            new Icon(myFirstgame, 0, 200, 300, 200, "Oxygen"),
            new Icon(myFirstgame, 300, 200, 400, 100, "Hallway"),
            new Icon(myFirstgame, 700, 200, 150, 500, "Storage"),
            new Icon(myFirstgame, 850, 200, 150, 500, "Electrical"),
            new Icon(myFirstgame, 0, 400, 150, 400, "Bunk"),
            new Icon(myFirstgame, 150, 400, 150, 300, "Lab"),
            new Icon(myFirstgame, 300, 300, 400, 400, "Common Area"),
            new Icon(myFirstgame,  0, 800, 150, 200, "Bathroom"),
            new Icon(myFirstgame, 150, 700, 150, 300, "MedBay"),
            new Icon(myFirstgame, 300, 700, 400, 100, "Comms"),
            new Icon(myFirstgame, 300, 800, 400, 200, "Navigation"),
            new Icon(myFirstgame, 700, 700, 300, 300, "Workshop")};

            foreach(Icon i in myRooms)
            {
                myFirstgame.AddIcon(i);
            }

            Border[] myBorders = {
                new Border(myFirstgame, 0, 0, 1000, 4),
                new Border(myFirstgame, 0, 0, 4, 1000),
                new Border(myFirstgame, 0, 996, 1000, 4),
                new Border(myFirstgame, 996, 0, 4, 1000),

                new Border(myFirstgame, 298, 0, 4, 125),
                new Border(myFirstgame, 698, 0, 4, 125),

                new Border(myFirstgame, 298, 198, 4, 25),
                new Border(myFirstgame, 698, 198, 4, 25),

                new Border(myFirstgame, 0, 198, 625, 4),
                new Border(myFirstgame, 698, 198, 300, 4),

                new Border(myFirstgame, 298, 298, 4, 100),
                new Border(myFirstgame, 0, 398, 300, 4),

                new Border(myFirstgame, 298, 298, 400, 4),

                new Border(myFirstgame, 848, 198, 4, 425),

                new Border(myFirstgame, 698, 298, 4, 175),

                new Border(myFirstgame, 698, 548, 4, 250),

                new Border(myFirstgame, 148, 398, 4, 75),

                new Border(myFirstgame, 148, 548, 4, 450),
                new Border(myFirstgame, 0, 548, 4, 400),

                new Border(myFirstgame, 0, 798, 75, 4),

                new Border(myFirstgame, 298, 698, 125, 4),
                new Border(myFirstgame, 298, 798, 150, 4),

                new Border(myFirstgame, 498, 698, 200, 4),
                new Border(myFirstgame, 523, 798, 175, 4),
                
                new Border(myFirstgame, 698, 698, 300, 4),

                new Border(myFirstgame, 698, 798, 4, 75),

                new Border(myFirstgame, 298, 473, 4, 250),

                new Border(myFirstgame, 298, 948, 4, 50),
                new Border(myFirstgame, 698, 948, 4, 50),

                new Border(myFirstgame, 298, 698, 4, 175),
                
                new Border(myFirstgame, 148, 698, 150, 4)

            };    

            foreach (Border b in myBorders)
            {
                myFirstgame.AddBorder(b);
            }

            Bitmap taskimg = new Bitmap("Task", "task.png");            

            Icon Task_LeftEngine_icon = new Icon(taskimg, myFirstgame, 120, 35, IconType.Task, "Task in Left Engine");
            Icon Task_Reactor_icon = new Icon(taskimg, myFirstgame, 635, 70, IconType.Task, "Task in Reactor");
            Icon Task_RightEngine_icon = new Icon(taskimg, myFirstgame, 820, 35, IconType.Task, "Task in Right Engine");
            Icon Task_Oxygen_icon = new Icon(taskimg, myFirstgame, 20, 235, IconType.Task, "Task in Oxygen");
            Icon Task_Storage_icon = new Icon(taskimg, myFirstgame, 770, 500, IconType.Task, "Task in Storage");
            Icon Task_Electrical_icon = new Icon(taskimg, myFirstgame, 870, 245, IconType.Task, "Task in Electrical"); 
            Icon Task_Bunk_icon = new Icon(taskimg, myFirstgame, 20, 420, IconType.Task, "Task in Bunk");
            Icon Task_Lab_icon = new Icon(taskimg, myFirstgame, 235, 570, IconType.Task, "Task in Lab");
            Icon Task_CommonArea_icon = new Icon(taskimg, myFirstgame, 470, 335, IconType.Task, "Task in Common Area");
            Icon Task_Bathroom_icon = new Icon(taskimg, myFirstgame, 35, 950, IconType.Task, "Task in Bathroom");
            Icon Task_MedBay_icon = new Icon(taskimg, myFirstgame, 210, 770, IconType.Task, "Task in Medbay");
            Icon Task_Navigation01_icon = new Icon(taskimg, myFirstgame, 350, 925, IconType.Task, "Task in Left Navigation");
            Icon Task_Navigation02_icon = new Icon(taskimg, myFirstgame, 590, 925, IconType.Task, "Task in Right Navigation");
            Icon Task_Workshop_icon = new Icon(taskimg, myFirstgame, 910, 740, IconType.Task, "Task in Workshop");

            Icon[] myTaskIcons = {Task_LeftEngine_icon, Task_Reactor_icon, Task_RightEngine_icon, Task_Oxygen_icon, Task_Storage_icon, Task_Electrical_icon,
            Task_Bunk_icon, Task_Lab_icon, Task_CommonArea_icon, Task_Bathroom_icon, Task_MedBay_icon, Task_Navigation01_icon, Task_Navigation02_icon, Task_Workshop_icon};

            foreach(Icon i in myTaskIcons)
            {
                myFirstgame.AddIcon(i);
            }

            Task[] myTasks = {new Task(Task_LeftEngine_icon, ToolType.Screwdriver),
            new Task(Task_Reactor_icon),
            new Task(Task_RightEngine_icon, ToolType.Screwdriver),
            new Task(Task_Oxygen_icon, ToolType.Screwdriver),
            new Task(Task_Storage_icon),
            new Task(Task_Electrical_icon, ToolType.Tape),
            new Task(Task_Bunk_icon),
            new Task(Task_Lab_icon, ToolType.Tape),
            new Task(Task_CommonArea_icon),
            new Task(Task_Bathroom_icon, ToolType.Plunger),
            new Task(Task_MedBay_icon),
            new Task(Task_Navigation01_icon),
            new Task(Task_Navigation02_icon),
            new Task(Task_Workshop_icon, ToolType.Wrench)};
            
            foreach (Task t in myTasks)
            {
                myFirstgame.AddTask(t);
            }

            Bitmap img_wrench = new Bitmap("Wrench", "wrench.png");
            Bitmap img_screwdriver = new Bitmap("Screwdriver", "screwdriver.png");
            Bitmap img_tape = new Bitmap("Tape", "tape.png");
            Bitmap img_plunger = new Bitmap("Plunger", "plunger.png");

            Icon Tool_Wrench_icon = new Icon(img_wrench, myFirstgame, 750, 100, IconType.Tool, "Wrench");
            Icon Tool_Screwdriver_icon = new Icon(img_screwdriver, myFirstgame, 50, 700, IconType.Tool, "Screwdriver");
            Icon Tool_Tape_icon = new Icon(img_tape, myFirstgame, 600, 600, IconType.Tool, "Tape");
            Icon Tool_Plunger_icon = new Icon(img_plunger, myFirstgame, 745, 740, IconType.Tool, "Plunger");

            Icon[] myToolIcons = {Tool_Wrench_icon, Tool_Screwdriver_icon, Tool_Tape_icon, Tool_Plunger_icon};

            Tool Tool_Wrench = new Tool(Tool_Wrench_icon, ToolType.Wrench);
            Tool Tool_Screwdriver = new Tool(Tool_Screwdriver_icon, ToolType.Screwdriver);
            Tool Tool_Tape = new Tool(Tool_Tape_icon, ToolType.Tape);
            Tool Tool_Plunger = new Tool(Tool_Plunger_icon, ToolType.Plunger);
            
            Tool[] myTools = {Tool_Wrench, Tool_Screwdriver, Tool_Tape, Tool_Plunger};

            foreach (Tool t in myTools)
            {
                myFirstgame.AddTool(t);
            }
            
            foreach(Icon i in myToolIcons)
            {
                myFirstgame.AddIcon(i);
            }

            Bitmap img_vent = new Bitmap("Vent", "vent.png");

            Icon Vent_Reactor_icon = new Icon(img_vent, myFirstgame, 340, 30, IconType.Vent, "Vent in Reactor");
            Icon Vent_Electrical_icon = new Icon(img_vent, myFirstgame, 930, 385, IconType.Vent, "Vent in Electrical"); 
            Icon Vent_Oxygen_icon = new Icon(img_vent, myFirstgame, 240, 350, IconType.Vent, "Vent in Oxygen");
            Icon Vent_CommonArea_icon = new Icon(img_vent, myFirstgame, 320, 635, IconType.Vent, "Vent in Common Area");
            Icon Vent_Bathroom_icon = new Icon(img_vent, myFirstgame, 20, 835, IconType.Vent, "Vent in Bathroom");
            Icon Vent_Workshop_icon = new Icon(img_vent, myFirstgame, 820, 935, IconType.Vent, "Vent in Workshop");

            Icon[] myVentIcons = {Vent_Reactor_icon, Vent_Electrical_icon, Vent_Oxygen_icon, Vent_CommonArea_icon, Vent_Bathroom_icon, Vent_Workshop_icon};

            foreach (Icon i in myVentIcons)
            {
                myFirstgame.AddVent(new Vent(i));
                myFirstgame.AddIcon(i);
            }

            Bitmap img_eqp = new Bitmap("Equipment", "equipment.png");

            Icon Equipment_Reactor_icon = new Icon(img_eqp, myFirstgame, 470, 130, IconType.Equipment, "Equipment in Reactor");
            Icon Equipment_Oxygen_icon = new Icon(img_eqp, myFirstgame, 170, 235, IconType.Equipment, "Equipment in Oxygen");
            Icon Equipment_Workshop_icon = new Icon(img_eqp, myFirstgame, 930, 920, IconType.Equipment, "Equipment in Storage");
            Icon Equipment_Electrical_icon = new Icon(img_eqp, myFirstgame, 920, 485, IconType.Equipment, "Equipment in Electrical");
            Icon Equipment_Comms_icon = new Icon(img_eqp, myFirstgame, 320, 735, IconType.Equipment, "Equipment in Comms");

            Icon[] myEquipmentIcons = {Equipment_Reactor_icon, Equipment_Oxygen_icon, Equipment_Workshop_icon, Equipment_Electrical_icon, Equipment_Comms_icon};

            foreach (Icon i in myEquipmentIcons)
            {
                myFirstgame.AddEqp(new Equipment(i));
                myFirstgame.AddIcon(i);
            }


            Icon myCrewmate01_icon = new Icon(crewmate, dead, infected, myFirstgame, 470, 400, IconType.Player, "Crewmate");
            myFirstgame.AddIcon(myCrewmate01_icon);

            Crewmate myCrewmate01 = new Crewmate(myCrewmate01_icon.IconName, myFirstgame, myCrewmate01_icon);
            myFirstgame.AddPlayer(myCrewmate01);

            Icon myTraitor01_icon = new Icon(traitor, dead, infected, myFirstgame, 500, 400, IconType.Player, "Traitor");
            myFirstgame.AddIcon(myTraitor01_icon);

            Traitor myTraitor01 = new Traitor(myTraitor01_icon.IconName, myFirstgame, myTraitor01_icon);
            myFirstgame.AddPlayer(myTraitor01);

            Icon myMedic01_icon = new Icon(medic, dead, infected, myFirstgame, 430, 400, IconType.Player, "Medic");
            myFirstgame.AddIcon(myMedic01_icon);

            Medic myMedic01 = new Medic(myMedic01_icon.IconName, myFirstgame, myMedic01_icon);
            myFirstgame.AddPlayer(myMedic01);

            Icon myZombieCarrier01_icon = new Icon(zombiecarrier, dead, infected, myFirstgame, 450, 400, IconType.Player, "ZombieCarrier");
            myFirstgame.AddIcon(myZombieCarrier01_icon);

            ZombieCarrier myZombieCarrier01 = new ZombieCarrier(myZombieCarrier01_icon.IconName, myFirstgame, myZombieCarrier01_icon);
            myFirstgame.AddPlayer(myZombieCarrier01);

            Console.WriteLine("Among Us-- Freeplay/Demo");
            Console.WriteLine(": Modelling of object interactions inspired by the game Among Us by InnerSloth.");
            Console.WriteLine("-------------------------------- Info -------------------------------------------------");
            Console.WriteLine("To use:");
            Console.WriteLine("1. Switch between characters by toggling 1, 2, 3, 4 on the keyboard.");
            Console.WriteLine("\t 1: Crewmate.");
            Console.WriteLine("\t 2: Traitor");
            Console.WriteLine("\t 3: Medic");
            Console.WriteLine("\t 4: Zombie Carrier");
            Console.WriteLine("2. Use Up, Down, Left, Right keypad buttons to move around all characters.");
            Console.WriteLine("3. For all characters (except traitor and zombies), toggle spacebar to do tasks and fix equipment.");
            Console.WriteLine("4. For all characters, toggle T key to pick up tools. Certain tasks will require tools to be completed.");
            Console.WriteLine("5. Traitor can kill players by toggling K key, and move in vents by toggling V key. Toggle S key to sabotage equipment.");
            Console.WriteLine("6. ZombieCarriers can be zombiefied after being killed. Toggle I key to infect others.");
            Console.WriteLine("7. Medic can heal ZombieCarrier to become normal by toggling H key. Medic can only heal once.");
            Console.WriteLine("8. The aim is for: ");
            Console.WriteLine("\t 1: Crewmate(+ Medic) to win by completing all tasks.");
            Console.WriteLine("\t 2: Traitor to win by killing a majority of the players.");
            Console.WriteLine("\t 3: Zombie Carrier to win by infecting a majority of the players,");















            int mode = 1;

            do
            {
                SplashKit.ProcessEvents();
                SplashKit.ClearScreen(Color.Black);

                myFirstgame.DetermineGameEnd();
                
                if (SplashKit.KeyTyped(KeyCode.EscapeKey))
                {
                    myFirstgame.gameWindow.Close();
                    break;
                }

                if (SplashKit.KeyTyped(KeyCode.KeypadEnter))
                {
                    foreach (Icon i in myFirstgame.AllIcons)
                    {
                        if (i.TypeofIcon == IconType.Notification)
                        {
                            if (i.IsShownBefore == false)
                            {
                                i.IsShownBefore = true;
                                i.UnDraw();
                            }                         
                        }
                    }    
                }
            
                foreach (Icon i in myFirstgame.AllIcons)
                {
                    if (i.TypeofIcon != IconType.Notification)
                    {
                        i.Draw();
                    }
                }

                foreach (Equipment eqp in myFirstgame.AllEqp)
                {
                    eqp.CheckCallIconHighlight();
                }

                foreach (Border b in myFirstgame.AllBorders)
                {
                    b.DrawMapBorders();
                } 

                foreach (Icon i in myFirstgame.AllIcons)
                {
                    if (i.TypeofIcon == IconType.Notification)
                    {
                        if (i.IsShownBefore == false)
                        {
                            i.Draw();
                        }
                        
                    }
                }

                if (SplashKit.KeyTyped(KeyCode.Num1Key)) // not number pad keys
                { mode = 1; } // Control Crewmate

                if (SplashKit.KeyTyped(KeyCode.Num2Key)) // not number pad keys
                { mode = 2; } // Control Traitor
 
                if (SplashKit.KeyTyped(KeyCode.Num3Key)) // not number pad keys
                { mode = 3; } // Control Medic

                if (SplashKit.KeyTyped(KeyCode.Num4Key)) // not number pad keys
                { mode = 4; } // Control Zombie Carrier


                if (mode == 1)
                {
                    myCrewmate01.CheckIsNearHighlight(myFirstgame);
                    SplashKit.SetCameraX(myCrewmate01.CurrentIcon.AtX-300);
                    SplashKit.SetCameraY(myCrewmate01.CurrentIcon.AtY-300);

                    if (SplashKit.KeyTyped(KeyCode.UpKey))
                    {
                        myCrewmate01.Up(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.DownKey))
                    {
                        myCrewmate01.Down(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.LeftKey))
                    {
                        myCrewmate01.Left(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.RightKey))
                    {
                        myCrewmate01.Right(myFirstgame);
                    }   

                    if(SplashKit.KeyTyped(KeyCode.SpaceKey))
                    {
                        myCrewmate01.Action(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.TKey))
                    {
                        myCrewmate01.ToolAction(myFirstgame);
                    }

                }

                if (mode == 2) // control traitor
                {
                    myTraitor01.CheckIsNearHighlight(myFirstgame);
                    //myTraitor01.StartKillCoolDownTimer();
                
                    SplashKit.SetCameraX(myTraitor01.CurrentIcon.AtX-300);
                    SplashKit.SetCameraY(myTraitor01.CurrentIcon.AtY-300);

                    if (SplashKit.KeyTyped(KeyCode.UpKey))
                    {
                        myTraitor01.Up(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.DownKey))
                    {
                        myTraitor01.Down(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.LeftKey))
                    {
                        myTraitor01.Left(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.RightKey))
                    {
                        myTraitor01.Right(myFirstgame);
                    }

                    if(SplashKit.KeyTyped(KeyCode.SpaceKey))
                    {
                        myTraitor01.Action(myFirstgame);
                    }

                    if(SplashKit.KeyTyped(KeyCode.TKey))
                    {
                        myTraitor01.ToolAction(myFirstgame);
                    }

                    if(SplashKit.KeyTyped(KeyCode.SKey))
                    {
                        myTraitor01.Sabotage(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.VKey))
                    {
                        myTraitor01.VentAction(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.KKey))
                    {
                        myTraitor01.KillAction(myFirstgame);
                    }
                }

                if (mode == 3) // Control Medic
                {
                    myMedic01.CheckIsNearHighlight(myFirstgame);
                    SplashKit.SetCameraX(myMedic01.CurrentIcon.AtX-300);
                    SplashKit.SetCameraY(myMedic01.CurrentIcon.AtY-300);
                    
                    if (SplashKit.KeyTyped(KeyCode.UpKey))
                    {
                        myMedic01.Up(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.DownKey))
                    {
                        myMedic01.Down(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.LeftKey))
                    {
                        myMedic01.Left(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.RightKey))
                    {
                        myMedic01.Right(myFirstgame);
                    }

                    if(SplashKit.KeyTyped(KeyCode.SpaceKey))
                    {
                        myMedic01.Action(myFirstgame);
                    }

                    if(SplashKit.KeyTyped(KeyCode.TKey))
                    {
                        myMedic01.ToolAction(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.HKey))
                    {
                        myMedic01.HealAction(myFirstgame);
                    }
                }

                if (mode == 4) // Control Zombie Carrier
                {
                    myZombieCarrier01.CheckIsNearHighlight(myFirstgame);
                    
                    
                    SplashKit.SetCameraX(myZombieCarrier01.CurrentIcon.AtX-300);
                    SplashKit.SetCameraY(myZombieCarrier01.CurrentIcon.AtY-300);

                    if (SplashKit.KeyTyped(KeyCode.UpKey))
                    {
                        myZombieCarrier01.Up(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.DownKey))
                    {
                        myZombieCarrier01.Down(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.LeftKey))
                    {
                        myZombieCarrier01.Left(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.RightKey))
                    {
                        myZombieCarrier01.Right(myFirstgame);
                    }

                    if(SplashKit.KeyTyped(KeyCode.SpaceKey))
                    {
                        myZombieCarrier01.Action(myFirstgame);
                    }

                    if(SplashKit.KeyTyped(KeyCode.TKey))
                    {
                        myZombieCarrier01.ToolAction(myFirstgame);
                    }

                    if (SplashKit.KeyTyped(KeyCode.IKey))
                    {
                        myZombieCarrier01.InfectAction(myFirstgame);
                    }
                }

                SplashKit.RefreshScreen(60);    

                //SplashKit.DrawBitmapOnWindow      
                // let user know when the game is ending, show another windoiw?? draw bitmap mabe


            }
            while(! SplashKit.QuitRequested());
        }
            
        
    }
}