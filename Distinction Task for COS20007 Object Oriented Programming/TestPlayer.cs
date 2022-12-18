/* 
using System;
using SplashKitSDK;
using NUnit.Framework;

//the most abstract class, Player has been chosen
//Below are a set of unit tests all related child classes (Crewmate, Medic, Traitor, and ZombieCarrier) must pass
//The derived classes are proven to pass the tests

namespace DT01
{
    [TestFixture()]
    public class TestPlayer
    {
        [Test()]
        public void TestGoUp() //This tests if the Player can go up
        {
            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.AliceBlue);
            TestCrewmate01.X = 100;
            TestCrewmate01.Y = 100;

            TestCrewmate01.Up();
            Assert.AreEqual(150, TestCrewmate01.Y);
            Assert.AreEqual(100, TestCrewmate01.X);

            TestCrewmate01.HasTool = true;
            TestCrewmate01.Up();
            Assert.AreEqual(170, TestCrewmate01.Y);
            Assert.AreEqual(100, TestCrewmate01.X);
        }

        [Test()]
        public void TestGoDown() //This tests if the Player can go down
        {
            Traitor TestTraitor01 = new Traitor("Player01", Color.AliceBlue);
            TestTraitor01.X = 100;
            TestTraitor01.Y = 100;

            TestTraitor01.Down();
            Assert.AreEqual(50, TestTraitor01.Y);
            Assert.AreEqual(100, TestTraitor01.X);
        }
        
        [Test()]
        public void TestGoLeft() //This tests if the Player can go to the left
        {
            Medic TestMedic01 = new Medic("Player01", Color.AliceBlue);
            TestMedic01.X = 100;
            TestMedic01.Y = 100;

            TestMedic01.HasTool = true; // Medic is holding a tool

            TestMedic01.Left();
            Assert.AreEqual(100, TestMedic01.Y);
            Assert.AreEqual(80, TestMedic01.X);
        }

        [Test()]
        public void TestGoRight() //This tests if the Player can go to the right
        {
            ZombieCarrier TestZombieCarrier01 = new ZombieCarrier("Player01", Color.AliceBlue);
            TestZombieCarrier01.X = 100;
            TestZombieCarrier01.Y = 100;

            TestZombieCarrier01.Right();
            Assert.AreEqual(100, TestZombieCarrier01.Y);
            Assert.AreEqual(150, TestZombieCarrier01.X);
        }

        [Test()]
        public void TestCallEmergency() //This tests if the Player is near an Emergency button and can select the emergency button
        {
            Game TestGame01 = new Game();
            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.AliceBlue);
            AreaLocation EButtonPlacement = new AreaLocation(80, 80, 10, 10);
            EmergencyButton EButton = new EmergencyButton(EButtonPlacement, Color.Red);

            TestGame01.AddPlayer(TestCrewmate01);
            TestGame01.AddEButton(EButton);

            TestCrewmate01.X = 100;
            TestCrewmate01.Y = 100;

            Assert.AreEqual(true, TestCrewmate01.IsNear(EButton));

            TestCrewmate01.Action(TestGame01);

            Assert.AreEqual(true, EButton.IsEButtonSelected);
        }


        [Test()]
        public void TestTakeandDropTool() //This tests if the Player is near a tool and can take and drop it
        {
            Game TestGame01 = new Game();
            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.AliceBlue);
            AreaLocation ToolPlacement = new AreaLocation(80, 80, 10, 10);
            Tool TestWrench = new Tool(ToolPlacement, Color.Green, ToolType.Wrench);

            TestGame01.AddPlayer(TestCrewmate01);
            TestGame01.AddTool(TestWrench);

            TestCrewmate01.X = 100;
            TestCrewmate01.Y = 100;

            Assert.AreEqual(true, TestCrewmate01.IsNear(TestWrench));

            TestCrewmate01.ToolAction(TestGame01); // Player takes the tool
            Assert.AreEqual(true, TestCrewmate01.HasTool);

            TestCrewmate01.ToolAction(TestGame01); // Player should drop the tool
            Assert.AreEqual(false, TestCrewmate01.HasTool);
        }

        [Test()]
        public void TestFixEquipment() //This tests if the Player can fix an equipment
        {
            Game TestGame01 = new Game();
            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.AliceBlue);
            Traitor TestTraitor01 = new Traitor("Player02", Color.OldLace);
            AreaLocation EquipmentPlacement = new AreaLocation(80, 80, 10, 10);
            Equipment Lights = new Equipment(EquipmentPlacement, Color.Yellow);

            TestGame01.AddPlayer(TestCrewmate01);
            TestGame01.AddPlayer(TestTraitor01);
            TestGame01.AddEqp(Lights);

            TestTraitor01.X = 120;
            TestTraitor01.Y = 120;

            TestCrewmate01.X = 100;
            TestCrewmate01.Y = 100;

            TestTraitor01.Sabotage(TestGame01);
            Assert.AreEqual(true, Lights.IsSabotaged); //Traitor will sabotage the equipment

            Assert.AreEqual(true, TestCrewmate01.IsNear(Lights)); // Assert crewmate is near the equipment

            TestCrewmate01.Action(TestGame01); // Crewmate will fix the equipment
            Assert.AreEqual(false, Lights.IsSabotaged); // Assert equipment is fixed
        }

        [Test()]
        public void TestDoTask() // This tests if a player can do task
        {
            Game TestGame01 = new Game();
            Medic TestMedic01 = new Medic("Player01", Color.White);
            AreaLocation TaskPlacement = new AreaLocation(80, 80, 10, 10);
            AreaLocation ToolPlacement = new AreaLocation(-10, -10, 10, 10);
            Task UnclogToilet = new Task(TaskPlacement, Color.Gainsboro, ToolType.Plunger);
            Tool TestPlunger = new Tool(ToolPlacement, Color.Green, ToolType.Plunger);

            TestGame01.AddPlayer(TestMedic01);
            TestGame01.AddTask(UnclogToilet);
            TestGame01.AddTool(TestPlunger);
            

            TestMedic01.X = 30;
            TestMedic01.Y = 30;
            Assert.AreEqual(true, TestMedic01.IsNear(TestPlunger));
            
            Assert.AreEqual(false, UnclogToilet.IsComplete); // Assert task is incomplete
            TestMedic01.ToolAction(TestGame01);
            
            Assert.AreEqual(true, TestMedic01.HasTool);

            TestMedic01.Up();
            TestMedic01.Up();
            
            Assert.AreEqual(70, TestMedic01.Y);

            Assert.AreEqual(true, TestMedic01.IsNear(UnclogToilet));

            TestMedic01.Action(TestGame01); // Medic will do a task
            Assert.AreEqual(true, UnclogToilet.IsComplete); // Assert task is complete
        }

        [Test()]
        public void TestNonZombiePlayerGetKilled() // This tests if the non-zombie carrier players can get killed
        {
            Game TestGame01 = new Game();
            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.AliceBlue);
            Traitor TestTraitor01 = new Traitor("Player02", Color.OldLace);

            TestGame01.AddPlayer(TestCrewmate01);
            TestGame01.AddPlayer(TestTraitor01);

            TestTraitor01.KillCooldown = 0; // Traitor is not on kill cooldown

            TestTraitor01.X = 100;
            TestTraitor01.Y = 100;

            TestCrewmate01.X = 130;
            TestCrewmate01.Y = 150;

            Assert.AreEqual(true, TestTraitor01.IsNear(TestCrewmate01)); // Assert Traitor is near player
            TestTraitor01.KillAction(TestGame01);

            Assert.AreEqual(PlayerStatus.Dead, TestCrewmate01.Status); // Assert player is dead
        }

        [Test()]
        public void TestZombiePlayerGetKilled() // This tests if the zombie carrier players can get zombiefied after being killed
        {
            Game TestGame01 = new Game();
            ZombieCarrier TestZombieCarrier01 = new ZombieCarrier("Player01", Color.AliceBlue);
            Traitor TestTraitor01 = new Traitor("Player02", Color.OldLace);

            TestGame01.AddPlayer(TestZombieCarrier01);
            TestGame01.AddPlayer(TestTraitor01);

            TestTraitor01.KillCooldown = 0; // Traitor is not on kill cooldown

            TestTraitor01.X = 100;
            TestTraitor01.Y = 100;

            TestZombieCarrier01.X = 130;
            TestZombieCarrier01.Y = 150;

            Assert.AreEqual(true, TestTraitor01.IsNear(TestZombieCarrier01)); // Assert Traitor is near player
            TestTraitor01.KillAction(TestGame01);

            Assert.AreEqual(PlayerStatus.Zombified, TestZombieCarrier01.Status); // Assert zombie carrier player is zombiefied
        }


        [Test()]
        public void TestVotePlayer() // This tests if the zombie carrier players can get zombiefied after being killed
        {
            Game TestGame01 = new Game();

            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.Beige);
            ZombieCarrier TestZombieCarrier01 = new ZombieCarrier("Player02", Color.AliceBlue);
            Medic TestMedic01 =  new Medic("Player03", Color.PaleGoldenrod);
            Traitor TestTraitor01 = new Traitor("Player04", Color.OldLace);

            TestGame01.AddPlayer(TestCrewmate01);
            TestGame01.AddPlayer(TestZombieCarrier01);
            TestGame01.AddPlayer(TestMedic01);
            TestGame01.AddPlayer(TestTraitor01);
            
            TestCrewmate01.Vote(TestTraitor01);
            TestZombieCarrier01.Vote(TestTraitor01);
            TestMedic01.Vote(TestTraitor01);
            TestTraitor01.SkipVote();
            
            Assert.AreEqual(3, TestTraitor01.VotedBy); // Assert Traitor is voted by four people
        }

        [Test()]
        public void TestPlayerGetsEjected() // This tests if the player can get ejected
        {
            Game TestGame01 = new Game();

            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.Beige);
            Crewmate TestCrewmate02 = new Crewmate("Player02", Color.Fuchsia);
            ZombieCarrier TestZombieCarrier01 = new ZombieCarrier("Player03", Color.AliceBlue);
            Medic TestMedic01 =  new Medic("Player04", Color.PaleGoldenrod);
            Traitor TestTraitor01 = new Traitor("Player05", Color.OldLace);

            TestGame01.AddPlayer(TestCrewmate01);
            TestGame01.AddPlayer(TestCrewmate02);
            TestGame01.AddPlayer(TestZombieCarrier01);
            TestGame01.AddPlayer(TestMedic01);
            TestGame01.AddPlayer(TestTraitor01); // Asserts the number of non-ejected, dead or infected players

            Assert.AreEqual(5, TestGame01.CountPlayingPlayers());
            
            TestCrewmate01.Vote(TestTraitor01);
            TestCrewmate02.Vote(TestTraitor01);
            TestZombieCarrier01.Vote(TestTraitor01);
            TestMedic01.Vote(TestTraitor01);
            TestTraitor01.SkipVote();

            StringAssert.Contains("traitor", TestGame01.EjectPlayer()); // Tests if the ejected player is the traitor
            Assert.AreEqual(PlayerStatus.Ejected, TestTraitor01.Status); // Tests if the player's status is ejected
            Assert.AreEqual(4, TestGame01.CountPlayingPlayers()); // Asserts the number of non-ejected, dead or infected players
        }


        [Test()]
        public void TestPlayerGetsInfected() // This tests if the player can get infected
        {
            Game TestGame01 = new Game();

            Crewmate TestCrewmate01 = new Crewmate("Player01", Color.Beige);
            ZombieCarrier TestZombieCarrier01 = new ZombieCarrier("Player03", Color.AliceBlue);
            Traitor TestTraitor01 = new Traitor("Player05", Color.OldLace);

            TestGame01.AddPlayer(TestCrewmate01);
            TestGame01.AddPlayer(TestZombieCarrier01);
            TestGame01.AddPlayer(TestTraitor01); 

            TestCrewmate01.X = 50;
            TestCrewmate01.Y = 50;

            TestTraitor01.X = 180;
            TestTraitor01.Y = 180;

            TestZombieCarrier01.X = 160;
            TestZombieCarrier01.Y = 160;

            TestTraitor01.KillCooldown = 0; // Traitor player is not on kill cooldown
            TestTraitor01.KillAction(TestGame01); // Traitor Player attempts to kill zombie carrier player

            Assert.AreEqual(PlayerStatus.Zombified, TestZombieCarrier01.Status); // Assert zombie carrier player has become zombiefied

            TestZombieCarrier01.InfectCooldown = 0;

            TestZombieCarrier01.Down();
            TestZombieCarrier01.Down();
            TestZombieCarrier01.Left();
            TestZombieCarrier01.Left();

            TestZombieCarrier01.InfectAction(TestGame01); // Zombie player is not on infect cooldown
            Assert.AreEqual(PlayerStatus.Infected, TestCrewmate01.Status); // Assert zombie carrier player has become zombiefied

        }

    }

}

*/