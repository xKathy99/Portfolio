
//StepRecordList.h
#pragma once
#include "StepNode.h"
#include <string>
using namespace std;


class StepRecordList
{

private:
	// Linked List of skill nodes
	StepNode* headNode; // Pointer to head of list of skills
	StepNode* tailNode; // Pointer to tail of list of skills
	StepNode* stepPtr; // Pointer to any skill in the list

public:

	StepRecordList();

	// Declare functions to manage skill list
	StepNode* findStep(int stepnumber); // Find step based on step number, return pointer

	
	void addStep(string direction, int stepnumber, int x, int y); // Add skill (learn new skill)
	void removeStep(int stepnumber); // Remove step (unlearn) by name and level

	string showLastSteps(int limit); // View character steps-> print last limit steps?


	~StepRecordList();
};