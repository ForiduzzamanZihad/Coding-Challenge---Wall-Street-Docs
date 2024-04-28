<?php
/**
 * Function to calculate the total time required for a queue of persons to fill up their water bottles.
 * 
 * @param array $queue An array of integers representing the queue of people in line, with the integers representing the size of their bottle in millilitres.
 * @param array $tapFlows An array of integers representing the available taps, with the integer representing the filling rate in millilitres per second.
 * @param int $walkingTime An integer representing the time it would take for each person in the queue to walk to the tap and fill their bottle.
 * 
 * @return float The total time required.
 */
function calculateTime($queue, $tapFlows, $walkingTime) {
    // Initialize array to track time spent at each tap
    $tapTimes = array_fill(0, count($tapFlows), 0);

    // Loop through each bottle in the queue
    foreach ($queue as $i => $bottleSize) {
        // Find the index of the tap with the minimum time spent
        $minIndex = array_search(min($tapTimes), $tapTimes);
        // Get the flow rate of the tap
        $flowRate = $tapFlows[$minIndex];
        // Calculate time to fill the bottle
        $timeSpentFillingBottle = $bottleSize / $flowRate;
        
        // Add time for walking to the tap and filling the bottle
        $tapTimes[$minIndex] += $walkingTime + $timeSpentFillingBottle;
    }

    // Return the maximum time spent at any tap
    return max($tapTimes);
}

// Example input values
$queueExample = [400, 750, 1000];
$flowRatesExample = [50, 200];
$walkingTimeExample = 5;

// Output the result
echo calculateTime($queueExample, $flowRatesExample, $walkingTimeExample);
?>
