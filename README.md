fclp-civicrm-data-importer
==========================

Imports data from ~~[Franklin County Board of Elections](https://vote.franklincountyohio.gov/candidates/voter-data.cfm)~~ updating to pull data from [Ohio Secretary of State](http://www2.sos.state.oh.us/pls/voter/f?p=111%3A1)

It seems the Secretary of State's data and Franklin County's are exactly the same. We're going to defer to simply using the SoS data as the authority
so this can easily scale to the state level.


To Do
=====

Refactor field names into JSON config file to be shared between scripts
