# INTRODUCTION TO AI ASSIGNMENT 1 14/10/2021
# by Kathy Wong Hui Ying
# Student ID: 101212259
#
# PUZZLE 2 UNINFORMED AND INFORMED SEARCH

from copy import deepcopy
import pygame, sys, random
from abc import ABCMeta, abstractmethod
from pygame.locals import *
import queue as Q
import pdb  #python debugger

#################
# Globals     ###

found = False

#chooseSolver = "BREADTH FIRST SEARCH" #BREADTH FIRST SEARCH
#chooseSolver = "DEPTH FIRST SEARCH" #DEPTH FIRST SEARCH
chooseSolver = "A* SEARCH" #A* SEARCH

left = 'L'
right = 'R'

#Use Dictionary
startState = (left, left, left, left)
goalState = (right, right, right, right)

#################

#
# Basic data structure Stack
# Like containers/jars to arrange numbers
#
class Stack:
     def __init__(self):
         self.items = []
     def isEmpty(self):
         return self.items == []
     def push(self, item):
         self.items.append(item)
     def pop(self):
         return self.items.pop()
     def peek(self):
         return self.items[len(self.items)-1]
     def size(self):
         return len(self.items)
#
# Basic data structure Queue
# (Use my own Queue instead of import)
#
class Queue:
    def __init__(self):
        self.items = []
    def isEmpty(self):
        return self.items == []
    def add(self, item):
        self.items.insert(0, item)
    def get(self):
        return self.items.pop()
    def size(self):
        return len(self.items)


#
# Solver Class: propose moves to the Board Class
#
#
class Solver(metaclass=ABCMeta):
    """
     ABC=Abstract base class
     Abstract Solver class that searches through the state space, called by the Board class
    """
    @abstractmethod
    def get(self):
         raise NotImplementedError()
    @abstractmethod
    def add(self):
         raise NotImplementedError()

class Solver1(Solver): #BREADTH FIRST SEARCH- UNINFORMED
    """
     Concrete solver: must implement abstract methods from abstract class Solver
     uses a Queue
    """
    def __init__(self):
        self.queue=Queue() #queue is horizontal
    def get(self):
        return self.queue.get() #gets object from the FRONT of the queue
    def add(self,state):
        self.queue.add(state)
    def size(self):
        return self.queue.size()

class Solver2(Solver): #DEPTH FIRST SEARCH- UNINFORMED
    """
     Concrete solver: must implement abstract methods from abstract class Solver
     Uses a Stack
    """
    def __init__(self):
        self.stack=Stack() #stack is vertical
    def get(self):
        return self.stack.pop()
    def add(self,state):
        self.stack.push(state)

class Solver3(Solver): #A* SEARCH- INFORMEDS
# Yes, the priority queue requires that pushed objects are comparable. dict is not.
    """
     Concrete solver 3: must implement abstract methods from abstract class Solver
     Uses the Python built-in Priority Queue
    """

    def __init__(self,start,goal):
        self.pq=Q.PriorityQueue()
        self.start=start
        self.goal=goal

    def get(self):
        if not self.pq.empty():
             (val,state)=self.pq.get()
             return state
        else:
             return None
             
    def add(self, state):
        value=self.heuristic(state)
        self.pq.put((value,state))
    def heuristic(self,state): # Heuristic= how close we are to the goal
   
        startToNode_man=0;
        startToNode_wolf=0;
        startToNode_goat=0;
        startToNode_cab=0;

        nodeToGoal_man=0;
        nodeToGoal_wolf=0;
        nodeToGoal_goat=0;
        nodeToGoal_cab=0;
        
        costToReachCurrent=0;
        costToReachGoal=0;
        
                #Find how far the current node is from the start
        if self.start[0] != state[0]:
            startToNode_man += 1 
                    
        if self.start[1] != state[1]:
            startToNode_wolf += 1 
                    
        if self.start[2] != state[2]:
            startToNode_goat += 1  
            
        if self.start[2] != state[3]:
            startToNode_cab += 1     
            
        costToReachCurrent = startToNode_man + startToNode_wolf + startToNode_goat + startToNode_cab
                
                #Find how far the current node is from the goal
        if self.goal[0] != state[0]:
            nodeToGoal_man += 1 
                    
        if self.goal[1] != state[1]:
            nodeToGoal_wolf += 1
                    
        if self.goal[2] != state[2]:
            nodeToGoal_goat += 1

        if self.goal[3] != state[3]:
            nodeToGoal_cab += 1   
                                
                # Further we are from goal, higher the count    
        costToReachGoal = nodeToGoal_man + nodeToGoal_wolf + nodeToGoal_goat + nodeToGoal_cab
                       

        return costToReachCurrent+costToReachGoal

