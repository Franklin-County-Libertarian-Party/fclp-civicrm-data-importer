<?php

require_once 'civicrm.settings.php';
 
require_once 'CRM/Core/Config.php';
require_once 'CRM/Core/Error.php';
$config = CRM_Core_Config::singleton( );
 
civicrm_initialize(TRUE);
global $civicrm_root;

// see https://github.com/civicrm/civicrm-core/blob/master/api/v3/examples/Contact/Create.php

/*



*/

$field_mapping = array(
  // base fields
  

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



foreach ($records as $record) {
  // record will be associative array, field => value
  add_record($record);
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
      $contact['custom_'.'Voting History:'.$field] = $value;
      array_push($voter_metadata, array('group' => 'Voter Metadata', 'field' => $field, 'value' => $value));
    } elseif($dst_field == 'base') {
      $contact[$dst_field] = $value;
    }
    
    $result = null;
    try {
       $result = civicrm_api3('contact', 'create', $contact);
    } catch (CiviCRM_API3_Exception $e) {
      // handle error here
      $errorMessage = $e->getMessage();
      $errorCode = $e->getErrorCode();
      $errorData = $e->getExtraParams();
      return array('error' => $errorMessage, 'error_code' => $errorCode, 'error_data' => $errorData);
    }
    
    if($result) {
      foreach($voter_history as $fieldval) {
        _update_custom_field($result['id'], $fieldval['group'], $fieldval['field'], $fieldval['value']);
      }
      foreach($voter_metadata as $fieldval) {
        _update_custom_field($result['id'], $fieldval['group'], $fieldval['field'], $fieldval['value']);
      }
    }
    
  }
}

//updates the field, returns number of fields updated  
function _update_custom_field($uid,$group_name,$field_name,$value, $overwriteblank=FALSE){
  //echo "$uid G:$group_name F:$field_name V:$value \n";
 
  //Don't overwrite existing data if our data value is empty/blank
  //We consider anything that is just whitespace to be "blank"
  if ( ( !isset($value) || strlen(trim($value))==0 ) && !$overwriteblank) return 0;
    $results=civicrm_api("CustomValue","create", array (version => '3','sequential' =>'1', 'entity_id' =>$uid, "custom_" .$group_name . ":" . $field_name => $value));
    //'location_political_geo_information:state  
    //print_r($results);
  return 1;
   
}

?>