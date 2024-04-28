<?php

// Define a function that we'll need to use later
// This function works exactly the same way as the "min" function, except it returns the INDEX of the value which is minimum, not the VALUE of the value which is minimum
function min_index($array) {
    $min_index = null;
    $minValue = null;
    foreach ($array as $i => $value) {
        if ($minValue === null || $value < $minValue) {
            $min_index = $i;
            $minValue = $value;
        }
    }
    return $min_index;
}

// Define our actual important function
function calculateTime($q, $tapFlows, $walkingTime) {
    // Defaulting the values in case omitted
    if ($q === null) {
        $q = [400, 750, 1000];
    }

    if ($tapFlows === null) {
        $tapFlows = [100, 100];
    }

    if ($walkingTime === null) {
        $walkingTime = 0;
    }

    // $tapTimes is the total time people have spent at each tap as we move down the queue.
    // Before the loop, this is initialised as [0, 0, 0, ....., 0] with one zero for each tap
    $tapTimes = array_fill(0, count($tapFlows), 0);

    // Loop through each bottle in the queue
    foreach ($q as $i => $bottle_size) {

        // We then find which queue is the "emptiest", i.e., what is the minimum item in the array
        // We use this function instead of min($tapTimes) because we want to find the INDEX of the minimum, not just the VALUE
        $minI = min_index($tapTimes);

        // Set $flow to $tapFlows[$minI]
        $flow = $tapFlows[$minI];

        // bottle size divided by flow
        $timeSpentFillingBottle = $bottle_size / $flow;

        // We add the amount of time to $tapTimes that the person is "using" the tap, to signify that this tap is busy until that point in time.
        // There are two parts to this:

        // PART 1: Adding on the time to walk to the tap
        $tapTimes[$minI] += $walkingTime;

        // PART 2: Adding on the actual time the tap is being used to fill up the bottle
        $tapTimes[$minI] += $timeSpentFillingBottle;
    }

    // By the time we get here, we know the amount of time each tap has spent being used, so we just have to find the max value
    return max($tapTimes);
}

$queueExample = array(400, 750, 1000);
$walkTimeExample = 5;
$flowRatesExample = [50, 200];

echo '-----';
echo "\n";
echo calculateTime($queueExample, $flowRatesExample, $walkTimeExample);
echo "\n";
echo '-----';

/*
I've made the following changes to the code:
Fixed the typo in the function name from min_idnex to min_index.
Corrected the variable name typo $walkingTmie to $walkingTime.
Adjusted the condition checks in the calculateTime function to correctly handle null inputs.
Removed the unnecessary variable assignment inside the loop for default values of $q and $tapFlows.
Removed the extra character  after the $minValue variable initialization.
Fixed the variable name typo $flowRatesXample to $flowRatesExample in the example usage.
Used the correct variable $walkTimeExample in the example usage instead of the typo $walkingTmie.
Ensured the correct order of parameters in the calculateTime function call: $queueExample, $flowRatesExample, and $walkTimeExample.*/

?>