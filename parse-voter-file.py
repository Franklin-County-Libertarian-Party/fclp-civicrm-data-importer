
import csv
import datetime
import re
import os
import sys

from parsehelpers import titleCase, county_map

vote_type_map = {
	'GENERAL': 'General',
	'PRIMARY': 'Primary',
	'SPECIAL': 'Special'
}

def formatRow(row, fieldnames):
	basic_dict = {
		'State Voter ID': str(row['SOS_VOTERID']).strip(),
		'County Voter ID': str(row['COUNTY_ID']).strip(),
		'Date Registered': str(row['REGISTRATION_DATE']).strip(),
		'First Name': titleCase(str(row['FIRST_NAME']).strip()),
		'Last Name': titleCase(str(row['LAST_NAME']).strip()),
		'Middle Name': titleCase(str(row['MIDDLE_NAME']).strip()),
		'Name Suffix': str(row['SUFFIX']).strip(),
		# Voter Status is being eliminated. This is something better determined at query time
		#'Voter Status': str(row['STATUS']).strip(),
		'Current Party Affiliation': str(row['PARTY_AFFILIATION']).strip(),
		'Year Born': str(row['YEAR_OF_BIRTH']).strip(),
		#'Voter Address': formatAddress(row),
		'Voter Residential Address': titleCase(str(row['RESIDENTIAL_ADDRESS1']).strip()),
		'Voter Residential Zip Code': str(row['RESIDENTIAL_ZIP']).strip(),
		'Voter Residential Zip Code +4': str(row['RESIDENTIAL_ZIP_PLUS4']).strip(),
		'Voter Mailing Address': titleCase(str(row['MAILING_ADDRESS1']).strip()),
		'Voter Mailing Zip Code':'',
		'Voter Mailing Zip Code +4':'',
		'Voter Mailing City':'',
		'Voter Mailing State':'',
		'City': titleCase(str(row['RESIDENTIAL_CITY']).strip()),
		'State': titleCase(str(row['RESIDENTIAL_ZIP']).strip()),
		'County': titleCase(county_map[str(row['COUNTY_NUMBER']).strip()]),
		'Precinct Name': str(row['PRECINCT_NAME']).strip(),
		'Precinct Code': str(row['PRECINCT_CODE']).strip(),
		'State House District': str(row['STATE_REPRESENTATIVE_DISTRICT']).strip(),
		'State Senate District': str(row['STATE_SENATE_DISTRICT']).strip(),
		'Federal Congressional District': str(row['CONGRESSIONAL_DISTRICT']).strip(),
		#'City or Village Code': str(row['CITY OR VILLAGE']).strip(),
		'Township': titleCase(str(row['TOWNSHIP']).strip()),
		'School District': str(row['LOCAL_SCHOOL_DISTRICT']).strip()
	}

	for field in fieldnames:
		m = re.search('(PRIMARY|GENERAL|SPECIAL)-(\d{2})/(\d{2})/(\d{4})', field)
		if m:
			vote_type = vote_type_map[m.group(1)] or 'Other'
			d = datetime.date(year=int(m.group(4)), month=int(m.group(2)), day=1)
			csv_label = d.strftime('%B %Y') + ' ' + vote_type + ' Ballot Requested'
			d = None
			basic_dict[csv_label] = row[field]
		m = None

	return basic_dict

def arrange_output_headers(headers):
	return sorted(headers)

usage = "Usage: $ python parse-voter-file.py infile [outfile = \"data-out.csv\"]"
try :
	if( not (sys.argv[1] and os.path.isfile(sys.argv[1]))):
		print "file " + sys.argv[1] + " doesn't exist or is inaccessible."
		print usage
		sys.exit(0)
except IndexError :
	print "Missing input file (infile)"
	print usage
	sys.exit(0)

outfilepath = 'data_out.csv'
try :
	if(sys.argv[2]):
		outfilepath = sys.argv[2]
except IndexError :
	pass

with open(sys.argv[1], 'rb') as fin, open(outfilepath, 'wb') as fout:
	reader = csv.DictReader(fin)
	firstrow = next(reader)
	fieldnames = reader.fieldnames
	basic_dict = formatRow(firstrow, fieldnames)
	output_fields = arrange_output_headers(basic_dict.keys())
	writer = csv.DictWriter(fout, output_fields, quotechar='"')
	writer.writeheader()
	writer.writerow(basic_dict)
	for row in reader:
		basic_dict = formatRow(row, fieldnames)        
		writer.writerow(basic_dict)

