//Iterator1D.h
#pragma once

#include <iostream>
#include "Iterator.h"

using namespace std;

class Iterator1D :
	public Iterator
{

private:
	int fEndIndex;

public:
	Iterator1D();

	Iterator1D(string aArray[], int aArrSize, int aIndex = 0); //apparently default parameter should be at end of parameter list

	Iterator begin() const;

	Iterator end() const;

	~Iterator1D();
};