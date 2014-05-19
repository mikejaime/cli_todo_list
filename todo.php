<?php

// Update the code to allow upper & lowercase inputs from user for all menu items. Test adding, removing, and quitting.
// Create array to hold list of todo items
$items = array();

// List array items formatted for CLI
function list_items($list) {
    $result = ''; //declare a variable so you can use wihin the function
    // Return string of list items separated by newlines.
    // Should be listed [KEY] Value like this:
    // [1] TODO item 1
    // [2] TODO item 2 - blah
    // DO NOT USE ECHO, USE RETURN

    // loop thru the list 
    //foreach or for
    foreach ($list as $key => $value) {
        $result .= "[" . ($key + 1) . "] TODO $value" . PHP_EOL; // ($key + 1), outputs the key/index as 1 higher rather than modifying the key with key++
    }
    return $result;
}

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) {
    // Return filtered STDIN input
    $result = trim(fgets(STDIN));

    return $upper ? strtoupper($result) : $result;

    if ($upper){
        return strtoupper(trim(fgets(STDIN)));
    } else {
        return (trim(fgets(STDIN)));
    }
    
}

function sort_menu($items) {
    echo '(A)-Z, (Z)-A, (O)rder Entered, (R)everse Order Entered : ';
//     $input = get_input(TRUE);
//     if ($input == 'Z') {
//             rsort($items);
//         } elseif ($input == 'O') {
//             ksort($items);
//         } elseif ($input == 'R') {
//             krsort($items);
//         } elseif ($input == 'A') {
//             sort($items);
//         } 
//     return $items;
// }

    switch(get_input(true)) {
        case 'A':
            asort($items);
            break;
        case 'Z':
            arsort($items);
            break;
        case 'O':
            ksort($items);
            break;
        case 'R':
            krsort($items);
            break;
}

// The loop!
do {
    // Echo the list produced by the function
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    // 
    $input = get_input(TRUE);

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = get_input();
    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key - 1]);
        $items = array_values($items);
    } elseif ($input == 'S') {
        $items = sort_menu($items);
    }
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);