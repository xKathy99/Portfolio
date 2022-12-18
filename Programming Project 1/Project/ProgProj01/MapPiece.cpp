//MapPiece.cpp
#pragma once // Guards against repeated inclusion
#include "MapPiece.h"
#include <iostream>
#include <string>

MapPiece::MapPiece() // Default constructor. Create a new skill node
{
	//bool LeftW, RightW, FrontW, BackW;
	fWalls.LeftW = false;
	fWalls.RightW = false;
	fWalls.FrontW = false;
	fWalls.BackW = false;

	ObjectPtr = nullptr;
	NPCPointer = nullptr;
}

MapPiece::MapPiece(Walls walls)
{
	fWalls = walls;

	ObjectPtr = nullptr;
	NPCPointer = nullptr;
}

MapPiece::MapPiece(Walls walls, Object& object)
{
	fWalls = walls;

	ObjectPtr = &object;
	NPCPointer = nullptr;
}

MapPiece::MapPiece(Walls walls, NonPlayable& npc)
{
	fWalls = walls;

	ObjectPtr = nullptr;
	NPCPointer = &npc;
}

Walls MapPiece::getWalls()
{
	return fWalls;
}

Object* MapPiece::getObject()
{
	return ObjectPtr;
}

NonPlayable* MapPiece::getNPC()
{
	return NPCPointer;
}

//Destructor
MapPiece::~MapPiece()
{
	if (NPCPointer != nullptr)
	{
		delete NPCPointer;
	}

	if (ObjectPtr != nullptr)
	{
		delete ObjectPtr;
	}
}