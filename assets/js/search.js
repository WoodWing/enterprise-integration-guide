jQuery(function() {

	// Get the generated search_data.json file so lunr.js can search it locally.
	window.data = $.getJSON( appFolder+'/assets/'+guideId+'/search_data.json');

	// Initialize lunr with the fields to be searched, plus the boost.
	window.data.then(function(loaded_data){
		window.idx = lunr(function () {
			this.metadataWhitelist = ['position']; // ask for position info in search results
			this.field('id');
			this.field('title');
			this.field('content', { boost: 10 });
			this.field('author');
			this.field('category');
			for (var key in loaded_data) { // Add the data to lunr
				this.add({
					'id': key,
					'title': loaded_data[key].title,
					'author': loaded_data[key].author,
					'category': loaded_data[key].category,
					'content': loaded_data[key].content
				});
			}
		});
	});

	// Event when the form is submitted
	$("#site_search").submit(function(event){
		event.preventDefault();
		var query = $("#search_box").val(); // Get the value for the text field
		var results = window.idx.search(query); // Get lunr to perform a search
		// "Enterprise": results[1].matchData.metadata.enterpris.content
		var tokens = lunr.tokenizer(query);
		var terms = window.idx.pipeline.run(tokens);
		display_search_results(results, terms); // Hand the results off to be displayed
	});

	function display_search_results(results, terms) {
		var $search_results = $("#search_results");

		// Wait for data to load
		window.data.then(function(loaded_data) {

			// Are there any results?
			if (results.length) {
				$search_results.empty(); // Clear any old results

				// Iterate over the results
				results.forEach(function(result) {
					var item = loaded_data[result.ref];

					// Build a snippet of HTML for this result
					var appendString = '<a href="' + item.url + '" style="font-size:1.2em; text-decoration: underline;">'
						+ composeTitle( item, result, terms ) + '</a><br/>'
						+ composeContent( item, result, terms ) + '<br/><br/>';

					// Add the snippet to the collection of results.
					$search_results.append(appendString);
				});
			} else {
				// If there are no results, let the user know.
				$search_results.html('<li>No results found.</li>');
			}
		});
	}

});

function composeTitle( item, result, terms ) {
	var markPosistions = [];
	terms.forEach(function(term) {
		if( result.matchData.metadata[term] !== undefined ) {
			if( result.matchData.metadata[term].title !== undefined ) {
				result.matchData.metadata[term].title.position.forEach(function (pos) {
					markPosistions.push(pos);
				});
			}
		}
	});

	var title = '';
	if( markPosistions.length > 0 ) {
		markPosistions.sort(function (a, b) {
			return a[0] > b[0] ? 1 : a[0] < b[0] ? -1 : 0
		});

		var insertPos = 0;
		markPosistions.forEach(function (pos) {
			title += item.title.substring(insertPos, pos[0]);
			var highlight = item.title.substring(pos[0], pos[0] + pos[1]);
			title += ' <b>' + highlight + '</b>';
			insertPos = pos[0] + pos[1];
		});
		if (insertPos > 0) {
			title += ' ' + item.title.substring(insertPos);
		}
	} else {
		title = item.title;
	}
	return title;
}

function composeContent( item, result, terms ) {
	var markPosistions = [];
	terms.forEach(function(term) {
		if( result.matchData.metadata[term] !== undefined ) {
			if( result.matchData.metadata[term].content !== undefined ) {
				result.matchData.metadata[term].content.position.forEach(function (pos) {
					markPosistions.push(pos);
				});
			}
		}
	});

	markPosistions.sort(function (a, b) {
		return a[0] > b[0] ? 1 : a[0] < b[0] ? -1 : 0
	});

	var slicePositions = [];
	markPosistions.forEach(function(pos) {
		if( slicePositions[slicePositions.length-1] === undefined ) {
			slicePositions.push( pos.slice(0) ); // slice(0) to make a clone
		} else {
			var prevPos = slicePositions[slicePositions.length-1];
			var prevEndPos = prevPos[0] + prevPos[1];
			var intersect = item.content.substring( prevEndPos, pos[0] - prevEndPos );
			var wordCountIntersect = intersect.split(" ").length - 1;
			if( wordCountIntersect <= 10 ) {
				slicePositions[slicePositions.length-1][1] = pos[0] + pos[1] - prevPos[0];
			} else {
				slicePositions.push( pos.slice(0) ); // slice(0) to make a clone
			}
		}
	});

	slicePositions.forEach( function(pos) {
		var prefix = getPrecedingWords( item.content, 5, pos[0] );
		var postfix = getSucceedingWords( item.content, 5, pos[0] + pos[1] );
		pos[0] -= prefix.length;
		pos[1] += (prefix.length + postfix.length);
	});

	var content = '...';
	slicePositions.forEach( function(slidePos) {
		if( content.length > 150 ) {
			return;
		}
		var insertPos = slidePos[0];
		markPosistions.forEach(function(markPos) {
			if( content.length > 150 ) {
				return;
			}
			if( markPos[0] >= slidePos[0] && markPos[0] < ( slidePos[0] + slidePos[1] ) ) {
				content += ' ' + item.content.substring( insertPos, markPos[0] );
				var highlight = item.content.substring( markPos[0], markPos[0] + markPos[1] );
				content += ' <b>' + highlight + '</b>';
				insertPos = markPos[0] + markPos[1];
			}
		});
		if( insertPos > slidePos[0] ) {
			content += ' ' + item.content.substring( insertPos, slidePos[0] + slidePos[1] );
		}
		content += ' ...';
	});

	return content;
}

function getSucceedingWords( searchInString, occurrence, fromStart ) {
	var foundAt = getIndexOfNthOccurrenceFromStart( searchInString, ' ', occurrence, fromStart );
	var words = '';
	if( foundAt >= 0 ) {
		words = searchInString.substring( fromStart, foundAt );
	} else {
		words = searchInString.substring( fromStart );
	}
	return words;
}

function getPrecedingWords( searchInString, occurrence, fromEnd ) {
	var foundAt = getIndexOfNthOccurrenceFromEnd( searchInString, ' ', occurrence, fromEnd );
	var words = '';
	if( foundAt >= 0 ) {
		words = searchInString.substring( foundAt, fromEnd );
	} else {
		words = searchInString.substring( 0, fromEnd );
	}
	return words;
}
function getIndexOfNthOccurrenceFromStart( searchInString, searchForSubString, occurrence, fromStart ) {
	searchInString = searchInString.substring( fromStart );
	var strLen = searchInString.length, i = -1;
	while( occurrence-- && i++ < strLen ) {
		i = searchInString.indexOf( searchForSubString, i, fromStart );
		if( i < 0 ) {
			break;
		}
	}
	return i + fromStart;
}

function getIndexOfNthOccurrenceFromEnd( searchInString, searchForSubString, occurrence, fromEnd ) {
	searchInString = searchInString.substring( 0, fromEnd );
	var i = fromEnd;
	while( occurrence-- && i-- >= 0 ) {
		i = searchInString.lastIndexOf( searchForSubString, i );
		if( i < 0 ) {
			break;
		}
	}
	return i;
}
