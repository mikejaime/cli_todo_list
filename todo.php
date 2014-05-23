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
    return $items;
}

// The loop!
do {
    // Echo the list produced by the function
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (O)pen file, (S)ort, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    // 
    $input = get_input(TRUE);

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $item = get_input();
        // ask the user if they want to add it to the
        // beginning or end of the list. Default to end if no input is given
        echo 'add to (B)eginning or (E)nd: ';
        $input = get_input(TRUE);
        if ($input == B){
            array_unshift($items, $item);
        } else {
            array_push($items, $item);
        }
    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key - 1]);
        $items = array_values($items);
    } elseif ($input == 'O') {
        // Ask for entry
        echo 'Enter filepath: ';
        // Add entry to list array
        $filename = get_input();
        $filesize  = filesize($filename);
        $handle = fopen($filename, "r");
        $todo_string = fread($handle, $filesize);
        fclose($handle);
        $items = explode("\n", $todo_string);
    } elseif ($input == 'S') {
        $items = sort_menu($items);
    }
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);