<?php
function result_management_init() {
	var_dump( 'init_simple_todo' );

}

function result_management_activate() {
	global $wpdb;
	$table_name      = $wpdb->prefix . 'students_management';
	$charset_collate = $wpdb->get_charset_collate();
	$sql             = 'CREATE TABLE IF NOT EXISTS ' . $table_name . ' (
		id bigint NOT NULL AUTO_INCREMENT,
		students_name varchar(256) NOT NULL,
		roll INT DEFAULT NULL,
		reg INT DEFAULT NULL,
		address varchar(256) NOT NULL,
		`from` INT DEFAULT NULL,
		`to` INT DEFAULT NULL,
		PRIMARY KEY (id)
	) ' . $charset_collate . ';';
	if ( ! function_exists( 'dbDelta' ) ) {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	}

	dbDelta( $sql );
}
function result_management_admin_menu() {
	add_menu_page(
		__( 'Students Management', 'students-management' ),
		__( 'Students Management', 'students-management' ),
		'manage_options',
		'students_management',
		'students_management_admin_page',
		'dashicons-list-view',
		2
	);

}


function result_management_add_menu() {
	add_menu_page(
		__( 'Add Students', 'students-management' ),
		__( 'Add Students', 'students-management' ),
		'manage_options',
		'students_management_add',
		'students_management_add_page',
		'dashicons-admin-users',
		3
	);

}
function result_management_students_deshboard() {

		add_menu_page(
			__( 'Students List', 'students-management' ),
			__( 'Students List', 'students-management' ),
			'read_visitors',
			'students_list',
			'students_management_List_page',
			'dashicons-list-view',
			2
		);

}
function students_management_List_page() {

	$todos = simple_todo_get_todos();
	require_once STUDENTS_MANAGEMENT_PLUGIN_DIR . 'src/students_management_table.php';

}
function students_management_add_page() {
	$todos = simple_todo_get_todos();
	// For insert and update
	if ( isset( $_POST['students-management-nonce'] ) && wp_verify_nonce( $_POST['students-management-nonce'], 'students-management-nonce-action' ) ) {
		students_management_insert_todo();
	}

	require_once STUDENTS_MANAGEMENT_PLUGIN_DIR . 'src/Students_management_reg.php';

}
function students_management_insert_todo() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'students_management';

	$students_name = isset( $_POST['students_name'] ) ? sanitize_text_field( $_POST['students_name'] ) : '';
	$roll          = isset( $_POST['roll'] ) ? intval( $_POST['roll'] ) : null;
	$reg           = isset( $_POST['reg'] ) ? intval( $_POST['reg'] ) : null;
	$address       = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
	$from          = isset( $_POST['from'] ) ? intval( $_POST['from'] ) : null;
	$to            = isset( $_POST['to'] ) ? intval( $_POST['to'] ) : null;

	$wpdb->insert(
		$table_name,
		array(
			'students_name' => $students_name,
			'roll'          => $roll,
			'reg'           => $reg,
			'address'       => $address,
			'from'          => $from,
			'to'            => $to,
		)
	);
}

