
//NonPlayable.h
#pragma once

#include <iostream>
#include <string>
#include "Character.h"

using namespace std;

class NonPlayable : public Character
{
private:
protected:
	bool fWillDropItem;
	string fItemHeld;
	bool fIsFriendly; // is this NPC friendly? if false, will attack PC

public:
	NonPlayable();
	NonPlayable(string name, string id, bool candie, int maxhp, int posx, int posy, bool isfriendly);

	string DropItem(); // Return item dropped by the enemy

	// Declare Setters
	void setWillDropItem(bool choice); // Setter for fWillDropItem
	void setItemHeld(string itemname); // Setter for fItemHeld
	void setIsFriendly(bool choice); // Setter for fIsFriendly

	// Declare Getters
	bool getWillDropItem(); // Getter for fWillDropItem
	string getItemHeld(); // Getter for fItemHeld
	bool getIsFriendly(); // Getter for fIsFriendly

	// Declare functions
	void die();

	//Destructor
	virtual ~NonPlayable();
};
