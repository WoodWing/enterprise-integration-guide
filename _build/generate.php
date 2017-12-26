<?php

/**
 * Generator for:
 * - Table Of Contents files (_data/<guide>/toc.yaml)
 * - Search index files for Junr.js (assets/<guide>/search_data.json)
 * - Permanent links (add a permalink to the front matter of the Markdown files)
 */

$projectPath = realpath( __DIR__ . '/..' );
$configFile = $projectPath.'/_build/config.json';
$configData = json_decode( file_exists($configFile) ? file_get_contents($configFile) : '{"maxDocId": 1000}' );
$fontMattersPerFile = parseFrontMattersForProjectPath( $projectPath, $configData->maxDocId );
$dirTree = composeDirTree( $fontMattersPerFile );
moveupIndexFilesInDirTree( $dirTree );
$guides = splitDirTreeInGuides( $dirTree );
sortFilesPerFolder( $guides );
enrichWithHtmlUrls( $guides );
composeTocYamlForGuides( $projectPath, $guides );
composeSearchIndex( $projectPath, $guides );
file_put_contents($configFile, json_encode($configData));

function composeSearchIndex( $projectPath, $guides )
{
	foreach( $guides as $guideId => $guide ) {
		$folder = $projectPath.'/assets/'.$guideId;
		if( !file_exists( $folder ) ) {
			mkdir( $folder, 0777, true );
		}
		$searchFileName = $folder . '/search_data.json';

		$index = new stdClass();
		composeSearchIndexForDirTree( $projectPath, $index, $guide );
		$searchIndexData = json_encode( $index, JSON_PRETTY_PRINT );
		file_put_contents( $searchFileName, $searchIndexData );
	}
}

function composeSearchIndexForDirTree( $projectPath, $index, $item )
{
	static $id = 0;
	$fileName = $projectPath . '/' . $item['path'];
	$fileContents = file_get_contents( $fileName );
	$fileContents = preg_replace('/\s+/', ' ', $fileContents );

	$record = new stdClass();
	foreach( array( 'title', 'author', 'category' ) as $fieldName ) {
		if( isset( $item['frontmatter'][$fieldName] ) ) {
			$fieldValue = $item['frontmatter'][$fieldName];
		} else {
			$fieldValue = '';
		}
		$record->{$fieldName} = $fieldValue;
	}
	$record->content = $fileContents;
	$record->url = $item['frontmatter']['permalink'];

	$index->{$id} = $record;
	$id += 1;

	if( isset( $item['children'] ) ) {
		foreach( $item['children'] as $child ) {
			composeSearchIndexForDirTree( $projectPath, $index, $child );
		}
	}
}

function composeTocYamlForGuides( $projectPath, $guides )
{
	foreach( $guides as $guideId => $guide ) {
		$contents = 'toc:'.PHP_EOL;
		$contents .= composeTocYamlForDirTree( $guide );
		$folder = $projectPath.'/_data/'.$guideId;
		if( !file_exists( $folder ) ) {
			mkdir( $folder, 0777, true );
		}
		file_put_contents( $folder.'/toc.yaml', $contents );
	}
}

function composeTocYamlForDirTree( $item, $indent = 0 )
{
	$contents = '';
	$indentStr = str_repeat( ' ', $indent );
	if( isset( $item['frontmatter']['title'] ) && isset( $item['frontmatter']['layout'] ) ) {
		$contents .= $indentStr . "  - title: {$item['frontmatter']['title']}" . PHP_EOL;
		$contents .= $indentStr . "    layout: {$item['frontmatter']['layout']}" . PHP_EOL;
		$contents .= $indentStr . "    path: {$item['path']}" . PHP_EOL;
		$contents .= $indentStr . "    url: {$item['url']}" . PHP_EOL;
		$contents .= $indentStr . "    permalink: {$item['frontmatter']['permalink']}" . PHP_EOL;
	}
	if( isset( $item['children'] ) ) {
		$contents .= $indentStr . "    children:" . PHP_EOL;
		foreach( $item['children'] as $child ) {
			$contents .= composeTocYamlForDirTree( $child, $indent + 2 );
		}
	}
	return $contents;
}

function enrichWithHtmlUrls( &$children )
{
	foreach( $children as &$child ) {
		if( isset($child['path']) ) {
			$child['url'] = replaceFileExtension( $child['path'] );
		}
		if( isset($child['children']) ) {
			enrichWithHtmlUrls( $child['children'] );
		}
	}
}

function replaceFileExtension( $mdFile )
{
	$pos = strrpos( $mdFile,'.md' );
	if( $pos !== false ) {
		return substr( $mdFile, 0, $pos ).'.html';
	}
	return $mdFile;
}

function sortFilesPerFolder( &$children )
{
	uasort( $children,
		function( $lhs, $rhs ) {
			$sortLhs = isset( $lhs['frontmatter']['sortid'] ) ? intval($lhs['frontmatter']['sortid']) : PHP_INT_MAX;
			$sortRhs = isset( $rhs['frontmatter']['sortid'] ) ? intval($rhs['frontmatter']['sortid']) : PHP_INT_MAX;
			if( $sortLhs == $sortRhs ) {
				return 0;
			}
			return $sortLhs < $sortRhs ? -1 : 1;
		}
	);
	foreach( $children as &$child ) {
		if( isset($child['children']) ) {
			sortFilesPerFolder( $child['children'] );
		}
	}
}

