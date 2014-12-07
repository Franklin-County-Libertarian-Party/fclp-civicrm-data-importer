
import re 
articles = ['a', 'an', 'of', 'the', 'is']
def titleCase(inStr):
	s = strClean(inStr)
	if( not isinstance(s, str)):
		return s
	word_list = re.split(' ', s.lower())
	final = [word_list[0].capitalize()]
	for word in word_list[1:]:
		final.append(word in articles and word or word.capitalize())
	return " ".join(final)

def strClean(s):
	try:
		string = s
		if( not isinstance(s, str) ):
			string = str(s)
		return str(re.sub(r'(\s){2,}','\g<1>', string.strip()))
	except Exception as e:
		return s

county_map = {
	'01': 'ADAMS',
	'02': 'ALLEN',
	'03': 'ASHLAND',
	'04': 'ASHTABULA',
	'05': 'ATHENS',
	'06': 'AUGLAIZE',
	'07': 'BELMONT',
	'08': 'BROWN',
	'09': 'BUTLER',
	'10': 'CARROLL',
	'11': 'CHAMPAIGN',
	'12': 'CLARK',
	'13': 'CLERMONT',
	'14': 'CLINTON',
	'15': 'COLUMBIANA',
	'16': 'COSHOCTON',
	'17': 'CRAWFORD',
	'18': 'CUYAHOGA',
	'19': 'DARKE',
	'20': 'DEFIANCE',
	'21': 'DELAWARE',
	'22': 'ERIE',
	'23': 'FAIRFIELD',
	'24': 'FAYETTE',
	'25': 'FRANKLIN',
	'26': 'FULTON',
	'27': 'GALLIA',
	'28': 'GEAUGA',
	'29': 'GREENE',
	'30': 'GUERNSEY',
	'31': 'HAMILTON',
	'32': 'HANCOCK',
	'33': 'HARDIN',
	'34': 'HARRISON',
	'35': 'HENRY',
	'36': 'HIGHLAND',
	'37': 'HOCKING',
	'38': 'HOLMES',
	'39': 'HURON',
	'40': 'JACKSON',
	'41': 'JEFFERSON',
	'42': 'KNOX',
	'43': 'LAKE',
	'44': 'LAWRENCE',
	'45': 'LICKING',
	'46': 'LOGAN',
	'47': 'LORAIN',
	'48': 'LUCAS',
	'49': 'MADISON',
	'50': 'MAHONING',
	'51': 'MARION',
	'52': 'MEDINA',
	'53': 'MEIGS',
	'54': 'MERCER',
	'55': 'MIAMI',
	'56': 'MONROE',
	'57': 'MONTGOMERY',
	'58': 'MORGAN',
	'59': 'MORROW',
	'60': 'MUSKINGUM',
	'61': 'NOBLE',
	'62': 'OTTAWA',
	'63': 'PAULDING',
	'64': 'PERRY',
	'65': 'PICKAWAY',
	'66': 'PIKE',
	'67': 'PORTAGE',
	'68': 'PREBLE',
	'69': 'PUTNAM',
	'70': 'RICHLAND',
	'71': 'ROSS',
	'72': 'SANDUSKY',
	'73': 'SCIOTO',
	'74': 'SENECA',
	'75': 'SHELBY',
	'76': 'STARK',
	'77': 'SUMMIT',
	'78': 'TRUMBULL',
	'79': 'TUSCARAWAS',
	'80': 'UNION',
	'81': 'VANWERT',
	'82': 'VINTON',
	'83': 'WARREN',
	'84': 'WASHINGTON',
	'85': 'WAYNE',
	'86': 'WILLIAMS',
	'87': 'WOOD',
	'88': 'WYANDOT'
}



