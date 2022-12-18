
// Entity.h
#pragma once


#include <iostream>
#include <string>

using namespace std;

struct Position
{
	int X, Y;
};

class Entity
{

private:

protected:
	string fName; // Character name
	string fID; // Character ID
	Position fPosition;
	//int fPosition[2]; // (x, y) Position of character

	string fMessage; // Message dialogue

	bool fHasSkills; // Does character have a list of skills?
					// If skill list generated, this becomes true

public:
	Entity(); //Default constructor
	Entity(string name, string id, int posx, int posy);


	//Declare Setters
	void setName(string name); // Setter for fName
	void setID(string id); // Setter for fIDS
	void setPosition(int x, int y); // Setter for (x,y) position
	void setPositionX(int x); // Setter for x position
	void setPositionY(int y); // Setter for y position

	void setMessage(string msg); // Setter for fMessage


	//Declare Getters
	string getName(); // Getter for fName
	string getID(); // Getter for fID
	Position getPosition(); // Getter for x and y position

	string getMessage(); // Getter for fMessage

	//Friend Operator returns input stream
	friend istream& operator>>(istream& aIstream, Entity& aUnit);

	//Friend Operator returns output stream
	friend ostream& operator<<(ostream& aOstream, Entity& aUnit);

	void listen(string msg);
	void tell();


	//Destructor
	virtual ~Entity();
};
