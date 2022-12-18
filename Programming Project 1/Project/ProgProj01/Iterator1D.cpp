//Iterator1D.cpp
#include <iostream>
#include "Iterator1D.h"

using namespace std;

Iterator1D::Iterator1D()
{
	fArrayElements = NULL;
	fIndex = 0;
	fEndIndex = 0;
}


Iterator1D::Iterator1D(string aArray[], int aArrSize, int aIndex) : Iterator(aArray, aIndex)//, fArrayElements(aArray)
{
	fArrayElements = aArray;
	fEndIndex = aArrSize - 1; //Show end of Array
}

Iterator Iterator1D::begin() const
{
	int lArrSize = fEndIndex + 1;
	return Iterator1D(fArrayElements, lArrSize);

}

Iterator Iterator1D::end() const
{
	int lArrSize = fEndIndex + 1;
	return Iterator1D(fArrayElements, lArrSize, fEndIndex);

}

//Destructor
Iterator1D::~Iterator1D()
{
}