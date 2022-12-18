
//StepNode.h
#pragma once // Guards against repeated inclusion
#include <iostream>
#include <string>

using namespace std;

class StepNode // Doubly-Linked Node to represent Steps taken
{

private:
	string fDirection; // Records the direction taken
	int fPosX; // Position x
	int fPosY; // Position y
	int fStepNumber; // nth step

	StepNode* fNext; // Pointer to the next node
	StepNode* fPrevious; // Pointer to a previous node

public:

	StepNode(); // Default constructor
	StepNode(string direction, int stepnumber, int posx, int posy); // Constructor, where direction can be: LEFT, RIGHT, UP, DOWN

	// Declaring Getters

	StepNode* getPrevNode(); // Get pointer to the previous node
	StepNode* getNextNode(); // Get pointer to the next node

	string getDirection();  // Getter for fSkillName
	int getPosX(); // Getter for fPosX
	int getPosY(); // Getter for fPosY
	int getStepNumber(); // Getter for fStepNumber

	// Declaring Setters
	void setDirection(string direction); // Setter for fSkillName


	// Declaring functions
	void prependStep(StepNode& skill); // Add in a skill before current skill node
	void appendStep(StepNode& skill); // Add in a skill after current skill node
	void removeStep(); // Remove current node from links



	//Destructor
	virtual ~StepNode();
};
