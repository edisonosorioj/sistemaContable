<?php
	/*	
	*	WP_File System Management
	*	---------------------------------------------------------------------
	*	This file contains functions that help you read/write files
	*	---------------------------------------------------------------------
	*/
	
	
	// Run System
	if( !function_exists('kodeproperty_init_filesystem_plugin') ){
		function kodeproperty_init_filesystem_plugin($url){	
			if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
				return false;
			}
			
			if (!WP_Filesystem($creds)){
				request_filesystem_credentials($url, '', true, false, null);
				return false;
			}
		}
	}
	
	//Write File
	if( !function_exists('kodeproperty_write_filesystem_plugin') ){
		function kodeproperty_write_filesystem_plugin($current_page, $url, $data){	
			kodeproperty_init_filesystem_plugin($current_page);
			
			global $wp_filesystem;
			if (!$wp_filesystem->put_contents($url, $data, FS_CHMOD_FILE)){
				return false;
			}
			return true;
		}
	}	
	
	
	// get remote file
	if( !function_exists('kodeproperty_get_remote_file_plugin') ){
		function kodeproperty_get_remote_file_plugin($url){
			$response = wp_remote_get($url);
			
			if( is_wp_error( $response ) ) {
				return array('success'=>false, 'error'=>$response->get_error_message());
			}else if( is_array($response) ) {
				return array('success'=>true, 'data'=>$response['body']);
			}
		}
	}
		
	//Read File
	if( !function_exists('kodeproperty_read_filesystem_plugin') ){
		function kodeproperty_read_filesystem_plugin($current_page, $url){	
			kodeproperty_init_filesystem_plugin($current_page);
			
			global $wp_filesystem;
			return $wp_filesystem->get_contents($url);
		}
	}		

	
	

