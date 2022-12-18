
// Entity.cpp
#include "Entity.h"
#include <iostream>
#include <string>

using namespace std;

Entity::Entity() //Default constructor
{
	fName = "Player01";
	fID = "L00000000";
	fPosition.X = 0; // x position
	fPosition.Y = 0; // y position


	fMessage = "";
}

Entity::Entity(string name, string id, int posx, int posy)
{
	fName = name;
	fID = id;
	fPosition.X = posx; // x position
	fPosition.Y = posy; // y position

	fMessage = "";
}


// Declare Setters

void Entity::setName(string owner) // Setter for fName
{
	fName = owner;
}

void Entity::setID(string id) // Setter for fID
{
	fID = id;
}

void Entity::setPosition(int x, int y) // Setter for (x,y) position
{
	fPosition.X = x;
	fPosition.Y = y;
}

void Entity::setPositionX(int x) // Setter for x position
{
	fPosition.X = x;
}

void Entity::setPositionY(int y) // Setter for y position
{
	fPosition.Y = y;
}

void Entity::setMessage(string msg) // Setter for fMessage
{
	fMessage = msg;
}


//Declare Getters

string Entity::getName() // Getter for name
{
	return fName;
}

string Entity::getID() // Getter for ID
{
	return fID;
}

Position Entity::getPosition() // Getter for x and y position
{
	return fPosition;
}


string Entity::getMessage() // Getter for fMessage
{
	return fMessage;
}


void Entity::listen(string msg)
{
	fMessage = msg;
}

void Entity::tell()
{
	cout << fMessage << endl;
}


// Friend Operator returns input stream
istream& operator>>(istream& aIstream, Entity& aUnit)
{
	getline(aIstream, aUnit.fMessage); //get a line of string
	//aIstream >> aUnit.fMessage;
	return aIstream;
}

// Friend Operator returns output stream
ostream& operator<<(ostream& aOstream, Entity& aUnit)
{
	aOstream << aUnit.fMessage << endl;
	return aOstream;
}


// Declare Destructor
Entity::~Entity()
{
}