function splitDirTreeInGuides( $dirTree )
{
	$guides = array();
	//$dirTree = $dirTree['']['children']; // prune empty root item (caused by leading slash in folders)
	foreach( $dirTree as $id => $item ) {
		if( isset( $item['frontmatter']['layout'] ) ) {
			if( $item['frontmatter']['layout'] == 'guide' ) {
				$guides[$id] = $item;
			}
		}
	}
	return $guides;
}

function moveupIndexFilesInDirTree( &$dirTree )
{
	foreach( $dirTree as $id => &$item ) {
		if( isset( $item['children']['index.md'] ) ) {
			$index = $item['children']['index.md'];
			$item['path'] = $index['path'];
			$item['frontmatter'] = $index['frontmatter'];
			unset( $dirTree[$id]['children']['index.md'] );
		}
		if( isset( $item['children'] ) ) {
			moveupIndexFilesInDirTree( $item['children'] );
		}
	}
}

function composeDirTree( $fontMattersPerFile )
{
	$tree = array();
	foreach( $fontMattersPerFile as $mdFilePath => $fontMatterAttributes ) {
		$struct = composeMultiDimArrayFromFilePath( $mdFilePath,
			function() use ( $mdFilePath, $fontMatterAttributes ) {
				return array(
					'path' => $mdFilePath,
					'frontmatter' => $fontMatterAttributes
				);
			},
			function( $children ) {
				return array(
					'children' => $children
				);
			}
		);
		$tree = array_merge_recursive( $tree, $struct );
	}
	return $tree;
}

function composeMultiDimArrayFromFilePath( $path, $cbFileItem, $cbDirItem )
{
	$pos = strpos( $path, '/' );
	if( $pos === false ) {
		return array( $path => call_user_func( $cbFileItem ) );
	} else {
		$key = substr( $path, 0, $pos );
		$path = substr( $path, $pos + 1 );
		return array( $key => call_user_func( $cbDirItem, composeMultiDimArrayFromFilePath( $path, $cbFileItem, $cbDirItem ) ) );
	}
}

function parseFrontMattersForProjectPath( $projectPath, &$maxDocId )
{
	$fontMattersPerFile = array();
	$mdFiles = collectMarkDownFiles( $projectPath );
	foreach( $mdFiles as $mdFile ) {
		$frontMatters = parseFrontMattersForFile( $mdFile, $maxDocId );
		$relativeFilePath = substr( $mdFile, strlen( $projectPath )+1 );
		$fontMattersPerFile[$relativeFilePath] = $frontMatters;
	}
	ksort( $fontMattersPerFile );
	return $fontMattersPerFile;
}

function parseFrontMattersForFile( $mdFile, &$maxDocId )
{
	$frontMatters = array();
	$contents = file_get_contents( $mdFile );
	$parts = array();
	$hasFrontMatter = preg_match( "/^---$(.|\s)+?^---$/m", $contents, $parts );
	if( $hasFrontMatter ) {
		$frontMatterText = $parts[0];
		$frontMatterText = trim( substr( $frontMatterText, 3, -3 ) );
		$frontMatterLines = preg_split( '(\r\n|\r|\n)', $frontMatterText );
		foreach( $frontMatterLines as $frontMatterLine ) {
			list( $key, $value ) = explode( ':', $frontMatterLine, 2 );
			$key = trim( $key );
			$value = trim( $value );
			$frontMatters[$key] = $value;
		}
		$parts = preg_split( '/^(---)$/m', $contents, 3 );
		if( count($parts) === 3 ) {
			if( !array_key_exists( 'permalink', $frontMatters ) ) {
				$fileParts = pathinfo( $mdFile );
				$permalink = "{$maxDocId}-".basename( $fileParts['filename'] );
				$frontMatters['permalink'] = $permalink;
				$maxDocId += 1;
			}
			$contents = $parts[0] . '---' . PHP_EOL;
			foreach( $frontMatters as $key => $value ) {
				$contents .= "{$key}: {$value}" . PHP_EOL;
			}
			$contents .= '---'.$parts[2];
			file_put_contents( $mdFile, $contents );
		}
	}
	return $frontMatters;
}

function collectMarkDownFiles( $filePath )
{
	return collectFiles( $filePath, '.md' );
}

function collectFiles( $filePath, $fileExtension )
{
	$collectFiles = array();
	if( is_dir( $filePath ) ) {
		$dirName = basename( $filePath );
		if( isset($dirName[0]) && $dirName[0] !== '_' ) { // skip system folders (prefixed with underscore)
			$dirHandle = opendir( $filePath );
			if( $dirHandle ) {
				while( ( $itemName = readdir( $dirHandle ) ) !== false ) {
					if( isset( $itemName[0] ) && $itemName[0] !== '.' ) { // skip hidden files (prefixed with dot), current folder '.' and parent folder '..'
						$collectFiles = array_merge( $collectFiles, collectFiles( $filePath . '/' . $itemName, $fileExtension ) );
					}
				}
				closedir( $dirHandle );
			}
		}
	} elseif( is_file( $filePath ) ) {
		if( getFileExtension( $filePath ) == $fileExtension ) {
			$collectFiles[] = $filePath;
		}
	}
	return $collectFiles;
}

function getFileExtension( $fileName )
{
	if( !strrpos( $fileName, '.' ) ) {
		return '';
	}
	$explodedFile = explode( '.', $fileName );
	$fileExt = array_pop( $explodedFile );
	return strtolower( '.' . $fileExt );
}