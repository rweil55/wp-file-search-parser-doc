<?php
include_once 'parser.php';

class DocParser
implements ParserWPfileSearch {

	public static
	function parse( $filename ) {
		$striped_content = '';
		$content = '';
		$fileHandle = fopen( $filename, "r" );
		$line = @fread( $fileHandle, filesize( $filename ) );
		$lines = explode( chr( 0x0D ), $line );
		$outtext = "";
		foreach ( $lines as $thisline ) {
			$pos = strpos( $thisline, chr( 0x00 ) );
			if ( ( $pos !== FALSE ) || ( strlen( $thisline ) == 0 ) ) {} else {
				$outtext .= $thisline . " ";
			}
		}
		$outtext = preg_replace( "/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext );
		write_log ($outtext);
		return $outtext;
	}

}