// Object.cpp

#include "Object.h"
#include <iostream>
#include <string>

using namespace std;

Object::Object()
{
	fInduceDeath = false;
}

Object::Object(string name, string id, int posx, int posy, bool cancausedeath) :Entity(name, id, posx, posy)
{
	fInduceDeath = cancausedeath;
}


// Declare Setters
void Object::setInduceDeath(bool choice)
{
	fInduceDeath = choice;
}

// Declare Getters
bool Object::getInduceDeath()
{
	return fInduceDeath;
}