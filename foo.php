<?php
function calcNextRun($minute, $hour, $date, $day) {
    # Simplest first, if all * then we run every minute. Return timestamp for next whole minute
    if ($minute == '*' && $hour == '*' && $date == '*' && $day == '*')
        return mktime(date("H"), date("i"), 0) + 60; # Prettier than time() + 60, isn't that reason enough?

    # Default to current values
    $nextDate = date("d");
    $nextMonth = date("m");
    $nextYear = date("Y");
    $nextDay = date("N");
    $nextHour = date("H");
    $nextMinute = date("i");

    # Calculate month date to run on, using multiple dates in the presence of , or -
    if (strstr($date, ',') || strstr($date, '-')) {
        # Variable to determine whether the date has been set or not
        $dateSet = false;

        # Determine if there's a range in thurr
        $rangeExists = (strstr($date, '-')) ? true : false;

        # Set up the $dates array, exploding if multiple values is present
        $dates = array();
        if (strstr($date, ','))
            $dates = explode(',', $date);
        else
            $dates[] = $date;

        # If we have a range(s) present then we expand them into full stuffs
        foreach ($dates as $key => $val)
            if (strstr($val, '-'))
                $dates = array_merge($dates, expandRange($val)); # Merge the expanded range into the $dates array

        # Loop through the $dates array and remove any lingering ranges
        foreach ($dates as $key => $val)
            if (strstr($val, '-'))
                unset($dates[$key]);

        # Sort the array
        sort($dates);

        # Determine the next lowest value
        foreach ($dates as $val) {
            # If the value is higher than the maximum number of dates this month, lower it to that
            if ($val > date("t"))
                $val = date("t");

            # If $val is higher than today's date, we use that
            if ($val > date("d")) {
                $nextDate = $val;
                $dateSet = true;
                break; # We're done, we have our value
            }
        }

        # If the date has not been set, add one to the month and use the lowest value in the array
        if (!$dateSet) {
            # Increment the month. Maybe the year. Hurr hurr
            if ($nextMonth == 12) {
                $nextMonth = 1;
                $nextYear++;
            } else
                $nextMonth++;

            # Set the next day to the lowest value in the array
            $nextDate = $dates[0];
        }
    } elseif (strstr($date, '/')) # Every n days
    {
        $parts = explode('/', $date);
        $numDays = array_pop($parts);

        # Calculate the timestamp of n days from now
        $nDayTime = time() + ($numDays * 86400); # 86400 seconds in a day

        # Update values of $nextVars
        $nextDate = date("d", $nDayTime);
        $nextMonth = date("m", $nDayTime);
        $nextYear = date("Y", $nDayTime);
        $nextDay = date("N", $nDayTime);
    } elseif ($date == (int)$date) {
        if ($date < date("j")) {
            # Determine if the month pushes into the next year
            if ($nextMonth == 12) {
                $nextMonth = 1;
                $nextYear++;
            } else
                $nextMonth++;
        }

        $nextDate = $date;
    }

    # Return the new timestamp!
    return mktime($nextHour, $nextMinute, 0, $nextMonth, $nextDate, $nextYear);
}

/**
 * Takes a range and returns an array with all values belonging to that range
 *
 * @param string $range Two values split by a hyphen, ie: 1-5, 0-9, etc.
 * @return array Array of values between the two parts of the range
 */
function expandRange($range) {
    # Get the parts of the range
    $range = explode('-', $range);

    # Sort just in case the range is handed to us backwards. <_<
    sort($range);

    # Set up our return array
    $returnArray = array();

    # Populate the return array with all values between min and max
    for ($i = $range[0]; $i <= $range[1]; $i++)
        $returnArray[] = $i;

    return $returnArray;
}
