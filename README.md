fclp-civicrm-data-importer
==========================


Imports data from [Ohio Secretary of State](http://www2.sos.state.oh.us/pls/voter/f?p=111%3A1)

To Do
=====

* Refactor field names into JSON config file to be shared between scripts
* Do the same with state names and abbreviations and CiviCRM IDs
* Get magic strings out of files, refactoring to proper `const`



Issues
======

* When [Address](https://github.com/civicrm/civicrm-core/blob/master/api/v3/Address.php) objects are added to [Contact](https://github.com/civicrm/civicrm-core/blob/master/api/v3/Contact.php) objects
there [doesn't seem to be a good way to add the state to an address](https://github.com/civicrm/civicrm-core/blob/master/api/v3/examples/Address/Create.php). This could
bite us in the instance that someone lives in Ohio but operates a PO Box in Kentucky, etc. This should be a limited edge case and isn't a blocking issue.
* Throws the following error at EOF
```
~/devel/fclp-civicrm-data-importer
jdorn@localhost:2013:$ python2.7 parse-voter-file.py devtmp/raw/SWVF_1_44.TXT devtmp/out/counties-1-44.csv
Traceback (most recent call last):
  File "parse-voter-file.py", line 94, in <module>
    basic_dict = formatRow(row, fieldnames)        
  File "parse-voter-file.py", line 40, in formatRow
    'County': titleCase(county_map[str(row['COUNTY_NUMBER']).strip()]),
KeyError: 'None'
```
* Fix name suffix issue. CiviCRM requires name suffixes be defined within the system, this can be done later. Perhaps an update to do them programmatically