#  Board Class (Model): keep track on the abstract game state data. No animation or drawing
#                       methods.
#
class ManWolfGoatCab:
    """Model class for the game that stores states about the Bottles.
       This class also include all the necessary operators.
       Does not handle Animation or screen processses.
    """

    def __init__(self, startState, goalState):
        self.startState = startState
        self.goalState = goalState


        #### CHANGE THE SOLVER METHOD HERE ## #Comment or uncomment to choose which solver to use
        if (chooseSolver=="BREADTH FIRST SEARCH"):
            self.Solver=Solver1() #BREADTH FIRST SEARCH
            
        if (chooseSolver=="DEPTH FIRST SEARCH"):
            self.Solver=Solver2() #DEPTH FIRST SEARCH 
            
        if (chooseSolver=="A* SEARCH"):
            self.Solver=Solver3(self.startState,goalState) # A* SEARCH
        #####################################

    def solve(self):
        global found
        self.visited = [] #visited node
        self.Solver.add(self.startState) #add the state to the solver
        state_eval = self.Solver.get()  #visit/solve this state
        #state_eval is the state we generate new state from
        #we pop a state out from self.items (this state is our state_eval)
        #and it is put into our algorithm to generate new states
        cost = 0

        print("------------------------------------------")
        print("\n Start State:", startState, "\n Goal State:", self.goalState)
        print(" Search Strategy:", chooseSolver)
        print("------------------------------------------")


        while not (found):
            # we only continue if we're not at the goal
            if state_eval != self.goalState:
                temp = self.chooseAction(state_eval)
                print("\nExploring State (Man, Wolf, Goat, Cabbage):", state_eval)

                #add into self.visited if never visited
                if(state_eval not in self.visited):
                    self.visited.append(state_eval)


                for i in temp:
                    if not (i in self.visited):
                        self.Solver.add(i)

                        # add to visited
                        self.visited.append(i)
                        yield i
                        if (i == self.goalState):
                            print("\nReach Goal State:", i)

                            found = True
                            break
                state_eval = self.Solver.get() #get a new state to visit
            else:
                print("Found goal state.")
                found = True

        yield "Task Completed"

 # Operators
    def chooseAction(self, state_eval):
    #state_eval is the state we generate new state from
    #we pop a state out from self.items (this state is our state_eval)
    #and it is put into our algorithm to generate new states
    
    # include your conditions here
    #
        manpos = state_eval[0]
        wolfpos = state_eval[1]
        goatpos = state_eval[2]
        cabpos = state_eval[3]

        states = []

        #States
        ##################

        #Only man goes left
        if((manpos == right) and (found == False)):
            #print("Only man goes left")
            state = (left, wolfpos, goatpos, cabpos)
            
            if((manpos != wolfpos) and (manpos == cabpos) and (wolfpos == goatpos)): #wolf cannot be alone with goat
                pass #Just do nothing don't add state
            elif((manpos != goatpos) and (manpos == wolfpos) and (goatpos == cabpos)): #goat cannot be alone with cabbage
                pass #Do nothing. Don't consider this stare/don't let it be explored
            else:
               states.append(state)


        #Only man goes right
        if((manpos == left) and (found == False)):
            #print("Only man goes right")
            state = (right, wolfpos, goatpos, cabpos)
            
            if((manpos != wolfpos) and (manpos == cabpos) and (wolfpos == goatpos)): #wolf cannot be alone with goat
                pass #Just do nothing don't add state
            elif((manpos != goatpos) and (manpos == wolfpos) and (goatpos == cabpos)): #goat cannot be alone with cabbage
                pass #Do nothing. Don't consider this stare/don't let it be explored
            else:
               states.append(state)


        #Man and wolf goes to left
        if((manpos == right) and (wolfpos == right) and (found == False)):
            #print("Man and wolf goes to left")
            state = (left, left, goatpos, cabpos)
            
            if (goatpos == cabpos): #goat cannot be alone with cabbage
                pass #Do nothing. Don't consider this stare/don't let it be explored
            else:
                states.append(state)


        #Man and wolf goes to right
        if((manpos == left) and (wolfpos == left) and (found == False)):
            #print("Man and wolf goes to right")
            state = (right, right, goatpos, cabpos)
            
            if (goatpos == cabpos): #goat cannot be alone with cabbage
                pass #Do nothing. Don't consider this stare/don't let it be explored
            else:
                states.append(state)


        #Man and goat goes to left
        if((manpos == right) and (goatpos == right) and (found == False)):
            #print("Man and goat goes to left")
            state = (left, wolfpos, left, cabpos)
            states.append(state)

        #Man and goat goes to right
        if((manpos == left) and (goatpos == left) and (found == False)):
            #print("Man and goat goes to right")
            state = (right, wolfpos, right, cabpos)
            states.append(state)


        #Man and cabbage goes to left
        if((manpos == right) and (cabpos == right) and (found == False)):
            #print("Man and cabbage goes to left")
            state = (left, wolfpos, goatpos, left)

            if(wolfpos == goatpos): #wolf cannot be alone with goat
                pass #Do nothing. Don't consider this stare/don't let it be explored
            else:
                states.append(state)


        #Man and cabbage goes to right
        if((manpos == left) and (cabpos == left) and (found == False)):
            #print("Man and cabbage goes to right")
            state = (right, wolfpos, goatpos, right)

            if(wolfpos == goatpos): #wolf cannot be alone with goat
                pass #Do nothing. Don't consider this stare/don't let it be explored
            else:
                states.append(state)


        return states

    def main():
        game = ManWolfGoatCab(startState, goalState)
        b = game.solve()
        for i in b:
            print(i)

ManWolfGoatCab.main() #run program

