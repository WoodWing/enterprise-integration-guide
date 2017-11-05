<?php

$projectPath = realpath( __DIR__ . '/..' );
$fontMattersPerFile = parseFrontMattersForProjectPath( $projectPath );
$dirTree = composeDirTree( $fontMattersPerFile );
moveupIndexFilesInDirTree( $dirTree );
$guides = splitDirTreeInGuides( $dirTree );
sortFilesPerFolder( $guides );
enrichWithHtmlUrls( $guides );
composeTocYamlForGuides( $projectPath, $guides );
//print_r( $guides );

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
	if( isset( $item['frontmatter'] ) ) {
		$contents .= $indentStr . "  - title: {$item['frontmatter']['title']}" . PHP_EOL;
		$contents .= $indentStr . "    layout: {$item['frontmatter']['layout']}" . PHP_EOL;
		$contents .= $indentStr . "    path: {$item['path']}" . PHP_EOL;
		$contents .= $indentStr . "    url: {$item['url']}" . PHP_EOL;
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
			$child['url'] = '/enterprise-integration-guide/'.replaceFileExtension( $child['path'] );
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

function parseFrontMattersForProjectPath( $projectPath )
{
	$fontMattersPerFile = array();
	$mdFiles = collectMarkDownFiles( $projectPath );
	foreach( $mdFiles as $mdFile ) {
		$frontMatters = parseFrontMattersForFile( $mdFile );
		$relativeFilePath = substr( $mdFile, strlen( $projectPath )+1 );
		$fontMattersPerFile[$relativeFilePath] = $frontMatters;
	}
	ksort( $fontMattersPerFile );
	return $fontMattersPerFile;
}

function parseFrontMattersForFile( $mdFile )
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