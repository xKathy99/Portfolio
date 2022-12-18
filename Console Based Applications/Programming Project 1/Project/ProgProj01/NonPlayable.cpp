//NonPlayable.cpp
#include "NonPlayable.h"
#include <iostream>

NonPlayable::NonPlayable()
{
	fWillDropItem = false;
	fItemHeld = "";
	fIsFriendly = true;
}


NonPlayable::NonPlayable(string name, string id, bool candie, int maxhp, int posx, int posy, bool isfriendly) :Character(name, id, candie, maxhp, posx, posy)
{
	fWillDropItem = false;
	fItemHeld = "";
	fIsFriendly = isfriendly;

}

string NonPlayable::DropItem()
{
	string drop = "";
	
	if ((fWillDropItem == true) & (fIsDead == true))
	{
		drop = fItemHeld;
	}

	return drop;
}


//Declare Setters

void NonPlayable::setWillDropItem(bool choice)
{
	fWillDropItem = choice;
}

void NonPlayable::setItemHeld(string itemname)
{
	fItemHeld = itemname;
}

void NonPlayable::setIsFriendly(bool choice)
{
	fIsFriendly = choice;
}


//Declare Getters

bool NonPlayable::getWillDropItem()
{
	return fWillDropItem;
}

string NonPlayable::getItemHeld()
{
	return fItemHeld;
}

bool NonPlayable::getIsFriendly()
{
	return fIsFriendly;
}


// Declare Functions
void NonPlayable::die()
{
	fCurrentHP = 0; // NPCharacter HP has been minimised
	fIsDead = true; // NPCharacter dies

	if (fWillDropItem == true)
	{
		DropItem();
	}
	
}


// Declare Destructor
NonPlayable::~NonPlayable()
{
}
