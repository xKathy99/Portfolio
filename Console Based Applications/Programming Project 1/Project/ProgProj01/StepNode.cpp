

//StepNode.cpp
#pragma once // Guards against repeated inclusion
#include "StepNode.h"
#include <iostream>
#include <string>

StepNode::StepNode() // Default constructor. Create a new skill node
{
	fDirection = " ";
	fPosX = 0;
	fPosY = 0;

	// Current skill node is not pointing to other nodes
	fNext = NULL;
	fPrevious = NULL;
}

StepNode::StepNode(string direction, int stepnumber, int posx, int posy) // Constructor. Create a new skill node
{
	fDirection = direction;
	fPosX = posx;
	fPosY = posy;

	// Current skill node is not pointing to other nodes
	fNext = NULL;
	fPrevious = NULL;
}



// Declaring Getters

StepNode* StepNode::getPrevNode()
{
	return fPrevious;
}

StepNode* StepNode::getNextNode()
{
	return fNext;
}

string StepNode::getDirection()
{
	return fDirection; // Getter for fSkillName
}

int StepNode::getPosX() // Getter for fPosX
{
	return fPosX;
}

int StepNode::getPosY() // Getter for fPosY
{
	return fPosY;
}

int StepNode::getStepNumber() // Getter for fStepNumber
{
	return fStepNumber;
}



// Declaring Setters

void StepNode::setDirection(string direction) // Setter for fSkillName
{
	fDirection = direction;
}


// Declaring Functions

void StepNode::prependStep(StepNode& skill) // Add in a skill before current skill node
{
	skill.fNext = this; // Added skill is placed left of (before) current node
	// The right/forward pointer of new node is pointing towards current node

	if (fPrevious != NULL) // If current skill is not the first node in list
	{
		skill.fPrevious = fPrevious; // The left/backward pointer of new node is pointing to the previous node of the current node
		fPrevious->fNext = &skill; // The left/backward pointer of previous node is then made to point to new node
		// ^ Read as: previousnode's fNext made to point to new node
	}

	fPrevious = &skill; // The left/backward pointer of current node is made to point at new node
}


void StepNode::appendStep(StepNode& skill) // Add in a skill after current skill node
{
	skill.fPrevious = this; // Added skill is placed right of (after) current node
	// The left/backward pointer of new node is pointing towards current node

	if (fNext != NULL) // If current skill is not the last node in list
	{
		skill.fNext = fNext; // The right/forward pointer of new node is pointing to the next node of the current node
		fNext->fPrevious = &skill; // The  right/forward pointer of next node is then made to point to new node
		// ^ ` as: nextnode's fPrevious made to point to new node
	}

	fNext = &skill; // The right/forward pointer of current node is made to point at new node
}

void StepNode::removeStep() //Remove current skill from list of nodes
{
	if (fPrevious != NULL)
	{
		fPrevious->fNext = fNext;
		// ^ Read as: previousnode's fNext made to point to nextnode (next node of current node)
	}

	if (fNext != NULL)
	{
		fNext->fPrevious = fPrevious;
		// ^ Read as: nextnode's fPrevious made to point to previousnode (previous node of current node)
	}

	// Isolate current node
	fPrevious = NULL;
	fNext = NULL;

	delete this; //Destruct after isolating
}

// Declare Destructor
StepNode::~StepNode()
{
}


