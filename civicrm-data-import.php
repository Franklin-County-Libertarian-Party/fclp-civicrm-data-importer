<?php

/*

	This script loads data previously cleaned with parse-voter-file.py into CiviCRM via the API

*/

// TODO Replace magic strings with constants

$require_base_dir = '/var/www/civicrm/profiles/civicrm_starterkit/modules/civicrm/';

require_once $require_base_dir . 'civicrm.config.php';
 
require_once $require_base_dir . 'CRM/Core/Config.php';
require_once $require_base_dir . 'CRM/Core/Error.php';
$config = CRM_Core_Config::singleton( );
 
#civicrm_initialize(TRUE);
global $civicrm_root;

// see https://github.com/civicrm/civicrm-core/blob/master/api/v3/examples/Contact/Create.php

// TODO package into json
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
	'Middle Name' => 'middle_name',
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
	'Precinct Name' => 'custom_40',
	'Precinct Code' => 'custom_41',
	'Road' => 'custom_42',
	'School District' => 'custom_43',
	'State' => 'state_province',
	'State House District' => 'custom_44',
	'State Senate District' => 'custom_45',
	'Township' => 'custom_46',
	'Voter Street Address' => 'street_address',
	'Voter Mailing Address' => 'supplemental_address_1',
	'State Voter ID' => 'custom_47',
	'County Voter ID' => 'custom_51',
	'Voter Status' => 'custom_48',
	'Year Born' => 'custom_49',
	'County' => 'custom_52',
	'Voter Residential Zip Code' => 'postal_code',
);

// TODO package into JSON
$field_mapping = array(
	// base fields
	'City' => 'base',
	'City or Village Code' => 'base',
	'First Name' => 'base',
	'Last Name' => 'base',
	'Middle Name' => 'base',
	'Name Suffix' => 'base',
	'State' => 'base',
	'Zip Code' => 'base',  

	// Address(es)
	'Voter Street Address' => 'Address',
	'Voter Mailing Address' => 'Address',

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
	'Precinct Name' => 'Voter Metadata',
	'Precinct Code' => 'Voter Metadata',
	'Road District' => 'Voter Metadata',
	'School District' => 'Voter Metadata',
	'State House District' => 'Voter Metadata',
	'State Senate District' => 'Voter Metadata',
	'Township' => 'Voter Metadata',
	'State Voter ID' => 'Voter Metadata',
	'County Voter ID' => 'Voter Metadata',
	'Voter Status' => 'Voter Metadata',
	'Year Born' => 'Voter Metadata',
	'Date Registered' => 'Voter Metadata',
	'County' => 'Voter Metadata',
);

// TODO package into JSON
$state_civicrm_ids = array(
	'AL' => 1000,
	'AK' => 1001,
	'AZ' => 1002,
	'AR' => 1003,
	'CA' => 1004,
	'CO' => 1005,
	'CT' => 1006,
	'DE' => 1007,
	'DC' => 1050,
	'FL' => 1008,
	'GA' => 1009,
	'HI' => 1010,
	'ID' => 1011,
	'IL' => 1012,
	'IN' => 1013,
	'IA' => 1014,
	'KS' => 1015,
	'KY' => 1016,
	'LA' => 1017,
	'ME' => 1018,
	'MD' => 1019,
	'MA' => 1020,
	'MI' => 1021,
	'MN' => 1022,
	'MS' => 1023,
	'MO' => 1024,
	'MT' => 1025,
	'NE' => 1026,
	'NV' => 1027,
	'NH' => 1028,
	'NJ' => 1029,
	'NM' => 1030,
	'NY' => 1031,
	'NC' => 1032,
	'ND' => 1033,
	'OH' => 1034,
	'OK' => 1035,
	'OR' => 1036,
	'PA' => 1037,
	'RI' => 1038,
	'SC' => 1039,
	'SD' => 1040,
	'TN' => 1041,
	'TX' => 1042,
	'UT' => 1043,
	'VT' => 1044,
	'VA' => 1045,
	'WA' => 1046,
	'WV' => 1047,
	'WI' => 1048,
	'WY' => 1049,
);

