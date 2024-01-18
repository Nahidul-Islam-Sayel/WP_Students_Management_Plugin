<table class="table">
  <thead>
	<tr>
	  <th scope="col">ID</th>
	  <th scope="col">Students Name</th>
	  <th scope="col">Roll</th>
	  <th scope="col">Reg</th>
	  <th scope="col">Address</th>
	  <th scope="col">from</th>
	  <th scope="col">to</th>
	</tr>
  </thead>
  <tbody>
	<?php
	foreach ( $todos as $todo ) {
		?>
	<tr>
	  <th scope="row"><?php esc_html_e( $todo->id ); ?></th>
	  <td><?php esc_html_e( $todo->students_name ); ?></td>
	  <td><?php esc_html_e( $todo->roll ); ?></td>
	  <td><?php esc_html_e( $todo->reg ); ?></td>
	  <td><?php esc_html_e( $todo->address ); ?></td>
	  <td><?php esc_html_e( $todo->from ); ?></td>
	  <td><?php esc_html_e( $todo->to ); ?></td>
	  <td>
	  <a href="<?php echo admin_url( 'admin.php?page=students_management&action=edit&id=' . esc_html( $todo->id ) ); ?>" class="btn btn-primary">Edit</a>
		<a href="<?php echo admin_url( 'admin.php?page=students_management&action=delete&id=' . esc_html( $todo->id ) ); ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</a>
	  </td>
	</tr>
	<?php } ?>
  </tbody>
</table>
