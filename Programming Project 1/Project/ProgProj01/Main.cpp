//Main.cpp 

#include <iostream>
#include <SFML/Audio.hpp>
#include "Entity.h"
#include "Character.h"
#include "Object.h"
#include "NonPlayable.h"
#include "Iterator.h"
#include "MapPiece.h"
#include "RiddleRecordList.h"

using namespace std;

int main()
{
	string userInput = "run";

	// String variables defined
		string msgPit = "Into the pit I fall! Die I shall.";
		string msgFear = "Something feels off.";
		string msgBreeze = "I feel a breeze...";
		string msgEnemy = "Oh no. There's a... sphinx.";

		string instruction = "Welcome to the MAZE, where all dreamers enter but few survive. Navigate through these corridors-- find the exit, and we'll let you go unharmed. Though of course, we love that if you could stay. But know that you are not alone within these walls... \n A note of advice: Try not to run, but face your fears head-on. Who knows, you might be going in the right direction.";
		string instruction2 = "\n GAME INSTRUCTIONS : \n 1) Navigate this maze using w, a, s, d keys to move up, left, down, right. \n 2) If you feel a breeze, there is a pit nearby. Don't fall into it, you'll die!";
		string instruction3 = " 3) If something feels off, there is an Sphinx nearby. You can choose to approach and answer it, attack or run. Some of them drop useful items when they die, be sure to pick them up.";
		string instruction4 = " 4) Other game controls, type: ";
		string instruction5 = " 'menu' to access the game menu\n 'stat' to view player stats \n 'bag' to access your inventory \n 'trace' to review your last five steps";
		string hint = " Remember: Try not to run, but face your fears head-on. Who knows, you might be going in the right direction.";

		string itemDubiousWeapon = "weapon";
		string itemHealthPotion = "potion";
	

	// Defining the walls in the maze
		Walls CorridorH;
		{
			CorridorH.LeftW = false;
			CorridorH.RightW = false;
			CorridorH.FrontW = true;
			CorridorH.BackW = true;
		}

		Walls CorridorV;
		{
			CorridorV.LeftW = true;
			CorridorV.RightW = true;
			CorridorV.FrontW = false;
			CorridorV.BackW = false;
		}

		Walls TopRightC;
		{
			TopRightC.LeftW = false;
			TopRightC.RightW = true;
			TopRightC.FrontW = true;
			TopRightC.BackW = false;
		}

		Walls TopLeftC;
		{
			TopLeftC.LeftW = true;
			TopLeftC.RightW = false;
			TopLeftC.FrontW = true;
			TopLeftC.BackW = false;
		}

		Walls BottomRightC;
		{
			BottomRightC.LeftW = false;
			BottomRightC.RightW = true;
			BottomRightC.FrontW = false;
			BottomRightC.BackW = true;
		}

		Walls BottomLeftC;
		{
			BottomLeftC.LeftW = true;
			BottomLeftC.RightW = false;
			BottomLeftC.FrontW = false;
			BottomLeftC.BackW = true;
		}

		Walls LeftDeadEnd;
		{
			LeftDeadEnd.LeftW = true;
			LeftDeadEnd.RightW = false;
			LeftDeadEnd.FrontW = true;
			LeftDeadEnd.BackW = true;
		}

		Walls RightDeadEnd;
		{
			RightDeadEnd.LeftW = false;
			RightDeadEnd.RightW = true;
			RightDeadEnd.FrontW = true;
			RightDeadEnd.BackW = true;
		}

		Walls FrontDeadEnd;
		{
			FrontDeadEnd.LeftW = true;
			FrontDeadEnd.RightW = true;
			FrontDeadEnd.FrontW = true;
			FrontDeadEnd.BackW = false; 
		}

		Walls BackDeadEnd;
		{
			BackDeadEnd.LeftW = true;
			BackDeadEnd.RightW = true;
			BackDeadEnd.FrontW = false;
			BackDeadEnd.BackW = true;
		}

		Walls OnlyLeftW;
		{
			OnlyLeftW.LeftW = true;
			OnlyLeftW.RightW = false;
			OnlyLeftW.FrontW = false;
			OnlyLeftW.BackW = false;
		}

		Walls OnlyRightW;
		{
			OnlyRightW.LeftW = false;
			OnlyRightW.RightW = true;
			OnlyRightW.FrontW = false;
			OnlyRightW.BackW = false;
		}

		Walls OnlyFrontW;
		{
			OnlyFrontW.LeftW = false;
			OnlyFrontW.RightW = false;
			OnlyFrontW.FrontW = true;
			OnlyFrontW.BackW = false;
		}

		Walls OnlyBackW;
		{
			OnlyBackW.LeftW = false;
			OnlyBackW.RightW = false;
			OnlyBackW.FrontW = false;
			OnlyBackW.BackW = true;
		}

		Walls NoWalls;
		{
			NoWalls.LeftW = false;
			NoWalls.RightW = false;
			NoWalls.FrontW = false;
			NoWalls.BackW = false;
		}
	
	// Objecct pointers defined
		Object* objectPtr = nullptr;
		NonPlayable* NPCPtr = nullptr;
		Playable* myPC = nullptr;
		RiddleRecordList* RiddleRecordPtr = nullptr;

	// Generating Game Map
		MapPiece* myMap[10][10];

		// Column 0
		{
			myMap[0][0] = new MapPiece(BackDeadEnd);
			myMap[0][1] = new MapPiece(TopLeftC);
			myMap[0][2] = new MapPiece(BottomLeftC);
			myMap[0][3] = new MapPiece(CorridorV);
			myMap[0][4] = new MapPiece(FrontDeadEnd);

			objectPtr = new Object("Pit", "Pit0,5", 0, 5, true);
			objectPtr->setMessage(msgPit);
			myMap[0][5] = new MapPiece(BackDeadEnd, *objectPtr);

			objectPtr = new Object("Breeze", "Breeze0,6", 0, 6, false);
			objectPtr->setMessage(msgBreeze);
			myMap[0][6] = new MapPiece(CorridorV, *objectPtr);

			myMap[0][7] = new MapPiece(OnlyLeftW);
			myMap[0][8] = new MapPiece(OnlyLeftW);
			myMap[0][9] = new MapPiece(TopLeftC);
		}

		// Column 1
		{
			objectPtr = new Object("Pit", "Pit1,0", 1, 0, true);
			objectPtr->setMessage(msgPit);
			myMap[1][0] = new MapPiece(LeftDeadEnd, *objectPtr);

			myMap[1][1] = new MapPiece(BottomRightC);

			objectPtr = new Object("Fear", "Fear1,2", 1, 2, false);
			objectPtr->setMessage(msgFear);
			myMap[1][2] = new MapPiece(NoWalls, *objectPtr);

			NPCPtr = new NonPlayable("Sphinx", "Sphinx1,3", true, 10, 1, 3, false);
			NPCPtr->setMessage(msgEnemy);
			NPCPtr->setWillDropItem(true);
			NPCPtr->setItemHeld(itemDubiousWeapon);
			myMap[1][3] = new MapPiece(CorridorV, *NPCPtr);

			objectPtr = new Object("Fear", "Fear1,4", 1, 4, false);
			objectPtr->setMessage(msgFear);
			myMap[1][4] = new MapPiece(OnlyLeftW, *objectPtr);

			objectPtr = new Object("Breeze", "Breeze1,5", 1, 5, false);
			objectPtr->setMessage(msgBreeze);
			myMap[1][5] = new MapPiece(OnlyLeftW, *objectPtr);

			myMap[1][6] = new MapPiece(FrontDeadEnd);
			myMap[1][7] = new MapPiece(CorridorH);
			myMap[1][8] = new MapPiece(CorridorH);
			myMap[1][9] = new MapPiece(CorridorH);
		}

		// Column 2
		{
			objectPtr = new Object("Breeze", "Breeze2,0", 2, 0, false);
			objectPtr->setMessage(msgBreeze);
			myMap[2][0] = new MapPiece(OnlyBackW, *objectPtr);

			myMap[2][1] = new MapPiece(CorridorV);
			myMap[2][2] = new MapPiece(OnlyRightW);
			myMap[2][3] = new MapPiece(TopLeftC);
			myMap[2][4] = new MapPiece(CorridorH);

			objectPtr = new Object("Pit", "Pit2,5", 2, 5, true);
			objectPtr->setMessage(msgPit);
			myMap[2][5] = new MapPiece(RightDeadEnd, *objectPtr);

			myMap[2][6] = new MapPiece(BottomLeftC);

			objectPtr = new Object("Fear", "Fear2,7", 2, 7, false);
			objectPtr->setMessage(msgFear);
			myMap[2][7] = new MapPiece(OnlyFrontW, *objectPtr);

			objectPtr = new Object("Breeze", "Breeze2,8", 2, 8, false);
			objectPtr->setMessage(msgBreeze);
			myMap[2][8] = new MapPiece(CorridorH, *objectPtr);

			myMap[2][9] = new MapPiece(CorridorH);
		}

		// Column 3
		{
			myMap[3][0] = new MapPiece(CorridorH);

			NPCPtr = new NonPlayable("Sphinx", "Sphinx3,1", true, 10, 3, 1, false);
			NPCPtr->setMessage(msgEnemy);
			myMap[3][1] = new MapPiece(BottomLeftC, *NPCPtr);

			objectPtr = new Object("Fear", "Fear3,2", 3, 2, false);
			objectPtr->setMessage(msgFear);
			myMap[3][2] = new MapPiece(OnlyLeftW, *objectPtr);

			objectPtr = new Object("Breeze", "Breeze3,3", 3, 3, false);
			objectPtr->setMessage(msgBreeze);
			myMap[3][3] = new MapPiece(OnlyFrontW, *objectPtr);

			objectPtr = new Object("Fear", "Fear3,4", 3, 4, false);
			objectPtr->setMessage(msgFear);
			myMap[3][4] = new MapPiece(OnlyBackW, *objectPtr);

			myMap[3][5] = new MapPiece(TopLeftC);
			myMap[3][6] = new MapPiece(CorridorH);

			NPCPtr = new NonPlayable("Sphinx", "Sphinx3,7", true, 10, 3, 7, false);
			NPCPtr->setMessage(msgEnemy);
			NPCPtr->setWillDropItem(true);
			NPCPtr->setItemHeld(itemDubiousWeapon);
			myMap[3][7] = new MapPiece(CorridorH, *NPCPtr);

			objectPtr = new Object("Pit", "Pit3,8", 3, 8, true);
			objectPtr->setMessage(msgPit);
			myMap[3][8] = new MapPiece(RightDeadEnd, *objectPtr);

			myMap[3][9] = new MapPiece(CorridorH);
		}

		// Column 4
		{
			myMap[4][0] = new MapPiece(CorridorH);

			objectPtr = new Object("Fear", "Fear4,1", 4, 1, false);
			objectPtr->setMessage(msgFear);
			myMap[4][1] = new MapPiece(CorridorH, *objectPtr);

			myMap[4][2] = new MapPiece(CorridorH);

			objectPtr = new Object("Pit", "Pit4,3", 4, 3, true);
			objectPtr->setMessage(msgPit);
			myMap[4][3] = new MapPiece(RightDeadEnd, *objectPtr);

			NPCPtr = new NonPlayable("Sphinx", "Sphinx4,4", true, 10, 4, 4, false);
			NPCPtr->setMessage(msgEnemy);
			NPCPtr->setWillDropItem(true);
			NPCPtr->setItemHeld(itemHealthPotion);
			myMap[4][4] = new MapPiece(CorridorH, *NPCPtr);

			myMap[4][5] = new MapPiece(CorridorH);
			myMap[4][6] = new MapPiece(CorridorH);

			objectPtr = new Object("Fear", "Fear4,7", 4, 7, false);
			objectPtr->setMessage(msgFear);
			myMap[4][7] = new MapPiece(CorridorH, *objectPtr);

			myMap[4][8] = new MapPiece(BackDeadEnd);
			myMap[4][9] = new MapPiece(TopRightC);
		}

		// Column 5
		{
			myMap[5][0] = new MapPiece(BottomRightC);

			objectPtr = new Object("Fear", "Fear5,1", 5, 1, false);
			objectPtr->setMessage(msgFear);
			myMap[5][1] = new MapPiece(OnlyFrontW, *objectPtr);

			myMap[5][2] = new MapPiece(BottomRightC);
			myMap[5][3] = new MapPiece(CorridorV);

			objectPtr = new Object("Fear", "Fear5,4", 5, 4, false);
			objectPtr->setMessage(msgFear);
			myMap[5][4] = new MapPiece(TopRightC, *objectPtr);

			myMap[5][5] = new MapPiece(CorridorH);

			objectPtr = new Object("Fear", "Fear5,6", 5, 6, false);
			objectPtr->setMessage(msgFear);
			myMap[5][6] = new MapPiece(CorridorH, *objectPtr);

			myMap[5][7] = new MapPiece(BottomRightC);
			myMap[5][8] = new MapPiece(CorridorV);
			myMap[5][9] = new MapPiece(TopLeftC); // EXIT
		}

		// Column 6
		{
			myMap[6][0] = new MapPiece(LeftDeadEnd);

			NPCPtr = new NonPlayable("Sphinx", "Sphinx6,1", true, 10, 6, 1, false);
			NPCPtr->setMessage(msgEnemy);
			myMap[6][1] = new MapPiece(OnlyBackW, *NPCPtr);

			objectPtr = new Object("Fear", "Fear6,2", 6, 2, false);
			objectPtr->setMessage(msgFear);
			myMap[6][2] = new MapPiece(CorridorV, *objectPtr);

			myMap[6][3] = new MapPiece(CorridorV);
			myMap[6][4] = new MapPiece(CorridorV);
			myMap[6][5] = new MapPiece(TopRightC);

			NPCPtr = new NonPlayable("Sphinx", "Sphinx6,6", true, 10, 6, 6, false);
			NPCPtr->setMessage(msgEnemy);
			NPCPtr->setWillDropItem(true);
			NPCPtr->setItemHeld(itemDubiousWeapon);
			myMap[6][6] = new MapPiece(CorridorH, *NPCPtr);

			myMap[6][7] = new MapPiece(LeftDeadEnd);
			myMap[6][8] = new MapPiece(BottomLeftC);
			myMap[6][9] = new MapPiece(OnlyFrontW);
		}

		// Column 7
		{
			myMap[7][0] = new MapPiece(CorridorH);

			objectPtr = new Object("Fear", "Fear7,1", 7, 1, false);
			objectPtr->setMessage(msgFear);
			myMap[7][1] = new MapPiece(BottomRightC, *objectPtr);

			myMap[7][2] = new MapPiece(OnlyLeftW);
			myMap[7][3] = new MapPiece(CorridorV);
			myMap[7][4] = new MapPiece(OnlyLeftW);
			myMap[7][5] = new MapPiece(CorridorV);

			objectPtr = new Object("Fear", "Fear7,6", 7, 6, false);
			objectPtr->setMessage(msgFear);
			myMap[7][6] = new MapPiece(OnlyRightW, *objectPtr);

			myMap[7][7] = new MapPiece(TopRightC);

			objectPtr = new Object("Breeze", "Breeze7,8", 7, 8, false);
			objectPtr->setMessage(msgBreeze);
			myMap[7][8] = new MapPiece(CorridorH, *objectPtr);

			myMap[7][9] = new MapPiece(CorridorH);
		}

		// Column 8
		{
			objectPtr = new Object("Breeze", "Breeze8,0", 8, 0, false);
			objectPtr->setMessage(msgBreeze);
			myMap[8][0] = new MapPiece(OnlyBackW, *objectPtr);

			objectPtr = new Object("Pit", "Pit8,1", 8, 1, true);
			objectPtr->setMessage(msgPit);
			myMap[8][1] = new MapPiece(FrontDeadEnd, *objectPtr);

			myMap[8][2] = new MapPiece(CorridorH);
			myMap[8][3] = new MapPiece(LeftDeadEnd);
			myMap[8][4] = new MapPiece(OnlyBackW);
			myMap[8][5] = new MapPiece(CorridorV);
			myMap[8][6] = new MapPiece(CorridorV);
			myMap[8][7] = new MapPiece(TopLeftC);

			objectPtr = new Object("Pit", "Pit8,8", 8, 8, true);
			objectPtr->setMessage(msgPit);
			myMap[8][8] = new MapPiece(RightDeadEnd, *objectPtr);

			myMap[8][9] = new MapPiece(CorridorH);
		}

		// Column 9
		{
			objectPtr = new Object("Fear", "Fear9,0", 9, 0, false);
			objectPtr->setMessage(msgFear);
			myMap[9][0] = new MapPiece(BottomRightC, *objectPtr);

			NPCPtr = new NonPlayable("Sphinx", "Sphinx9,1", true, 10, 9, 1, false);
			NPCPtr->setMessage(msgEnemy);
			NPCPtr->setWillDropItem(true);
			NPCPtr->setItemHeld(itemHealthPotion);
			myMap[9][1] = new MapPiece(CorridorV, *NPCPtr);

			objectPtr = new Object("Fear", "Fear9,2", 9, 2, false);
			objectPtr->setMessage(msgFear);
			myMap[9][2] = new MapPiece(OnlyRightW, *objectPtr);

			myMap[9][3] = new MapPiece(OnlyRightW);

			objectPtr = new Object("Breeze", "Breeze9,4", 9, 4, false);
			objectPtr->setMessage(msgBreeze);
			myMap[9][4] = new MapPiece(OnlyRightW, *objectPtr);

			objectPtr = new Object("Pit", "Pit9,5", 9, 5, true);
			objectPtr->setMessage(msgPit);
			myMap[9][5] = new MapPiece(FrontDeadEnd, *objectPtr);

			myMap[9][6] = new MapPiece(BackDeadEnd);
			myMap[9][7] = new MapPiece(OnlyRightW);
			myMap[9][8] = new MapPiece(CorridorV);
			myMap[9][9] = new MapPiece(TopRightC);
		}
	
	// Generating Riddle List
		RiddleRecordPtr = new RiddleRecordList();
		RiddleRecordPtr->addRiddle("What do you call a fish with no eyes?", "Myxine Glutinosa", "Blind", "I dunno... fsh?", 2);
		RiddleRecordPtr->addRiddle("At night they come without being fetched, and by day they are lost without being stolen. What are they?", "The stars", "Dreams", "Time", 0);
		RiddleRecordPtr->addRiddle("What is the meaning of life?", "Whatever which we choose to give it", "There's none", "E", 2);
		RiddleRecordPtr->addRiddle("Why is a raven like a writing desk?", "They're both not made of cheese", "Because Poe wrote on both", "I haven't the slightest idea", 2);
		RiddleRecordPtr->addRiddle("Why did the chicken cross the road?", "To get to the other side", "There was a car coming", "I don't know. Why?", 0);

	// SFML
		sf::SoundBuffer buffer;
		if (!buffer.loadFromFile("HyruleCastle.wav"))
		{
			return -1;
		}

		sf::Sound sound;
		sound.setBuffer(buffer);
		sound.play();
	
	cout << "WELCOME TO THE MAZE." << endl;
	cout << "========================" << endl;
	cout << "Press any key to start..." << endl;

	string anykey = "";
	cin >> anykey;

	cout << endl << "What is your name?:" << endl;
	cout << "Input: ";
	string myname = "";
	cin >> myname;

	myPC = new Playable(myname, "0001", true, 15, 0, 0);

	
	cout << endl << "Welcome " << myname << ". Let us begin..." << endl << endl;

	cout << instruction << endl << instruction2 << endl << instruction3 << endl << instruction4 << endl << instruction5 << endl << hint << endl;
	cout << "======================================================" << endl << endl;

	cout << "Press 'w' to take your first step!" << endl;

	do
	{
		if ((myPC->getPosition().X == 5) & (myPC->getPosition().Y == 5))
		{
			myPC->setMessage("I can see the light! This is it! I have reached the exit!");
			cout << *(myPC) << endl;

			userInput = "win game";
		}

		else
		{
			cout << "Input: ";
			cin >> userInput;
		}

	
		if (userInput == "w") //go UP
		{
			//if there is no wall in front of me
			if (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getWalls().FrontW == false)
			{
				//proceed to move up
				myPC->moveUp(1);
			}

			else
			{
				cout << "Can't go up. There's a wall blocking me. My position: " << myPC->getPosition().X << ", " << myPC->getPosition().Y << endl;
			}
			userInput = "run";
		}

		if (userInput == "a") // go LEFT
		{

			//if there is no wall on my left
			if (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getWalls().LeftW == false)
			{
			
				if ((myPC->getPosition().X == 0) & (myPC->getPosition().Y == 0))
				{
					myPC->setMessage("This is where I started from... I musn't go backwards.");
					cout << *(myPC) << endl;
				}

				else
				{
					//proceed to move left
					myPC->moveLeft(1);
				}

			}

			else
			{
				cout << "Can't go left. There's a wall blocking me. My position: " << myPC->getPosition().X << ", " << myPC->getPosition().Y << endl;
			}

			userInput = "run";

		}

		if (userInput == "d") // move RIGHT
		{
			//if there is no wall on my right
			if (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getWalls().RightW == false)
			{
				//proceed to move right
				myPC->moveRight(1);
			}

			else
			{
				cout << "Can't go right. There's a wall blocking me. My position: " << myPC->getPosition().X << ", " << myPC->getPosition().Y << endl;
			}

			userInput = "run";
		}

		if (userInput == "s") // move DOWN
		{
			// if there is no wall behind me
			if (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getWalls().BackW == false)
			{
				// proceed to move down
				myPC->moveDown(1);
			}
			else
			{
				cout << "Can't go down. There's a wall blocking me. My position: " << myPC->getPosition().X << ", " << myPC->getPosition().Y << endl;
			}

			userInput = "run";
		}

		if (userInput == "view")
		{
			myPC->viewLastSteps(5);
		}

		// Be in the same square as a game object
		if (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getObject() != nullptr)
		{
			// The object induces death
			if (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getObject()->getInduceDeath() == true)
			{
				myPC->Die();
			}
			cout << *(myMap[myPC->getPosition().X][myPC->getPosition().Y]->getObject());
		}

		// If meeting enemy
		if (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getNPC() != nullptr)
		{

			NPCPtr = (myMap[myPC->getPosition().X][myPC->getPosition().Y]->getNPC());

			if (NPCPtr->getIsDead() == false)
			{
				cout << endl;
				cout << *(NPCPtr);
				cout << endl;
				string userInputMeetEnemy = "";
				cout << "What do I do?" << endl << "1) Approach with caution" << endl << "2) Attack (-4 HP, if without weapon)" << endl << "3) Run (-3HP)";
				cout << endl;
				cout << endl << "Input: ";
				cin >> userInputMeetEnemy;

				if (userInputMeetEnemy == "1") // Approach enemy
				{
					NPCPtr->setMessage(RiddleRecordPtr->showRiddleAndChoices());
					cout << *(NPCPtr);
					cout << endl;
					cout << "Input: ";
					int userInputRiddle;
					
					cin >> userInputRiddle;

					if ((userInputRiddle-1) != RiddleRecordPtr->correctAns())
					{
						myPC->setMessage("Oh God, it's wrong. RUN.");
						cout << *(myPC) << endl;

						myPC->decreaseHP(3);
					}

					else
					{
						NPCPtr->setMessage("Sphinx says: You are right. You may pass.");
						cout << *(NPCPtr);
						cout << myPC->getCurrentHP() << endl;
					}

					RiddleRecordPtr->NextRiddle();
					NPCPtr->setMessage(msgEnemy);
				}

				else if (userInputMeetEnemy == "2")
				{
					if ((myPC->getHoldingItem() == true) & (myPC->getItemHeld() == itemDubiousWeapon))
					{
						NPCPtr->Die();
						cout << "The Sphinx died." << endl;
						myPC->dropItem(); 

						string droppeditem = NPCPtr->DropItem();

						cout << "The Sphinx dropped " << droppeditem << "! Put to inventory? (yes/no)" << endl;
						string inputChoice = "";

						cin >> inputChoice;

						if (inputChoice == "yes")
						{
							myPC->addItem(droppeditem);
						}
					}

					else
					{
						NPCPtr->decreaseHP(NPCPtr->getMaxHP() / 2);
						{
							if (NPCPtr->getCurrentHP() <= 0)
							{
								NPCPtr->Die();
								cout << "The Sphinx died." << endl;

								string droppeditem = NPCPtr->DropItem();

								cout << "The Sphinx dropped " << droppeditem << "! Put to inventory? (yes/no)" << endl;
								string inputChoice = "";

								cin >> inputChoice;

								if (inputChoice == "yes")
								{
									myPC->addItem(droppeditem);
								}
							}

							else
							{
								myPC->decreaseHP(4);
								myPC->setMessage("Oh nawh he's not dead yet... RUN.");
								cout << *(myPC);
							}
						}

					}
				}

				else // (userInputMeetEnemy == "3") // Run from Enemy
				{
					myPC->decreaseHP(3);
				}
			}
			
			else
			{
				NPCPtr->setMessage("Oh... the Sphinx is dead. Man, sure feels unsettling around here.");
				cout << *(NPCPtr);
			}

			userInput = "run";
		}

		if (userInput == "bag")
		{
			myPC->showInventory();
			cout << endl;
			cout << endl;

			cout << "Select item? (yes/no)" << endl;
			string inputChoice = "";
			string inputScroll = "";

			cin >> inputChoice;

			if (inputChoice == "yes")
			{
				cout << "Scroll inventory: (a/d). Press 's' to use item, 'w' to drop item, press 'x' to close inventory." << endl;
				myPC->showInventory();

				do
				{
					cout << endl;
					cout << "Input: ";
					cin >> inputScroll;

					if (inputScroll == "a")
					{
						myPC->inventoryPrevItem(); //Cout first element
					}

					if (inputScroll == "d")
					{
						myPC->inventoryNextItem(); //Cout first element
					}

					if (inputScroll == "s")
					{
						myPC->takeItem(); //Cout first element

						if (myPC->getItemHeld() == itemHealthPotion)
						{
							string usePotion = "";

							cout << "Use health potion? (+3HP) (yes/no)" << endl;
							cin >> usePotion;

							if (usePotion == "yes")
							{
								myPC->increaseHP(4);
								myPC->dropItem();
								cout << "Health increased by 4 HP!" << endl;
							}

							else
							{
								myPC->addItem(itemHealthPotion);
							}
						}

						myPC->showInventory();
					}

					if (inputScroll == "w")
					{
						if (myPC->getHoldingItem() == true)
						{
							myPC->dropItem();
							cout << myPC->getItemHeld() << " has been dropped!" << endl;

						}
					}

					if (inputScroll == "x")
					{
						inputChoice = "n";
					}

				} while (inputChoice == "yes");
			}

			else
			{
				cout << "Inventory closed." << endl;
			}
		}

		if (userInput == "stats")
		{
			cout << endl;
			cout << "====================" << endl;
			cout << "Player name: " << myPC->getName() << "(ID: " << myPC->getID() << ")" << endl;
			cout << "Current Position: (" << myPC->getPosition().X << "," << myPC->getPosition().Y << ")" << endl;
			cout << "HP:" << myPC->getCurrentHP() << "/" << myPC->getMaxHP() << endl;
			cout << "Total number steps taken: " << myPC->getStepsTaken() << endl;

			cout << "Item held: " << myPC->getItemHeld() << endl;
			cout << endl;

			cout << "Type 'trace' to trace back the last 5 steps taken." << endl;
			cout << "Type 'bag' to view inventory contents" << endl;
			cout << "====================" << endl;
			cout << endl;
		}

		if (userInput == "trace")
		{
			cout << "====================" << endl;
			myPC->viewLastSteps(5);
			cout << "====================" << endl;
			cout << endl;
		}

		if ((myPC->getCurrentHP() <= 0) || (myPC->getIsDead() == true))
		{
			cout << "You died... game over. Do you want to retry? (yes/no)" << endl;
			string inputChoice = "";
			cout << "Input: ";
			cin >> inputChoice;

			if (inputChoice == "yes")
			{
				userInput = "e";
			}

			else
			{
				userInput = "exit game";
			}
		}


		if (userInput == "win game")
		{
			cout << "Congratulations, you have survived the maze! Replay? (yes/no)" << endl;
			cin >> userInput;

			if (userInput == "yes")
			{
				// restart
			}

			else
			{
				userInput = "exit game";
			}

		}

		
		if (userInput == "menu")
		{
			cout << "MAIN MENU:" << endl;
			cout << "Choose... (Press 'x' or any key to close)" << endl;
			cout << "1) Help" << endl;
			cout << "2) Exit" << endl;
			cout << "3) Restart" << endl;
			cout << "Input: " << endl;
			 
			string userChoice;
			cin >> userChoice;

			if (userChoice == "1")
			{
				cout << "========================================" << endl;
				cout << instruction2 << endl << instruction3 << endl << instruction4 << endl << instruction5 << endl << endl << hint << endl;
				cout << "========================================" << endl;

				userInput = "run";
			}

			if (userChoice == "2")
			{
				userInput = "exit game";
			}

			else if (userChoice == "3")
			{
				//restart
			}

			else
			{
				userInput = "run";
			}
		}

		if (userInput == "exit game")
		{
			cout << "Are you sure you want to exit? (yes/no)" << endl;
			cin >> userInput;

			if (userInput == "yes")
			{
				userInput = "end";
			}

			else
			{
				userInput = "run";
			}

		}

		cout << "My position : " << myPC->getPosition().X << ", " << myPC->getPosition().Y << endl;
		cout << "My HP: " << myPC->getCurrentHP() << endl;
	} while (userInput != "end");
	
	cout << "Exiting Program..." << endl;


	delete myPC;
	delete RiddleRecordPtr;
	int fRow = 10;
	int fCol = 10;

	for (int i = 0; i < fRow; i++)
	{
		for (int j = 0; j < fCol; j++)
		{
			delete myMap[i][j];
		}
	}
	return 0;
}