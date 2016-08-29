<?php
settings_fields( 'trigger-db-settings-group' );
do_settings_sections( 'trigger-db-settings-group' );

if( get_option('tdb_mode') == 'false' ){
	echo '	<input
				type	= "button" 
				value	= "Create Trigger" 
				class	= "button button-primary" 
			/>';
}else{
	echo "Already Created";
}
