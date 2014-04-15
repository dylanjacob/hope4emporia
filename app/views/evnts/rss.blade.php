<?php
echo '<?xml version="1.0" encoding="UTF-8" ?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">

<channel>
  <title>Hope Community Church | Events</title>
  <link>'. url('/events',null,false) . '</link>
  <description>Test</description>
  <atom:link href="'. url('/events/rss',null,false) . '" rel="self" type="application/rss+xml" />
  ';
  foreach($events as $event) {
  	echo '
  <item>
    <title>' . $event->title . '</title>
    <link>' . url('/events'.$event->id, null, false) . '</link>
    <description>' . $event->location . ' | ' . date('m-d-Y g:i A', strtotime($event->starttime)) .'</description>
    <guid>' . url('/events'.$event->id, null, false) . '</guid>
  </item>';
}
  echo '
</channel>

</rss>';

?>