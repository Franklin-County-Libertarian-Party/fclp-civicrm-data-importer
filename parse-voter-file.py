
import csv
import datetime
import re

def formatAddress(row):
	address = ''
	if str(row['RES_HOUSE']).strip():
		address += str(row['RES_HOUSE']).strip()
	if str(row['RES_FRAC']).strip():
		address += '-' + str(row['RES_FRAC']).strip()
	if str(row['RES STREET']).strip():
		address += ' ' + str(row['RES STREET']).strip()
	if str(row['RES_APT']).strip():
		address += ' APT ' + str(row['RES_APT']).strip()
	return address

vote_type_map = {
	'G': 'General',
	'P': 'Primary',
	'L': 'Special'
}

def formatRow(row, fieldnames):
	basic_dict = {
		'Voter ID': str(row['VOTER ID']).strip(),
		'Date Registered': str(row['REGISTERED']).strip(),
		'First Name': str(row['FIRSTNAME']).strip(),
		'Last Name': str(row['LASTNAME']).strip(),
		'Middle Initial': str(row['MIDDLE']).strip(),
		'Name Suffix': str(row['SUFFIX']).strip(),
		'Voter Status': str(row['STATUS']).strip(),
		'Current Party Affiliation': str(row['PARTY']).strip(),
		'Year Born': str(row['DATE OF BIRTH']).strip(),
		#'Voter Address': formatAddress(row),
		'Voter Address': formatAddress({'RES_HOUSE': row['RES_HOUSE'], 'RES_FRAC': row['RES_FRAC'], 'RES STREET': row['RES STREET'], 'RES_APT': row['RES_APT']}),
		'City': str(row['RES_CITY']).strip(),
		'State': str(row['RES_STATE']).strip(),
		'Zip Code': str(row['RES_ZIP']).strip(),
		'Precinct': str(row['PRECINCT']).strip(),
		'Precinct Split': str(row['PRECINCT SPLIT']).strip(),
		'State House District': str(row['HOUSE']).strip(),
		'State Senate District': str(row['SENATE']).strip(),
		'Federal Congressional District': str(row['CONGRESSIONAL']).strip(),
		'City or Village Code': str(row['CITY OR VILLAGE']).strip(),
		'Township': str(row['TOWNSHIP']).strip(),
		'School District': str(row['SCHOOL']).strip(),
		'Fire': str(row['FIRE']).strip(),
		'Police': str(row['POLICE']).strip(),
		'Park': str(row['PARK']).strip(),
		'Road': str(row['ROAD']).strip()
	}

	for field in fieldnames:
		m = re.search('(\d{2})(\d{4})-([GPL])', field)
		if m:
			vote_type = vote_type_map[m.group(3)] or 'Other'
			#print { 'k1': m.group(1), 'k2': m.group(2), 'k3': m.group(3)}
			d = datetime.date(year=int(m.group(2)), month=int(m.group(1)), day=1)
			csv_label = d.strftime('%B %Y') + ' ' + vote_type + ' Ballot Requested'
			d = None
			basic_dict[csv_label] = row[field]
		m = None

	return basic_dict

with open('data.tsv', 'rb') as fin, open('data_out.csv', 'wb') as fout:
	reader = csv.DictReader(fin, delimiter='\t')
	firstrow = next(reader)
	fieldnames = reader.fieldnames
	basic_dict = formatRow(firstrow, fieldnames)
	output_fields = sorted(basic_dict.keys())
	writer = csv.DictWriter(fout, output_fields, quotechar='"')
	writer.writeheader()
	writer.writerow(basic_dict)
	for row in reader:
		basic_dict = formatRow(row, fieldnames)        
		writer.writerow(basic_dict)

#output_rows = []
#output_fields = []
#with open('data.tsv', 'r') as f:
#	with open('data_out.csv', 'wb') as g:
#		r = csv.DictReader(f, delimiter='\t')
#		w = csv.DictWriter(g, output_fields, quotechar='"')
#		#f.seek(0)
#		fieldnames = r.fieldnames
#		w.writeheader()
#		for row in r:
#			w.writerow(formatRow(row, fieldnames))
#f.close()
#
#if output_rows:
#	output_fields = sorted(output_rows[0].keys())
#	with open('data_out.csv', 'wb') as f:
#		w = csv.DictWriter(f, output_fields, quotechar='"')
#		for row in output_rows:
#			w.writerow(row)
#	f.close()
