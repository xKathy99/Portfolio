// Object.h
#pragma once
#include "Entity.h"

#include <iostream>
#include <string>

using namespace std;

class Object : public Entity
{
private:
protected:
	bool fInduceDeath;

public:
	Object();
	Object(string name, string id, int posx, int posy, bool cancausedeath);

	//Declare Setters
	void setInduceDeath(bool choice);

	//Declare Getters
	bool getInduceDeath();
};