// This is generic program written in PHP for inplementation of any NFA. Only structure of NFA with 
// final state should be changed while processing multiple NFAs with multiple input strings.
// nfa that accepts strings containing 000 as substring
// here -1 in index 0 = no transition
// and -1 in index 1 = to say no multiple transitions for symbol[for array synchronization] 
// NFA is processed by identifying the various paths for the input and processing recursively.
// here, single final state is  considered.
// if there are multiple final states, then these can be stored in an array and while checking whether 
// current state is final state or  not, for loop can be used.
#include <iostream>
using namespace std;
bool isAccepted();
void processNFA(int, int);

int accepted = 0;
int currentState = 0;
int currentStateBackup = 0;
int finalState = 3;
int nfa[4][2][2] = {
	{ 
		{0, 1}, {0, -1}   
	},
	{ 
		{2, -1}, {-1, -1} 
	},
	{ 
		{3, -1}, {-1, -1} 
	},
	{ 
		{3, -1}, {3, -1} 
	}
};

string inputString = "11001000";
int inputStringLength = inputString.length();

void processNFA(int currentInputSymbol, int index){
	currentInputSymbol = (int)currentInputSymbol - 48; // converting char number into integer 
	if(accepted == 1 || index == inputStringLength){
		return;
	}
	if(nfa[currentState][currentInputSymbol][0] != -1){
		if(nfa[currentState][currentInputSymbol][1] == -1){
			currentState = nfa[currentState][currentInputSymbol][0];
			if(index < inputStringLength-1)
				processNFA(inputString[index+1], index+1);
		}
		else{
			if(index < inputStringLength-1){
				currentState  = nfa[currentState][currentInputSymbol][0];
				currentStateBackup = currentState;
				processNFA(inputString[index+1], index+1);

				if(accepted == 0){
					currentState  = nfa[currentStateBackup][currentInputSymbol][1];
					processNFA(inputString[index+1], index+1);
				}
			}
		}
	}
	else{
		return;
	}
	if(index == inputStringLength-1 && currentState == finalState){
		accepted = 1;
	}
	return;
}

bool isAccepted(){
	processNFA(inputString[0], 0);
	if(currentState == finalState){
		return true;
	}
	else{
		 return false;
	}
}

int main(){
	if(isAccepted() == true) {
 		cout << inputString << " is Accepted";
 	}
 	else{
 		cout << inputString << " is Rejected";
 	}
	
}
