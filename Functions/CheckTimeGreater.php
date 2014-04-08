<?php
function CheckTimeGreater($starthour, $startmin, $startsec, $endhour, $endmin, $endsec) {
    if ($starthour > $endhour)
        return 1;
    if ($starthour < $endhour)
        return 2;
    if ($startmin > $endmin)
        return 1;
    if ($startmin < $endmin)
        return 2;
    if ($startsec > $endsec)
        return 1;
    if ($startsec < $endsec)
        return 2;
}