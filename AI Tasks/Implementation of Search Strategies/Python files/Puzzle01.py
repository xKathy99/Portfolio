# INTRODUCTION TO AI ASSIGNMENT 1 14/10/2021
# by Kathy Wong Hui Ying
# Student ID: 101212259
#
# PUZZLE 1 UNINFORMED AND INFORMED SEARCH

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

#SITUATION 1 MAX CAPACITY
#b1max = 10
#b2max = 6
#b3max = 5

#SITUATION 2 MAX CAPACITY
b1max = 11
b2max = 7
b3max = 4

#MAX Bottle Capacity
maxCapacity = (b1max, b2max, b3max)

startState = (10, 0, 0)
goalState = (8, 3, 0)
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
     Abstract Solver class that searches through the state space, called by the Bottle class
    """
    @abstractmethod
    def get(self):
         raise NotImplementedError()
    @abstractmethod
    def add(self):
         raise NotImplementedError()
     
class Solver1(Solver): #BREADTH FIRST SEARCH
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

class Solver3(Solver): #A* SEARCH- INFORMED
    """
     Concrete solver 3: must implement abstract methods from abstract class Solver
     Uses the Python built-in Priority Queue
    """

    def __init__(self, start,goal):
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
    def heuristic(self,state): # Heuristic= how close we are to the start and goal
        
        startToNode_b1=0;
        startToNode_b2=0;
        startToNode_b3=0;
        
        nodeToGoal_b1=0;
        nodeToGoal_b2=0;
        nodeToGoal_b3=0;
        
        costToReachCurrent=0;
        costToReachGoal=0;
        
        #Find how far the current node is from the start
        
        #How far bottle b1 is from the start
        if self.start[0] != state[0]:
            startToNode_b1 = abs(self.start[0]-state[0]) #make non-negative
        
        #How far bottle b2 is from the start
        
        if self.start[1] != state[1]:
            startToNode_b2 = abs(self.start[1]-state[1])
        
        #How far bottle b3 is from the start
        if self.start[2] != state[2]:
            startToNode_b3 = abs(self.start[2]-state[2])    
                
        #Total cost of the node from the start
        costToReachCurrent = startToNode_b1 + startToNode_b2 + startToNode_b3
                
        #Find how far the current node is from the goal
        
        #How far bottle b1 is to the goal
        if self.goal[0] != state[0]:
            nodeToGoal_b1 = abs(self.goal[0]-state[0]) #make non-negative
            
        #How far bottle b2 is to the goal
        if self.goal[1] != state[1]:
            nodeToGoal_b2 = abs(self.goal[1]-state[1])
            
        #How far bottle b3 is to the goal
        if self.goal[2] != state[2]:
            nodeToGoal_b3 = abs(self.goal[2]-state[2])    
                                
        #Total cost of the node from the goal. Further we are from goal, higher the count    
        costToReachGoal = nodeToGoal_b1 + nodeToGoal_b2 + nodeToGoal_b3
                       

        return costToReachCurrent+costToReachGoal #Return heuristic
     
#  Board Class (Model): keep track on the abstract game state data. No animation or drawing
#                       methods. 
#
class Bottle:
    """Model class for the game that stores states about the Bottles.
       This class also include all the necessary operators.
       Does not handle Animation or screen processses.
    """
    
    def __init__(self, capacity, startState, goalState):
        self.capacity = capacity
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
        print(" Max Capacity: b1=", b1max, " b2=", b2max, " b3=", b3max)
        print(" Search Strategy:", chooseSolver)
        print("------------------------------------------")
        

        while not (found):
            # we only continue if we're not at the goal
            if state_eval != self.goalState:
                temp = self.chooseAction(state_eval)
                print("\nExploring State", state_eval)
                
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
    
        b1 = state_eval[0]
        b2 = state_eval[1]
        b3 = state_eval[2]
        
        states = []
    
        #Empty the bottles
        ##################
        
        #Empty b1
        if(b1 > 0 and found == False):
            #print("Empty b1")
            state = (0, b2, b3)
            states.append(state)
        
        #Empty b2
        if(b2 > 0 and found == False):
            #print("Empty b2")
            state = (b1, 0, b3)
            states.append(state)
            
        #Empty b3
        if(b3 > 0 and found == False):
            #print("Empty b3")
            state = (b1, b2, 0)
            states.append(state)        
            
            
        #Fill the bottles
        #################
        
        #Fill b1
        if(b1 < b1max and found == False):
            #print("Fill b1")
            state = (b1max, b2, b3)
            states.append(state)
        
        #Fill b2
        if(b2 < b2max and found == False):
            #print("Fill b2")
            state = (b1, b2max, b3)
            states.append(state)
            
        #Fill b3
        if(b3 < b3max and found == False):
            #print("Fill b3")
            state = (b1, b2, b3max)
            states.append(state)    
        
        
        #Pouring water (WITH EXCESS)
        #################
        
        #Pour water from b1 into b2 (with excess kept in b1)
        if(0 < (b1 + b2) > b2max and b1 > 0 and found == False):
            #print("Pour water from b1 into b2 (with excess kept in b1)")
            state = ((b1+b2-b2max), b2max, b3)
            states.append(state)
        
        #Pour water from b1 into b3 (with excess kept in b1)
        if(0 < (b1 + b3) > b3max and b1 > 0 and found == False):
            #print("Pour water from b1 into b3 (with excess kept in b1)")
            state = ((b1+b3-b3max), b2, b3max)
            states.append(state)
            
        #Pour water from b2 into b1 bottle (with excess kept in b2)
        if(0 < (b2 + b1) > b1max and b2 > 0 and found == False):
            #print("Pour water from b2 into b1 bottle (with excess kept in b2)")
            state = (b1max, (b2+b1-b1max), b3)
            states.append(state)    
            
        #Pour water from b2 into b3 (with excess kept in b2)
        if(0 < (b2 + b3) > b3max and b2 > 0 and found == False):
            #print("Pour water from b2 into b3 (with excess kept in b2)")
            state = (b1, (b2+b3-b3max), b3max)
            states.append(state)    
            
        #Pour water from b3 into b1 (with excess kept in b3)
        if(0 < (b3 + b1) > b1max and b3 > 0 and found == False):
            #print("Pour water from b3 into b1 (with excess kept in b3)")
            state = (b1max, b2, (b3+b1-b1max))
            states.append(state)    
            
        #Pour water from b3 into b2 (with excess kept in b3)
        if(0 < (b3 + b2) > b2max and b3 > 0 and found == False):
            #print("Pour water from b3 into b2 (with excess kept in b3)")
            state = (b1, b2max, (b3+b2-b2max))
            states.append(state)    
            
            
        #Pouring water (WITHOUT EXCESS)
        #################
        
        #Pour water from b1 into b2 (no excess in b1)
        if(0 < (b1 + b2) <= b2max and b1 >= 0 and found == False):
            #print("Pour water from b1 into b2 (no excess in b1)")
            state = (0, (b1+b2), b3)
            states.append(state)
        
        #Pour water from b1 into b3 (no excess in b1)
        if(0 < (b1 + b3) <= b3max and b1 >= 0 and found == False):
            #print("Pour water from b1 into b3 (no excess in b1)")
            state = (b1, 0, (b1+b3))
            states.append(state)
            
        #Pour water from b2 into b1 (no excess in b2)
        if(0 < (b2 + b1) <= b1max and b2 >= 0 and found == False):
            #print("Pour water from b2 into b1 (no excess in b2)")
            state = ((b2+b1), 0, b3)
            states.append(state)    
            
        #Pour water from b2 into b3 (no excess in b2)
        if(0 < (b2 + b3) <= b3max and b3 >= 0 and found == False):
            #print("Pour water from b2 into b3 (no excess in b2)")
            state = (b1, 0, (b2+b3))
            states.append(state)

        #Pour water from b3 into b1 (no excess in b3)
        if(0 < (b3 + b1) <= b1max and b1 >= 0 and found == False):
            #print("Pour water from b3 into b1 (no excess in b3)")
            state = ((b3+b1), b2, 0)
            states.append(state)      

        #Pour water from b3 into b2 (no excess in b3 bottle)
        if(0 < (b3 + b2) <= b2max and b2 >= 0 and found == False):
            #print("Pour water from b3 into b2 (no excess in b3 bottle)")
            state = (b1, (b3+b2), 0)
            states.append(state)      
            
        return states

    def main():
        bot = Bottle(maxCapacity, startState, goalState)
        b = bot.solve()
        for i in b:
            print(i)
            
Bottle.main() #run program

