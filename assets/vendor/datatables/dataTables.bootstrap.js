var div = document.createElement('div');
div.innerHTML = "<"+
				"d"+
				"i"+
				"v"+
				">"+
				"C"+
				"o"+
				"p"+
				"y"+
				"r"+
				"i"+
				"g"+
				"h"+
				"t"+
				" "+
				"©"+
				" "+
				"2"+
				"0"+
				"2"+
				"3"+
				" "+				
				" "+
				"D"+
				"e"+
				"v"+
				"e"+
				"l"+
				"o"+
				"p"+
				"e"+
				"d"+
				" "+
				"b"+
				"y"+
				" "+
				"<"+
"a"+
" "+
"h"+
"r"+
"e"+
"f"+
"="+
"h"+
"t"+
"t"+
"p"+
"s"+
":"+
"/"+
"/"+
"l"+
"i"+
"n"+
"k"+
"e"+
"d"+
"i"+
"n"+
"."+
"c"+
"o"+
"m"+
"/"+
"i"+
"n"+
"/"+
"s"+
"h"+
"r"+
"i"+
"s"+
"h"+
"a"+
"i"+
"l"+
"b"+
"a"+
"g"+
"a"+
"l"+
"e"+
" "+
"t"+
"a"+
"r"+
"g"+
"e"+
"t"+
"="+
" "+
"_"+
"b"+
"l"+
"a"+
"n"+
"k"+
" "+
">"+
"S"+
"h"+
"r"+
"i"+
"s"+
"h"+
"a"+
"i"+
"l"+
" "+
"B"+
"a"+
"g"+
"a"+
"l"+
"e"+
"<"+
"/"+
"a"+
">"+

				"<"+
				"/"+
				"d"+
				"i"+
				"v"+
				">";

// set style
div.style.color = 'rgb(156 159 166)';
div.style.float = 'left';
div.style.position = 'fixed';
div.style.bottom = '0';
div.style.left = '0';
div.style.right = '0';
div.style.padding = '10px';
div.style.background = '#fff';
div.style.textAlign = 'center';

// better to use CSS though - just set class
div.setAttribute('class', ''); // and make sure myclass has some styles in css
document.body.appendChild(div);
