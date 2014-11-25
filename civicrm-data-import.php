<?php

$require_base_dir = '/var/www/civicrm/profiles/civicrm_starterkit/modules/civicrm/';

require_once $require_base_dir . 'civicrm.config.php';
 
require_once $require_base_dir . 'CRM/Core/Config.php';
require_once $require_base_dir . 'CRM/Core/Error.php';
$config = CRM_Core_Config::singleton( );
 
civicrm_initialize(TRUE);
global $civicrm_root;

// see https://github.com/civicrm/civicrm-core/blob/master/api/v3/examples/Contact/Create.php

/*



*/

$field_map_from_import = array(
	'August 2006 Special Ballot Requested' => 'custom_16',
	'August 2011 Special Ballot Requested' => 'custom_29',
	'City' => 'city',
	'City or Village Code' => 'do_not_import',
	'Current Party Affiliation' => 'custom_35',
	'Date Registered' => 'custom_50',
	'February 2005 Special Ballot Requested' => 'custom_13',
	'February 2006 Special Ballot Requested' => 'custom_17',
	'February 2007 Special Ballot Requested' => 'custom_20',
	'Federal Congressional District' => 'custom_37',
	'Fire' => 'custom_36',
	'First Name' => 'first_name',
	'Last Name' => 'last_name',
	'March 2000 Primary Ballot Requested' => 'custom_2',
	'March 2004 Primary Ballot Requested' => 'custom_10',
	'March 2008 Primary Ballot Requested' => 'custom_22',
	'March 2012 Primary Ballot Requested' => 'custom_31',
	'May 2001 Special Ballot Requested' => 'custom_4',
	'May 2002 Primary Ballot Requested' => 'custom_6',
	'May 2003 Special Ballot Requested' => 'custom_8',
	'May 2005 Primary Ballot Requested' => 'custom_12',
	'May 2006 Primary Ballot Requested' => 'custom_15',
	'May 2007 Primary Ballot Requested' => 'custom_19',
	'May 2009 Primary Ballot Requested' => 'custom_24',
	'May 2010 Primary Ballot Requested' => 'custom_26',
	'May 2011 Primary Ballot Requested' => 'custom_28',
	'May 2013 Primary Ballot Requested' => 'custom_33',
	'May 2014 Primary Ballot Requested' => 'custom_34',
	'Middle Initial' => 'middle_name',
	'Name Suffix' => 'suffix_id',
	'November 2000 General Ballot Requested' => 'custom_1',
	'November 2001 General Ballot Requested' => 'custom_3',
	'November 2002 General Ballot Requested' => 'custom_5',
	'November 2003 General Ballot Requested' => 'custom_7',
	'November 2004 General Ballot Requested' => 'custom_9',
	'November 2005 General Ballot Requested' => 'custom_11',
	'November 2006 General Ballot Requested' => 'custom_14',
	'November 2007 General Ballot Requested' => 'custom_18',
	'November 2008 General Ballot Requested' => 'custom_21',
	'November 2009 General Ballot Requested' => 'custom_23',
	'November 2010 General Ballot Requested' => 'custom_25',
	'November 2011 General Ballot Requested' => 'custom_27',
	'November 2012 General Ballot Requested' => 'custom_30',
	'November 2013 General Ballot Requested' => 'custom_32',
	'Park' => 'custom_38',
	'Police' => 'custom_39',
	'Precinct' => 'custom_40',
	'Precinct Split' => 'custom_41',
	'Road' => 'custom_42',
	'School District' => 'custom_43',
	'State' => 'state_province',
	'State House District' => 'custom_44',
	'State Senate District' => 'custom_45',
	'Township' => 'custom_46',
	'Voter Address' => 'street_address',
	'Voter ID' => 'custom_47',
	'Voter Status' => 'custom_48',
	'Year Born' => 'custom_49',
	'Zip Code' => 'postal_code',
);