function result_management_enqueue_scripts() {
	wp_enqueue_style( 'simple-todo-bootstrap-min', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2', 'all' );
	wp_enqueue_style( 'simple-todo-style', STUDENTS_MANAGEMENT_PLUGIN_URL . 'assets/css/style.css', array(), STUDENTS_MANAGEMENT_VERSION, 'all' );
	wp_enqueue_script( 'simple-todo-bootstrap-js', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array( 'jquery' ), '3.5.1', true );
	wp_enqueue_script( 'simple-todo-bootstrap-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', array( 'jquery' ), '2.11.6', true );
	wp_enqueue_script( 'simple-todo-bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array( 'jquery' ), '4.5.2', true );
}


function students_management_admin_page() {
	if ( isset( $_GET['action'] ) && $_GET['action'] == 'edit' && isset( $_GET['id'] ) ) {

		$id   = intval( $_GET['id'] );
		$todo = simple_todo_get_todo_by_id( $id );
		require_once STUDENTS_MANAGEMENT_PLUGIN_DIR . 'src/Students_management_reg.php';

	}

	if ( isset( $_POST['students-management-nonce'] ) && wp_verify_nonce( $_POST['students-management-nonce'], 'students-management-nonce-action' ) ) {
		if ( isset( $_POST['id'] ) && $_POST['id'] != '' ) {
			$id = intval( $_POST['id'] );

			simple_todo_update_todo( $id );

		} else {
			simple_todo_insert_todo();
		}
	}

	if ( isset( $_GET['action'] ) && $_GET['action'] == 'delete' && isset( $_GET['id'] ) ) {
		$id = intval( $_GET['id'] );

		students_management_detete_todo( $id );
	}

	$todos = simple_todo_get_todos();
	require_once STUDENTS_MANAGEMENT_PLUGIN_DIR . 'src/students_management_table.php';

}
function students_management_detete_todo( $id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'students_management';
	$wpdb->delete( $table_name, array( 'id' => $id ) );
}
function simple_todo_update_todo( $id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'students_management';

	$students_name = isset( $_POST['students_name'] ) ? sanitize_text_field( $_POST['students_name'] ) : '';
	$roll          = isset( $_POST['roll'] ) ? intval( $_POST['roll'] ) : null;
	$reg           = isset( $_POST['reg'] ) ? intval( $_POST['reg'] ) : null;
	$address       = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
	$from          = isset( $_POST['from'] ) ? intval( $_POST['from'] ) : null;
	$to            = isset( $_POST['to'] ) ? intval( $_POST['to'] ) : null;

	$wpdb->update(
		$table_name,
		array(
			'students_name' => $students_name,
			'roll'          => $roll,
			'reg'           => $reg,
			'address'       => $address,
			'from'          => $from,
			'to'            => $to,
		),
		array( 'id' => $id )
	);
}


function simple_todo_insert_todo() {
	global $wpdb;
	$table_name    = $wpdb->prefix . 'students_management';
	$students_name = isset( $_POST['students_name'] ) ? sanitize_text_field( $_POST['students_name'] ) : '';
	$roll          = isset( $_POST['roll'] ) ? intval( $_POST['roll'] ) : null;
	$reg           = isset( $_POST['reg'] ) ? intval( $_POST['reg'] ) : null;
	$address       = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
	$from          = isset( $_POST['from'] ) ? intval( $_POST['from'] ) : null;
	$to            = isset( $_POST['to'] ) ? intval( $_POST['to'] ) : null;

	$wpdb->insert(
		$table_name,
		array(
			'students_name' => $students_name,
			'roll'          => $roll,
			'reg'           => $reg,
			'address'       => $address,
			'from'          => $from,
			'to'            => $to,
		)
	);
}

function simple_todo_get_todo_by_id( $id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'students_management';
	$sql        = 'SELECT * FROM ' . $table_name . ' WHERE id = ' . $id;
	$item       = $wpdb->get_row( $sql );
	return $item;
}

function simple_todo_get_todos() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'students_management';
	$sql        = 'SELECT * FROM ' . $table_name . ' ORDER BY id ASC';
	$items      = $wpdb->get_results( $sql );
	return $items;
}

function wporg_simple_role() {
	add_role(
		'visitors',
		'Visitors',
	);
}

function wporg_simple_role_caps() {
	$role = get_role( 'visitors' );
	$role->add_cap( 'read_visitors', true );

}

function display_capabilities_info() {
	$current_user = wp_get_current_user();

	if ( current_user_can( 'read_visitors' ) ) {
		echo '<p>User has the "read_visitors" capability.</p>';
	} else {
		echo '<p>User does not have the "read_visitors" capability.</p>';
	}
}

// Hook to display the capabilities info on a settings page
function add_settings_page() {
	add_menu_page(
		'Capabilities Info',
		'Capabilities Info',
		'read_visitors',
		'capabilities-info',
		'display_capabilities_info'
	);
}
