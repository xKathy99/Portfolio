
// Character.cpp
#include "Character.h"
#include <iostream>


Character::Character()
{
	fMaxHP = 100;
	fCurrentHP = 100; // Character will start off with full health

	fCanDie = true;
	fIsDead = false; // Character will start off being not dead
}

Character::Character(string name, string id, bool candie, int maxhp, int posx, int posy):Entity(name, id, posx, posy)
{
	fMaxHP = maxhp;
	fCurrentHP = maxhp; // Character will start off with full health

	fCanDie = candie;
	fIsDead = false; // Character will start off being not dead
}


// Declare Setters
void Character::setMaxHP(int maxhp) // Setter for fMaxHP
{
	fMaxHP = maxhp;
}


void Character::setCurrentHP(int currenthp) // Setter for fCurrentHP
{
	fCurrentHP = currenthp;
}

void Character::setCanDie(bool candie) // Setter for fCanDie
{
	fCanDie = candie;
}

void Character::setIsDead(bool isdead) // Setter for fIsDead
{
	if (fCanDie == false) // If fCanDie is false (meaning the character does not die)
	{
		fIsDead = false; // Then the character will never be dead
	}

	else
	{
		fIsDead = isdead;
	}
}


// Declare Getters
int Character::getMaxHP() // Getter for fMaxHP
{
	return fMaxHP;
}

int Character::getCurrentHP() // Getter for fCurrentHP
{
	return fCurrentHP;
}

bool Character::getCanDie() // Getter for fCanDie
{
	return fCanDie;
}

bool Character::getIsDead() // Getter for fIsDead
{
	return fIsDead;
}


//Declare functions
void Character::increaseHP(int increaseby) // Function to increase HP
{
	if (fCurrentHP < fMaxHP)
	{
		fCurrentHP = fCurrentHP + increaseby; // Increase character HP

		if (fCurrentHP > fMaxHP) // If current HP exceeds max HP
		{
			fCurrentHP = fMaxHP; // Character HP has been maxed out
		}
	}
}


void Character::decreaseHP(int decreaseby) // Function to decrease HP
{
	fCurrentHP = fCurrentHP - decreaseby; // Decrease character HP

	if (fCurrentHP <= 0) // If current HP decreases below zero or is zero
	{
		Die(); // Then character dies. Call die function
	}

} 


void Character::Die()
{
	fCurrentHP = 0; // Character HP has been minimised
	fIsDead = true; // Character dies
}


void Character::moveLeft(int x) // Move left by x amount
{
	fPosition.X = fPosition.X - x;
}

void Character::moveRight(int x) // Move right by x amount
{
	fPosition.X = fPosition.X + x;
}

void Character::moveUp(int y) // Move up by y amount
{
	fPosition.Y = fPosition.Y + y;
}

void Character::moveDown(int y) // Move down by y amount
{
	fPosition.Y = fPosition.Y - y;

}

// Declare Destructor
Character::~Character()
{
}
