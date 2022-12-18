
//RiddleRecordList.cpp
#pragma once // Guards against repeated inclusion
#include "RiddleRecordList.h"
#include "RiddleNode.h"
#include <iostream>
#include <string>

RiddleRecordList::RiddleRecordList()
{
	tailNode = new RiddleNode("", "", "", "", 0); // Create sentinel tail node on heap
	headNode = tailNode; // also poiint at end

	riddlePtr = NULL; // Don't point at anything yet
}

// Declare functions to manage skill list

void RiddleRecordList::addRiddle(string question, string choice1, string choice2, string choice3, int correctchoice) // Add skill (learn new skill)
{
	riddlePtr = new RiddleNode(question, choice1, choice2, choice3, correctchoice);
	
	riddlePtr->prependRiddle(*headNode); 
	headNode = riddlePtr; // point at beginning of list
} 

void RiddleRecordList::removeTop()
{
	riddlePtr = headNode->getNextNode(); // Point at next node
	headNode->removeRiddle(); // Remove riddle
	headNode = riddlePtr; // Point at new head of list
}

string RiddleRecordList::showRiddleAndChoices()
{
	//and delete riddles already asked
	string qna = "";

	qna = riddlePtr->getQuestion() + '\n' + riddlePtr->getAnsChoices();
	
	return qna;
}

void RiddleRecordList::NextRiddle()
{
	//After adding riddle riddlePtr will definitely be at the head of list
	
	riddlePtr = riddlePtr->getNextNode(); // Point at head of list
	// Note that skillPtr is now pointing at our current node that we may want to delete

	cout << "next riddle!" << endl;
	if (riddlePtr == tailNode)
	{
		riddlePtr = headNode; // Go back to the head node
	}
}

// Declare getters
RiddleNode* RiddleRecordList::getRiddlePtr()
{
	return riddlePtr;
}


int RiddleRecordList::correctAns()
{
	int ansindex = riddlePtr->getCorrectAnsIndex();

	return ansindex;
}



RiddleRecordList::~RiddleRecordList()
{
	riddlePtr = headNode; // Point at head of list
	// Note that skillPtr is now pointing at our current node that we may want to delete

	while (riddlePtr != tailNode) // While not at end of the skills list
	{
		headNode = headNode->getNextNode();

		riddlePtr->removeRiddle(); //Start deleting from beginning of list
		delete riddlePtr;

		riddlePtr = headNode;
	} // Iterate process when end of list is not reached

	delete tailNode;
}