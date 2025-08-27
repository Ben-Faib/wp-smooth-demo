<?php
/**
 * Force bypass of page cache when debug query params are present.
 */
if ( isset( $_GET['globe'] ) || isset( $_GET['noglobe'] ) ) {
    if ( ! defined( 'DONOTCACHEPAGE' ) ) {
        define( 'DONOTCACHEPAGE', true );
    }
}


