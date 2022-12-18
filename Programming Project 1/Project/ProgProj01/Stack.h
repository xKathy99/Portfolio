
// StepStack.h
#pragma once
#include <iostream>
#include <string>

using namespace std;

template<class T>

class Stack
{
private:
	T* fElements; // Pointer to the variable stored
	int fStackPointer;
	int fStackSize;

public:
	Stack(int aSize)
	{
		if (aSize <= 0)
		{
			throw std::invalid_argument("Illegal stack size.");
		}
		else
		{
			fElements new T[aSize];
			fStackPointer = 0; 
			fStackSize = aSize;
		}
	}

	bool isEmpty() const
	{
		return fStackPointer == 0;
	}

	int size() const
	{
		return fStackPointer;
	}


	void push(const t& aItem)
	{
		if (fStackPointer < fStackSize)
		{
			fElements[fStackPointer++] = aItem;
		}
		else
		{
			throw std::overflow_error("Stack full.");
		}
	}

	void pop()
	{
		if (!isEmpty())
		{
			fStackPointer--;
		}
		else
		{
			throw std::underflow_error("Stack empty.");
		}
	}

	const T& top() const
	{
		if (!isEmpty())
		{
			return fElements[fStackPointer - 1];
		}
		else
		{
			throw std::underflow_error("Stack empty.");
		}
	}

	// Declare destructor
	~Stack()
	{
		delete[] fElements;
		// release the memory associated with all elements and the array itself
	}
}; 
