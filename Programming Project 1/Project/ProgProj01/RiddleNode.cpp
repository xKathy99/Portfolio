

//RiddleNode.cpp
#pragma once // Guards against repeated inclusion
#include "RiddleNode.h"
#include <iostream>
#include <string>

RiddleNode::RiddleNode() // Default constructor. Create a new skill node
{
	fQuestion = "";
	fAnsChoices[0] = "";
	fAnsChoices[1] = "";
	fAnsChoices[2] = "";

	fCorrectAnsIndex = 0;

	// Current skill node is not pointing to other nodes
	fNext = NULL;
}

RiddleNode::RiddleNode(string question, string choice1, string choice2, string choice3, int correctindex) // Constructor. Create a new skill node
{
	fQuestion = question;
	fAnsChoices[0] = choice1;
	fAnsChoices[1] = choice2;
	fAnsChoices[2] = choice3;

	// Keyed in integer -1 for index
	fCorrectAnsIndex = correctindex;	

	// Current skill node is not pointing to other nodes
	fNext = NULL;
}


// Declaring Getters

RiddleNode* RiddleNode::getNextNode()
{
	return fNext;
}


string RiddleNode::getQuestion() // Getter for fQuestion
{
	return fQuestion;
} 

string RiddleNode::getAnsChoices() // Getter for fAnsChoices
{
	string choices = "";

	for (int i = 0; i < 3; i++)
	{
		choices = choices + to_string(i + 1) + ") " + fAnsChoices[i] + '\n';
	}
	return choices;
} 


int RiddleNode::getCorrectAnsIndex()
{
	return fCorrectAnsIndex;
}




// Declaring Setters
void RiddleNode::setQuestion(string ques) // Setter for fQuestion
{
	fQuestion = ques;
}

void RiddleNode::setAnsChoices(int ansindex, string ans) // Getter for fAnsChoices
{
	fAnsChoices[ansindex] = ans;
}


// Declaring functions
void RiddleNode::prependRiddle(RiddleNode& riddle) // Add new node at the beginning of list
{
	this->fNext = &riddle; // Prepend node before riddle
}


void RiddleNode::removeRiddle() // Remove current node from links, only works at the top
{
	this->fNext = NULL;
}



// Declare Destructor
RiddleNode::~RiddleNode()
{
}

