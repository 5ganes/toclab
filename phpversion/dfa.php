<?php
    // This is generic program written in PHP for inplementation of any DFA. Only structure of DFA with final state should be changed while processing multiple DFAs with multiple input strings.
    // DFA that accepts strings containing 01 as substring
    // here, single final state is  considered.
    // if there are multiple final states, then these can be stored in an array and while checking whether current state is final state or  not, for loop can be used.

    function processDFA($currentInputSymbol){
        global $dfa; global $currentState;
        $currentState = $dfa[$currentState][$currentInputSymbol];
    }
    function isAccepted($str) {   
        global $currentState; global $finalState;  
        for($i = 0; $i < strlen($str); $i++) {  
            processDFA($str[$i]);
        }
        if($currentState == $finalState) 
            return 1;  
        else 
            return 0;  
    } 
    $dfa = [                             // DFA that accepts strings containing 01 as substring
        'q0' => [
            '0' => 'q1', '1' => 'q0'
        ],
        'q1' => [
            '0' => 'q1', '1' => 'q2'
        ],
        'q2' => [
            '0' => 'q2', '1' => 'q2'
        ]
    ];
    $finalState = 'q2';
    $currentState = 'q0';
    $str = '11110111';
    if(isAccepted($str) == 1) echo $str . " is accepted";  
    else echo $str . " is rejected";