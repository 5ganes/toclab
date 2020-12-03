<?php
	// This is generic program written in PHP for inplementation of any NFA. Only structure of NFA with final state should be changed while processing multiple NFAs with multiple input strings.
	// nfa that accepts strings containing 000 as substring 
	// here, value '' in array $nfa indicates no transition for an input symbol
	// NFA is processed by identifying the various paths for the input and processing recursively.
	// here, single final state is  considered.
	// if there are multiple final states, then these can be stored in an array and while checking whether current state is final state or  not, for loop can be used.

	function processNFA($currentInputSymbol, $index) {
		global $currentState; global $finalState; global $nfa; global $inputString; global $accepted;
		if($accepted == 1 || $index == strlen($inputString)){
			return;
		}
		if($nfa[$currentState][$currentInputSymbol] != ''){
			if(!is_array($nfa[$currentState][$currentInputSymbol])){
				$currentState = $nfa[$currentState][$currentInputSymbol];
				if($index < strlen($inputString)-1) processNFA($inputString[$index+1], $index+1);
			}
			else{
				if($index < strlen($inputString)-1){
					$currentState  = $nfa[$currentState][$currentInputSymbol][0];
					$currentStateBackup = $currentState;
					processNFA($inputString[$index+1], $index+1);

					if($accepted == 0){
						$currentState  = $nfa[$currentStateBackup][$currentInputSymbol][1];
						processNFA($inputString[$index+1], $index+1);
					}
				}
			}
		}
		else{
			return;
		}
		if($index == strlen($inputString)-1 && $currentState == $finalState){
			$accepted = 1;
		}
		return;
	}
	function isAccepted($inputString) {
		global $currentState; global $finalState; global $nfa; 
		processNFA($inputString[0], 0);
		if($currentState == $finalState){
			return true;
		}
		else{
			 return false;
		}
	}

	$finalState = 'q3'; $currentState = 'q0'; $accepted = 0;
	$nfa = [
		'q0' => [ 0 => ['q0', 'q1'], 1 => 'q0' ],
		'q1' => [ 0 => 'q2', 1 => '' ],
		'q2' => [ 0 => 'q3', 1 => '' ],
		'q3' => [ 0 => 'q3', 1 => 'q3' ]
	];

	$inputString = '11000110100';
 	if(isAccepted($inputString) == true) {
 		echo $inputString . ' is accepted';
 	}
 	else{
 		echo $inputString . ' is rejected';
 	}

?>