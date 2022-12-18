//Iterator.cpp
#include <iostream>
#include "Iterator.h"

using namespace std;

Iterator::Iterator()
{
	fArrayElements = NULL;
	fIndex = 0;
}

Iterator::Iterator(string aArray[], int aIndex)
{
	fArrayElements = aArray;
	fIndex = aIndex;
}

string Iterator::operator*()
{
	return fArrayElements[fIndex];
}

Iterator& Iterator::operator++()
{
	//prefix operator
	fIndex++;
	return *this;
}

Iterator Iterator::operator++(int)
{
	//postfix operator
	Iterator temp = *this;
	fIndex++;
	return temp;
}

Iterator& Iterator::operator--()
{
	//prefix operator
	fIndex--;
	return *this;
}

Iterator Iterator::operator--(int)
{
	//postfix operator
	Iterator temp = *this;
	fIndex--;
	return temp;
}

bool Iterator::operator==(const Iterator& aOther) const
{
	return (fIndex == aOther.fIndex); //Return true or false
}

bool Iterator::operator!=(const Iterator& aOther) const
{
	return (fIndex != aOther.fIndex); //Return true or false
}

Iterator Iterator::begin() const
{
	return Iterator();
}

Iterator Iterator::end() const
{
	return Iterator();
}


int Iterator::getIndex()
{
	return fIndex;
}


//Destructor
Iterator::~Iterator()
{
}
