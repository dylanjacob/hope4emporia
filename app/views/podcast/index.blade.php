<?php 
echo '<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:itunesu="http://www.itunesu.com/feed" version="2.0">
 
  <channel>

    <title>Hope Community Church | Sermons</title>
    <description>Sermons from Hope Community Church</description>
    <link>' . url('/', null, false) . '</link>
    <language>en-us</language>
    <copyright>Copyright ' . date('Y') . '</copyright>
    <lastBuildDate>' . date('D, j M Y H:i:s O') . '</lastBuildDate>
    <pubDate>' . date('D, j M Y H:i:s O') . '</pubDate>
    <webMaster>hcc401@hope4emporia.org (HCC401)</webMaster>

    <itunes:author>Pastor Tony Garcia</itunes:author>
    <itunes:subtitle>Sermons from Hope Community Church</itunes:subtitle>
    <itunes:summary>Sermons from Hope Community Church</itunes:summary>

    <itunes:owner>
           <itunes:name>HCC 401</itunes:name>
           <itunes:email>hcc401@hope4emporia.org</itunes:email>
    </itunes:owner>

	<itunes:explicit>No</itunes:explicit>

	<itunes:image href="' . url('/img/logo/shade-header.png', null, false) . '"/>
	<image>
		<url>' . url('/img/logo/shade-header.png', null, false) . '</url>
		<title>Hope Community Church | Sermons</title>
		<link>' . url('/', null, false) . '</link>
	</image>
	   
	<itunes:category text="Religion &amp; Spirituality">
	     <itunes:category text="Christianity"/>
	</itunes:category>

';
foreach($sermons as $sermon) {
echo '	<item>
		<title>' . $sermon->name .'</title>
		<link>' . $sermon->detail_url . '</link>
		<guid>' . $sermon->audio_url . '</guid>
		<description>' . $sermon->description . '</description>
		<enclosure url="'. $sermon->audio_url .'" length="11779397" type="audio/mpeg"/>
		<category>Podcasts</category>
		<pubDate>' . date('D, j M Y H:i:s O', strtotime($sermon->pubdate)) . '</pubDate>

		<itunes:author>' . $sermon->author . '</itunes:author>

		<itunes:explicit>No</itunes:explicit>
		<itunes:subtitle>' . $sermon->subtitle . '</itunes:subtitle>
		<itunes:summary>' . $sermon->summary . '</itunes:summary>
		<itunes:duration>' . $sermon->duration . '</itunes:duration>
		<itunes:keywords></itunes:keywords>

		</item>';
}
echo '
	
  </channel>

</rss>'; ?>