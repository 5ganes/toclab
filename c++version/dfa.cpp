// This is generic program written in C++ for inplementation of any DFA. 
// Only structure of DFA with final state should be changed while processing 
// multiple DFAs with multiple input strings.
// DFA that accepts strings containing 01 as substring
// here, single final state is  considered.
// if there are multiple final states, then these can be stored in an array and while 
// checking whether current state is final state or  not, for loop can be used.
#include <iostream>
using namespace std;
bool isAccepted();

int currentState = 0;
int finalState = 2;
int dfa[3][2] = {
	{ 1, 0 },
	{ 1, 2 },
	{ 2, 2 }
};
string inputString = "11000";
int inputStringLength = inputString.length();

bool isAccepted(){
	for (int i=0; i < inputStringLength; i++) { 
		int s = (int)inputString[i] - 48; // converting char number into integer 
		currentState = dfa[currentState][s];
	}
	if(currentState == finalState){
		return true;
	}
	return false;
}

int main(){
	if(isAccepted() == true) {
 		cout << inputString << " is Accepted";
 	}
 	else{
 		cout << inputString << " is Rejected";
 	}
	
}