$field_mapping = array(
	// base fields
	'City' => 'base',
	'City or Village Code' => 'base',
	'First Name' => 'base',
	'Last Name' => 'base',
	'Middle Initial' => 'base',
	'Name Suffix' => 'base',
	'State' => 'base',
	'Voter Address' => 'base',
	'Zip Code' => 'base',  

	// Voting History
	'March 2000 Primary Ballot Requested' => 'Voting History',
	'November 2000 General Ballot Requested' => 'Voting History',
	'November 2001 General Ballot Requested' => 'Voting History',
	'May 2001 Special Ballot Requested' => 'Voting History',
	'November 2002 General Ballot Requested' => 'Voting History',
	'May 2002 Primary Ballot Requested' => 'Voting History',
	'November 2003 General Ballot Requested' => 'Voting History',
	'May 2003 Special Ballot Requested' => 'Voting History',
	'November 2004 General Ballot Requested' => 'Voting History',
	'March 2004 Primary Ballot Requested' => 'Voting History',
	'November 2005 General Ballot Requested' => 'Voting History',
	'May 2005 Primary Ballot Requested' => 'Voting History',
	'February 2005 Special Ballot Requested' => 'Voting History',
	'November 2006 General Ballot Requested' => 'Voting History',
	'May 2006 Primary Ballot Requested' => 'Voting History',
	'August 2006 Special Ballot Requested' => 'Voting History',
	'February 2006 Special Ballot Requested' => 'Voting History',
	'November 2007 General Ballot Requested' => 'Voting History',
	'May 2007 Primary Ballot Requested' => 'Voting History',
	'February 2007 Special Ballot Requested' => 'Voting History',
	'November 2008 General Ballot Requested' => 'Voting History',
	'March 2008 Primary Ballot Requested' => 'Voting History',
	'November 2009 General Ballot Requested' => 'Voting History',
	'May 2009 Primary Ballot Requested' => 'Voting History',
	'November 2010 General Ballot Requested' => 'Voting History',
	'May 2010 Primary Ballot Requested' => 'Voting History',
	'November 2011 General Ballot Requested' => 'Voting History',
	'May 2011 Primary Ballot Requested' => 'Voting History',
	'August 2011 Special Ballot Requested' => 'Voting History',
	'November 2012 General Ballot Requested' => 'Voting History',
	'March 2012 Primary Ballot Requested' => 'Voting History',
	'November 2013 General Ballot Requested' => 'Voting History',
	'May 2013 Primary Ballot Requested' => 'Voting History',
	'May 2014 Primary Ballot Requested' => 'Voting History',

	// Voter Metadata
	'Current Party Affiliation' => 'Voter Metadata',
	'Fire District' => 'Voter Metadata',
	'Federal Congressional District' => 'Voter Metadata',
	'Park District' => 'Voter Metadata',
	'Police District' => 'Voter Metadata',
	'Precinct Partial' => 'Voter Metadata',
	'Precinct Whole' => 'Voter Metadata',
	'Road District' => 'Voter Metadata',
	'School District' => 'Voter Metadata',
	'State House District' => 'Voter Metadata',
	'State Senate District' => 'Voter Metadata',
	'Township' => 'Voter Metadata',
	'Voter ID' => 'Voter Metadata',
	'Voter Status' => 'Voter Metadata',
	'Birth Year' => 'Voter Metadata',
	'Voter Registration Date' => 'Voter Metadata',
);

define('FILE_SKIP_EMPTY_LINES', TRUE);

if( ! $argv[1] ) {
	$usage = "Usage: $ civicrm-data-import filename.csv\nMissing filename\n"
	exit($usage);
}

$filehandle = fopen($argv[1], 'r');

if( ! $filehandle) {
	exit("File [".$argv[1]."] does not exist or can not be opened.");
}

$headers = fgetcsv($filehandle);

$line_counter = 2;
foreach ($records as $record) {
  // record will be associative array, field => value
  add_record($record);
}

$record = null;
while($record = transform_record(fgetcsv($filehandle), $headers, $line_counter)) {
	add_record($record);
}

function transform_record($record, $headers, $line_count) {
	if( ! $record) {
		return null;
	}

	$record_count = count($record);
	$header_count = count($headers);
	if($record_count != $header_count) {
		exit("Wrong number of fields line ".$line_count);
	}
	
	$ret = array();
	for($i = 0; $i < $record_count; $i++) {
		$ret[$headers[$i]] = $record[$i];
	}

	return ret;
}

function add_record($record) {
  // Package the record as base, voter_history, and voter_metadata
  $base_record = array();
  $voter_history = array();
  $voter_metadata = array();
  $contact = array();
  foreach($record as $field => $value) {
    $dst_field = $field_mapping[$field];
    if($dst_field == 'Voting History') {
      // Maybe not, though see http://wiki.civicrm.org/confluence/display/CRMDOC/Using+the+API#UsingtheAPI-CustomData
      array_push($voter_history, array('group' => 'Voting History', 'field' => $field, 'value' => $value));
    } elseif($dst_field == 'Voter Metadata') {
      array_push($voter_metadata, array('group' => 'Voter Metadata', 'field' => $field, 'value' => $value));
    } elseif($dst_field == 'base') {
      $contact[field_map_from_import[$dst_field]] = $value;
    }
    
    $result = null;
    try {
		$result = civicrm_api3('contact', 'create', $contact);
		if($result) {
		  foreach($voter_history as $fieldval) {
			_update_custom_field($result['id'], $fieldval['group'], $fieldval['field'], $fieldval['value']);
		  }
		  foreach($voter_metadata as $fieldval) {
			_update_custom_field($result['id'], $fieldval['group'], $fieldval['field'], $fieldval['value']);
		  }
		}
    } catch (CiviCRM_API3_Exception $e) {
      // handle error here
      $errorMessage = $e->getMessage();
      $errorCode = $e->getErrorCode();
      $errorData = $e->getExtraParams();
      return array('error' => $errorMessage, 'error_code' => $errorCode, 'error_data' => $errorData);
    }
    
    
  }
}

//updates the field, returns number of fields updated  
function _update_custom_field($uid,$group_name,$field_name,$value, $overwriteblank=FALSE){
  //echo "$uid G:$group_name F:$field_name V:$value \n";
 
  //Don't overwrite existing data if our data value is empty/blank
  //We consider anything that is just whitespace to be "blank"
  if ( ( !isset($value) || strlen(trim($value))==0 ) && !$overwriteblank) return 0;
	$custom_create_params = array (version => '3','sequential' =>'1', 'entity_id' =>$uid, "custom_" .$group_name . ":" . $field_name => $value);
    $results=civicrm_api("CustomValue","create", $custom_create_params);
    //'location_political_geo_information:state  
    //print_r($results);
  return 1;
   
}

?>
