<?php

/* This file is part of the Ubiq project, which is under MIT license */

abstract class UArray {



	/*************************************************************************
	  CONERSION METHODS
	 *************************************************************************/
	public static function convertToArray( $mixed ) {
		if ( is_object( $mixed ) ) {
			if ( is_a( $mixed, 'StdClass' ) ) {
				$mixed = ( array ) $mixed;
			} else if ( is_a( $mixed, 'ArrayObject' ) ) {
				$mixed = $mixed->getArrayCopy( );
			} else {
				$mixed = get_object_vars( $mixed );
			}
		} else if ( ! is_array( $mixed ) ) {
			if ( empty( $mixed ) ) {
				$mixed = array( );
			} else {
				$mixed = array( $mixed );
			}
		}
		return $mixed;
	}

	public static function doConvertToArray( &$mixed ) {
		$mixed = \UArray::convertToArray( $mixed );
	}



	/*************************************************************************
	  SCHEMA METHODS
	 *************************************************************************/
	public static function isMatchSchema( $array, $schema ) {
		foreach ( $schema as $key => $value ) {
			if ( is_numeric( $key ) ) {
				if ( ! isset( $array[ $value ] ) ) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	public static function applySchema( $array, $schema ) {
		foreach ( $schema as $key => $value ) {
			if ( is_numeric( $key ) ) {
				if ( ! isset( $array[ $value ] ) ) {
					return FALSE;
				}
			} else {
				if ( ! isset( $array[ $key ] ) ) {
					$array[ $key ] = $value;
				}
			}
		}
		return $array;
	}

	public static function doApplySchema( &$array, $schema ) {
		$result = \UArray::applySchema( $array, $schema );
		if ( $result !== FALSE ) {
			$array = $result;
		}
		return ( $result !== FALSE );
	}



	/*************************************************************************
	  OFFSET METHODS
	 *************************************************************************/
	public static function getOffsetIndex( $array, $index ) {
		return array_search( $index, array_keys( $array ), TRUE );
	}



	/*************************************************************************
	  REMOVING METHODS
	 *************************************************************************/
	public static function removeIndex( $array, $indexes ) {
		\UArray::doConvertToArray( $indexes );
		$removed_keys = array( );
		foreach( $indexes as $index ) {
			if ( is_numeric( $index ) ) {
				$gap = 0;
				foreach ( $removed_keys as $removed_key ) {
					if ( $removed_key < $index ) {
						$gap++;
					}
				}
				$key = $index - $gap;
				if ( array_key_exists( $key, $array ) ) {
					$offset = \UArray::getOffsetIndex( $array, $key );
					array_splice( $array, $offset, 1 );
					$removed_keys[ ] = $index;
				}
			} else {
				unset( $array[ $index ] );
			}
		}
		return $array;
	}

	public static function doRemoveIndex( &$array, $indexes ) {
		$array = \UArray::removeIndex( $array, $indexes );
	}

	public static function removeValue( $array, $values ) {
		\UArray::doConvertToArray( $values );
		$indexes = array( );
		foreach( $values as $value ) {
			$indexes = array_merge( $indexes, array_keys( $array, $value ) );
		}
		return \UArray::removeIndex( $array, $indexes );
	}

	public static function doRemoveValue( &$array, $values ) {
		$array = \UArray::removeValue( $array, $values );
	}



	/*************************************************************************
	  MERGE METHODS
	 *************************************************************************/
	// Keep the order of each FIRST occurence 
	public static function mergeUnique( $array1 ) {
		return array_values( array_unique( call_user_func_array( 'array_merge', func_get_args( ) ) ) );
	}

	// Keep the order of each LAST occurence 
	public static function reverseMergeUnique( $array1 ) {
		return array_reverse( array_values( array_unique( array_reverse( call_user_func_array( 'array_merge', func_get_args( ) ) ) ) ) );
	}
}