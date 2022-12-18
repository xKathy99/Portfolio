
//Playable.h
#pragma once

#include <iostream>
#include <string>
#include "Character.h"
#include "Iterator1D.h" //MUST INCLUDE TO USE ITERATOR OBJECT
#include "StepRecordList.h"
using namespace std;


class Playable : public Character
{
private:
protected:
	
	string fInventory[3]; 	// has an accessable inventory
	
	bool fHoldingItem; // is PC holding an item
	string fItemHeld;

	int fStepsTaken; // Number of moves the character walked
	int fStepCounter; // Counts a 'cycle' of steps; reset at a certain value to carry out something
	//last step taken and number of steps

	Iterator1D* fInventoryPtr;

	StepRecordList* fStepListPointer;

public:
	Playable();
	Playable(string name, string id, bool candie, int maxhp, int posx, int posy);

	// Declare Setters
	void setHoldingItem(bool choice); // Setter for fHoldingItem
	void setItemHeld(string item);

	// Declare Getters
	int getStepsTaken(); // Getter for fStepsTaken
	int getStepCounter(); // Getter for fStepCounter
	bool getHoldingItem();
	string getItemHeld(); // Getter for fHoldingItem

	// Polymorphism
	void moveLeft(int x); // Move left by x amount
	void moveRight(int x); // Move right by x amount
	void moveUp(int y); // Move up by y amount
	void moveDown(int y); // Move down by y amount



	// Declaring functions
	void resetStepCount(int stepnumber); // Reset number of steps

	void showInventory();


	void inventoryNextItem(); //Increment
	void inventoryPrevItem(); //Decrement

	void addItem(string itemname); // Add item into inventory

	Iterator1D* getInventoryItem();

	void takeItem(); // Get inventory item void GetItem(Iteraor* iterator ptr, return fItemHeld);
	void dropItem(); // Drop inventory item

	void viewLastSteps(int limit);

	//Destructor
	virtual ~Playable();
};