$state_abbrs = array(
	'AL' => 'Alabama',
	'AK' => 'Alaska',
	'AZ' => 'Arizona',
	'AR' => 'Arkansas',
	'CA' => 'California',
	'CO' => 'Colorado',
	'CT' => 'Connecticut',
	'DE' => 'Delaware',
	'DC' => 'District of Columbia',
	'FL' => 'Florida',
	'GA' => 'Georgia',
	'HI' => 'Hawaii',
	'ID' => 'Idaho',
	'IL' => 'Illinois',
	'IN' => 'Indiana',
	'IA' => 'Iowa',
	'KS' => 'Kansas',
	'KY' => 'Kentucky',
	'LA' => 'Louisiana',
	'ME' => 'Maine',
	'MD' => 'Maryland',
	'MA' => 'Massachusetts',
	'MI' => 'Michigan',
	'MN' => 'Minnesota',
	'MS' => 'Mississippi',
	'MO' => 'Missouri',
	'MT' => 'Montana',
	'NE' => 'Nebraska',
	'NV' => 'Nevada',
	'NH' => 'New Hampshire',
	'NJ' => 'New Jersey',
	'NM' => 'New Mexico',
	'NY' => 'New York',
	'NC' => 'North Carolina',
	'ND' => 'North Dakota',
	'OH' => 'Ohio',
	'OK' => 'Oklahoma',
	'OR' => 'Oregon',
	'PA' => 'Pennsylvania',
	'RI' => 'Rhode Island',
	'SC' => 'South Carolina',
	'SD' => 'South Dakota',
	'TN' => 'Tennessee',
	'TX' => 'Texas',
	'UT' => 'Utah',
	'VT' => 'Vermont',
	'VA' => 'Virginia',
	'WA' => 'Washington',
	'WV' => 'West Virginia',
	'WI' => 'Wisconsin',
	'WY' => 'Wyoming',
);

if( ! $argv[1] ) {
	$usage = "Usage: $ civicrm-data-import filename.csv\nMissing filename\n";
	die($usage);
}

$filehandle = fopen($argv[1], 'r');

if( ! $filehandle) {
	exit("File [".$argv[1]."] does not exist or can not be opened.");
}

ini_set('auto_detect_line_endings', true);

$headers = fgetcsv($filehandle);

$line_counter = 2;

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

	return $ret;
}

function add_record($record) {
  // Package the record as base, voter_history, and voter_metadata
  global $field_mapping, $field_map_from_import;
  $base_record = array();
  $voter_history = array();
  $voter_metadata = array();
  $addresses = array();
  $contact = array();
  #die(print_r($record, true));
	$contact['contact_type'] = 'Individual';
	$contact['display_name'] = $record['First Name'] . " " . ($record['Middle Name'] ? substr($record['Middle Name'], 0, 1) . ". "  : '') . $record['Last Name'];
	$record['Date Registered'] = date('YmdHis', strtotime($record['Date Registered']));
	print "display_name: " . $contact['display_name'] . "\n";
  foreach($record as $field => $value) {
    $dst_field_category = $field_mapping[$field];

	// TODO Replace with switch
    if($dst_field_category == 'Address') {
		if($value) array_push($addresses, array('type' => $field_map_from_import[$field], 'address' => $value));
	} elseif($dst_field_category == 'Voting History') {
      // Maybe not, though see http://wiki.civicrm.org/confluence/display/CRMDOC/Using+the+API#UsingtheAPI-CustomData
      if($value) array_push($voter_history, array('group' => 'Voting History', 'field' => $field, 'value' => $value));
    } elseif($dst_field_category == 'Voter Metadata') {
	  if($value) array_push($voter_metadata, array('group' => 'Voter Metadata', 'field' => $field, 'value' => $value));
    } elseif($dst_field_category == 'base') {
	  if($field == 'Name Suffix') {
      	if(in_array($value, array('Jr.', 'JR', 'Sr.', 'SR', 'II', 'III', 'IV', 'V', 'VI'))) { // skip unrecognizable suffixes, this can be fixed later TODO
			$contact[$field_map_from_import[$field]] = $value;
		}
	  }
    } else {
		print("Skipping field: ".$field);
	}
    
  }
    $result = null;
    try {
		$result = civicrm_api3('contact', 'create', $contact);
		if($result) {
			_handle_contact_addresses($result['id'], $record);

		  foreach($voter_history as $fieldval) {
			_update_custom_field($result['id'], $fieldval['group'], $fieldval['field'], $fieldval['value']);
		  }
		  foreach($voter_metadata as $fieldval) {
			_update_custom_field($result['id'], $fieldval['group'], $fieldval['field'], $fieldval['value']);
		  }
		} else {
			
		}
    } catch (CiviCRM_API3_Exception $e) {
      // handle error here
      $errorMessage = $e->getMessage();
      $errorCode = $e->getErrorCode();
      $errorData = $e->getExtraParams();
      throw new Exception("[CIVICRM] Fatal error: ".print_r(array('error' => $errorMessage, 'error_code' => $errorCode, 'error_data' => $errorData), true));
    } catch(Exception $e) {
		throw $e;
	}
   	return $result; 
}

