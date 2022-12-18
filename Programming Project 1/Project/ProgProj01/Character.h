
// Character.h
#pragma once
#include <iostream>
#include <string>
#include "Entity.h"

using namespace std;

class Character : public Entity
{
private:
protected:
	int fMaxHP; // Max healthpoint
	int fCurrentHP; // Current healthpoint
	bool fCanDie; // Can the character die? 
	bool fIsDead; // Is character dead? (will be = true if fCurrentHP = 0
					// if fCanDie = false, fIsDead is permanently = false)
	
	//When char fight decrease hp by half

public:
	Character();
	Character(string name, string id, bool candie, int maxhp, int posx, int posy);


	//Declare Setters
	void setMaxHP(int maxhp); // Setter for fMaxHP
	void setCurrentHP(int currenthp); // Setter for fCurrentHP

	void setCanDie(bool candie); // Setter for fCanDie
	void setIsDead(bool isdead); // Setter for fIsDead


	//Declare Getters
	int getMaxHP(); // Getter for fMaxHP
	int getCurrentHP(); // Getter for fCurrentHP

	bool getCanDie(); // Getter for fCanDie
	bool getIsDead(); // Getter for fIsDead

	//Declare functions
	void increaseHP(int increaseby); // Function to increase HP
	void decreaseHP(int decreaseby); // Function to decrease HP

	virtual void Die();

	virtual void moveLeft(int x); // Move left by x amount
	virtual void moveRight(int x); // Move right by x amount
	virtual void moveUp(int y); // Move up by y amount
	virtual void moveDown(int y); // Move down by y amount
	
	//Destructor
	virtual ~Character();

};