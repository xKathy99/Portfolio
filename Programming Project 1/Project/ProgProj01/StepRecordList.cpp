// StepRecordList.cpp

#pragma once // Guards against repeated inclusion
#include "StepRecordList.h"
#include "StepNode.h"
#include <iostream>
using namespace std;



StepRecordList::StepRecordList()
{

	headNode = new StepNode("SentinelStart", NULL, NULL, NULL); // Create sentinel head node on heap
	tailNode = new StepNode("SentinelEnd", NULL, NULL, NULL); // Create sentinel tail node on heap
	
	headNode->appendStep(*tailNode); // Link the head and tail sentinel nodes together

	stepPtr = headNode; // Point at head of list
}


// Declare functions to manage skill list

StepNode* StepRecordList::findStep(int stepnumber) // Find if a skill at a certain level exists
{
	int number = 0;
	bool stepfound = false;
	StepNode* temp = nullptr;

	stepPtr = headNode; // Point to head of list
	stepPtr->getNextNode(); // Point to next skill. Since we start at headNode, we want to point at the next one

	while (stepPtr != tailNode) // While not at end of the skills list
	{
		if ((stepPtr->getStepNumber() == stepnumber))
		{
			stepfound = true;
			temp = stepPtr;
		}
		stepPtr = stepPtr->getNextNode(); // Point to next skill and continue through the list
	}

	if (temp != nullptr)
	{
		stepPtr = temp;
	}

	else
	{
		stepPtr = NULL;
	}

	return stepPtr;
}



void StepRecordList::addStep(string direction, int stepnumber, int posx, int posy) // Add skill (learn new skill)
{
	stepPtr = new StepNode(direction, stepnumber, posx, posy); // Create new skill on the heap

	tailNode->prependStep(*stepPtr); // Prepend the newly added skill to the list (add in before sentinel tail node)
	stepPtr = tailNode->getPrevNode(); // Point at current (newly added) skill
}

void StepRecordList::removeStep(int stepnumber) // Remove skill (unlearn) by name and level
{
	stepPtr = headNode; // Point to head of list
	stepPtr->getNextNode(); // Point to next skill. Since we start at headNode, we want to point at the next one

	while (stepPtr != tailNode) // While not at end of the skills list
	{
		if (stepPtr->getStepNumber() == stepnumber)
		{
			stepPtr->removeStep(); // Remove the skill
			stepPtr = headNode; // Point back to headNode again
		}
		stepPtr = stepPtr->getNextNode(); // Point to next skill. Since we start at headNode, we want to point at the next one
	}
}

string StepRecordList::showLastSteps(int limit) // View character steps
{
	string outputlist = "Showing the last " + to_string(limit) + " steps:" + '\n';
	int n = 0;

	stepPtr = tailNode; // Point to beginning of skill list
	 // Point to next skill. Since we start at headNode, we want to point at the next one
	
	stepPtr = stepPtr->getPrevNode();

	for (int i = 0; i < limit; i++)
	{
		if (stepPtr == headNode)
		{
			break;
		}

		outputlist = outputlist + to_string(i+1) + ") " + stepPtr->getDirection() + '\n';
		stepPtr = stepPtr->getPrevNode();
	}

	return outputlist;
}


StepRecordList::~StepRecordList()
{
	StepNode* temp; // Create a temporary pointer
	stepPtr = headNode; // Point at head of skill list

	stepPtr = headNode; // Point to beginning of skill list
	stepPtr = stepPtr->getNextNode(); // Point to next skill. Since we start at headNode, we want to point at the next one

	// Note that skillPtr is now pointing at our current node that we may want to delete

	while (stepPtr != tailNode) // While not at end of the skills list
	{
		stepPtr = stepPtr->getNextNode(); // Point skillPtr at the next node
		temp = stepPtr->getPrevNode();  // Point temp at the 'current' node

		delete temp; // Destruct the skill node
	} // Iterate process when end of skills list is not reached

	delete headNode;
	delete tailNode;
}