function _handle_contact_addresses($uid, $record) {

	global $state_civicrm_ids, $state_abbrs;

	$location_types = array(
		'Home' => 1,
		'Work' => 2,
		'Main' => 3,
		'Other' => 4,
		'Billing' => 5
	);
	$address_base = array(
		'contact_id' => $uid,
		'street_parsing' => 1,
	);
	
	$addresses = array();

	// TODO Remove duplicated logic
	if($record['Voter Residential Address']) {
		$address = $address_base;
		$address['is_primary'] = 1;
		$address['location_type_id'] = $location_types['Home'];
		$address['street_address'] = $record['Voter Residential Address'];
		$address['city'] = $record['City'];
		$address['state_province'] = $record['State'];
		$address['postal_code'] = $record['Voter Residential Zip Code +4'] ? $record['Voter Residential Zip Code +4'] : $record['Voter Residential Zip Code'];
		array_push($addresses, $address);
	}

	if($record['Voter Mailing Address']) {
		$address = $address_base;
		$address['is_primary'] = 1;
		$address['location_type_id'] = $location_types['Main'];
		$address['street_address'] = $record['Voter Mailing Address'];
		$address['city'] = $record['Voter Mailing City'] ? $record['Voter Mailing City'] : $record['City'];
		#$address['state_province'] = $record['Voter Mailing State'] ? $state_civicrm_ids[$record['Voter Mailing State']] : $state_civicrm_ids[$record['State']];
		$address['state_province'] = $state_abbrs[$record['Voter Mailing State'] ? $record['Voter Mailing State'] : $record['State']];
		$address['postal_code'] = ($record['Voter Mailing Zip Code +4'] ? $record['Voter Mailing Zip Code +4'] : 
			($record['Voter Mailing Zip Code'] ? $record['Voter Mailing Zip Code'] : $record['Voter Residential Zip Code'])
		);
		array_push($addresses, $address);
	}
	
	foreach($addresses as $add) {
		try {
			$results=civicrm_api3("address","create", $address);
		} catch (CiviCRM_API3_Exception $e) {
		  // handle error here
		  $errorMessage = $e->getMessage();
		  $errorCode = $e->getErrorCode();
		  $errorData = $e->getExtraParams();
		   throw new Exception("[CIVICRM] Fatal error: ".print_r(array('error' => $errorMessage, 'error_code' => $errorCode, 'error_data' => $errorData), true));
		} catch(Exception $e) {
			throw $e;
		}
	}

}

//updates the field, returns number of fields updated  
function _update_custom_field($uid,$group_name,$field_name,$value, $overwriteblank=FALSE){
  //Don't overwrite existing data if our data value is empty/blank
  //We consider anything that is just whitespace to be "blank"
  global $field_mapping, $field_map_from_import;
  if ( ( !isset($value) || strlen(trim($value))==0 ) && !$overwriteblank) return 0;
	$field_var = $field_map_from_import[$field_name];
	try {
		$results=civicrm_api3("custom_value","create", array($field_var => $value, 'entity_id' => $uid));
    } catch (CiviCRM_API3_Exception $e) {
      // handle error here
      $errorMessage = $e->getMessage();
      $errorCode = $e->getErrorCode();
      $errorData = $e->getExtraParams();
	   throw new Exception("[CIVICRM] Fatal error: ".print_r(array('error' => $errorMessage, 'error_code' => $errorCode, 'error_data' => $errorData), true));
    } catch(Exception $e) {
		throw $e;
	}
  return 1;
   
}

?>
