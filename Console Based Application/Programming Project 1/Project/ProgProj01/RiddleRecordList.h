
//RiddleNodeList.h
#pragma once
#include "RiddleNode.h"
#include <string>
using namespace std;


class RiddleRecordList
{

private:
	// Linked List of skill nodes
	RiddleNode* headNode; // Pointer to head of list of skills
	RiddleNode* tailNode; // Pointer to tail of list of skills
	RiddleNode* riddlePtr; // Pointer to any skill in the list

public:

	RiddleRecordList();

	// Declare functions to manage skill list

	void addRiddle(string question, string choice1, string choice2, string choice3, int correctchoice); // Add skill (learn new skill)
	void removeTop(); // Remove step (unlearn) by name and level

	string showRiddleAndChoices();
	int correctAns();

	void NextRiddle();

	// Declare Getters
	RiddleNode* getRiddlePtr();

	~RiddleRecordList();
}; 
