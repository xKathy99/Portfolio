//RiddleNode.h
#pragma once // Guards against repeated inclusion
#include <iostream>
#include <string>

using namespace std;

class RiddleNode // Doubly-Linked Node to represent Steps taken
{

private:
	string fQuestion; // Records the direction taken
	string fAnsChoices[3];

	int fCorrectAnsIndex; 

	RiddleNode* fNext; // Pointer to the next node

public:

	RiddleNode(); // Default constructor
	RiddleNode(string question, string choice1, string choice2, string choice3, int correctindex); // Constructor, where direction can be: LEFT, RIGHT, UP, DOWN

	// Declaring Getters
	RiddleNode* getNextNode(); // Get pointer to the next node

	string getQuestion();  // Getter for fQuestion
	string getAnsChoices(); // Getter for fAnsChoices
	int getCorrectAnsIndex();

	// Declaring Setters
	void setQuestion(string ques);  // Setter for fQuestion
	void setAnsChoices(int ansindex, string ans); // Getter for fAnsChoices

	// Declaring functions
	void prependRiddle(RiddleNode& riddle);
	void removeRiddle(); // Remove current node from links



	//Destructor
	virtual ~RiddleNode();
};
