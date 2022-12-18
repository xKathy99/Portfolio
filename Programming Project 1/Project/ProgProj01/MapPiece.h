
//MapPiece.h
#pragma once // Guards against repeated inclusion
#include <iostream>
#include <string>
#include "Entity.h"
#include "Object.h"
#include "Playable.h"
#include "NonPlayable.h"
using namespace std;


struct Walls
{
	bool LeftW, RightW, FrontW, BackW;
};

class MapPiece
{
private:

protected:
	Walls fWalls;
	Object* ObjectPtr;
	NonPlayable* NPCPointer;

public:
	MapPiece();

	MapPiece(Walls walls);
	MapPiece(Walls walls, Object& object);
	MapPiece(Walls walls, NonPlayable& npc);


	// Declare Getters
	Walls getWalls(); // Getter for fWalls
	Object* getObject();
	NonPlayable* getNPC();

	~MapPiece();

};