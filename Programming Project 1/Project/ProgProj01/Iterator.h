//Iterator.h
//Base class
#pragma once

#include <iostream>
using namespace std;


class Iterator
{
protected:

	string* fArrayElements;
	int fIndex;

public:
	Iterator();

	Iterator(string aArray[], int aIndex = 0);

	string operator*();

	Iterator& operator++(); //prefix operator

	Iterator operator++(int); //postfix operator

	Iterator& operator--(); //prefix operator

	Iterator operator--(int); //postfix operator

	bool operator==(const Iterator& aOther) const;

	bool operator!=(const Iterator& aOther) const;

	virtual Iterator begin() const;

	virtual Iterator end() const;


	virtual int getIndex(); //Added new

	virtual ~Iterator();
};