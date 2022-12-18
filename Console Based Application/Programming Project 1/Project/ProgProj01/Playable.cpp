//Playable.cpp
#include "Playable.h"
#include <iostream>
#include <string>

//Perhaps use stack to store record of position- allow a function to backtrack 5 steps
//use node to keep track of total number of steps taken

Playable::Playable()
{
	fInventory[0] = " ";
	fInventory[1] = " ";
	fInventory[2] = " "; 
	
	fHoldingItem = false;
	fItemHeld  = ""; // no value, no item currently held
	fInventoryPtr = new Iterator1D(fInventory, 3); 	// has an accessable inventory, size 3
	fStepsTaken = 0;
	fStepCounter = 0;

	fStepListPointer = new StepRecordList();
}


Playable::Playable(string name, string id, bool candie, int maxhp, int posx, int posy):Character(name, id, candie, maxhp, posx, posy)
{
	fInventory[0] = "";
	fInventory[1] = "";
	fInventory[2] = "";

	fHoldingItem = false;
	fItemHeld = ""; // no value, no item currently held
	fInventoryPtr = new Iterator1D(fInventory, 3); 	// has an accessable inventory, size 3
	fStepsTaken = 0;
	fStepCounter = 0;

	fStepListPointer = new StepRecordList();
}

// Declare Setters
void Playable::setHoldingItem(bool choice) // Setter for fHoldingItem
{
	fHoldingItem = choice;
}

void Playable::setItemHeld(string item)
{
	fItemHeld = item;
}


// Declare Getters

int Playable::getStepsTaken()
{
	return fStepsTaken;
}

int Playable::getStepCounter()
{
	return fStepCounter;
}

bool Playable::getHoldingItem() // Getter for fHoldingItem
{
	return fHoldingItem;
}

string Playable::getItemHeld() // 
{
	return fItemHeld;
}



// Declare functions
void Playable::moveLeft(int x) // Move left by x amount
{
	fPosition.X = fPosition.X - x;
	fStepsTaken++;
	fStepCounter++;

	fStepListPointer->addStep("Left", fStepsTaken, fPosition.X, fPosition.Y);
}

void Playable::moveRight(int x) // Move right by x amount
{
	fPosition.X = fPosition.X + x;
	fStepsTaken++;
	fStepCounter++;

	fStepListPointer->addStep("Right", fStepsTaken, fPosition.X, fPosition.Y);

}

void Playable::moveUp(int y) // Move up by y amount
{
	fPosition.Y = fPosition.Y + y;
	fStepsTaken++;
	fStepCounter++;

	fStepListPointer->addStep("Up", fStepsTaken, fPosition.X, fPosition.Y);

}

void Playable::moveDown(int y) // Move down by y amount
{
	fPosition.Y = fPosition.Y - y;
	fStepsTaken++;
	fStepCounter++;

	fStepListPointer->addStep("Down", fStepsTaken, fPosition.X, fPosition.Y);

}


void Playable::resetStepCount(int stepnumber) // Reset number of steps when it hits a certain number of steps
{
	if (fStepCounter == stepnumber)
	{
		fStepCounter = 0;
	}
}



void Playable::showInventory()
{
	for (int i = 0; i < 3; i++)
	{
		cout << " " << fInventory[i] << " ";
	}
}

void Playable::inventoryNextItem() //Increment
{
	if ((*fInventoryPtr) == (fInventoryPtr->end()))
	{
		fInventoryPtr->end();

		//Don't do anything if at max end of inventory
	}

	else
	{
		++(*fInventoryPtr);
	}

	for (int i = 0; i < 3; i++)
	{
		if (fInventoryPtr->getIndex() == i)
		{
			cout << " [" << fInventory[i] << "] ";
		}

		else
		{
			cout << " " << fInventory[i] << " ";
		}
	}
}

void Playable::inventoryPrevItem() //Decrement
{
	if ((*fInventoryPtr) == (fInventoryPtr->begin()))
	{
		fInventoryPtr->begin();
		//Don't do anything if at min beginning of inventory
	}

	else
	{
		--(*fInventoryPtr);
	}

	for (int i = 0; i < 3; i++)
	{
		if (fInventoryPtr->getIndex() == i)
		{
			cout << " [" << fInventory[i] << "] ";
		}

		else
		{
			cout << " " << fInventory[i] << " ";
		}
	}

}


void Playable::addItem(string itemname) // Add item into inventory
{
	bool itemadded = false;


	for (int i = 0; i < 3; i++)
	{
		if ((fInventory[i] == "") & (itemadded == false))
		{
			fInventory[i] = itemname;
			itemadded = true;
			cout << itemname << " added into inventory!" << endl;
		}
	}

	if (itemadded == false) // Means the inventory is full
	{
		cout << "Inventory is full! Unable to take." << endl;
	}

	if (fHoldingItem == true)
	{
		fHoldingItem = false;
		fItemHeld = "";
	}	

}

Iterator1D* Playable::getInventoryItem()
{
	return fInventoryPtr;
}

void Playable::takeItem() // Get inventory item void GetItem(Iterator* iterator ptr, return fItemHeld);
{
	fHoldingItem = true;
	fItemHeld = *(*fInventoryPtr);

	for (int i = 0; i < 3; i++)
	{
		if (fInventoryPtr->getIndex() == i)
		{
			fInventory[i] = "";
		}
	}

	cout << fItemHeld << " has been selected!" << endl;
}


void Playable::dropItem() // Drop inventory item
{
	fItemHeld = ""; // make value void- 'delete' item
	fHoldingItem = false;
}

void Playable::viewLastSteps(int limit)
{
	cout << fStepListPointer->showLastSteps(limit);
}

// Declare Destructor
Playable::~Playable()
{
	delete fInventoryPtr;
}
