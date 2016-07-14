<?php
	
	// CONTENTdm Browse Subjects
	
	$baseURL = 'xxxxxxxxxx'; // CONTENTdm base URL (format: 'http://CdmServer.com')
	$port = 'xxxxxxxxxx'; // CONTENTdm port (format: ':port')
	
	// Return Collection List (JSON)
	$collectionString = file_get_contents($baseURL.$port."/dmwebservices/index.php?q=dmGetCollectionList/json");
	$collectionList = json_decode($collectionString, true);

	$objectArray = array();
	
	// Return Collection Alias Terms
	foreach ($collectionList as $colLists => $colList) {
		
		$objectString = file_get_contents($baseURL.$port.'/dmwebservices/index.php?q=dmGetCollectionFieldVocabulary'.$colList['alias'].'/subjec/0/0/json');
		
		$objectList = json_decode($objectString, true);
		
		foreach ($objectList as $key => $value) {
			
			array_push($objectArray, $value);
			
		}
		
	}
	
	$objectUnique = array_unique($objectArray);
	natcasesort($objectUnique);
	
	// Return Object Links
	echo '<ul id="subject_browse">';
	
	foreach ($objectUnique as $key => $value) {
		
		echo '<li><a href="'.$baseURL.'/cdm/search/searchterm/'.$value.'/field/subjec!all/mode/exact!none/conn/and!and/order/nosort/">'.$value.'</a></li>';
		
	}
	
	echo '</ul>';
	
?>

