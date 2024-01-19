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
			<?php if ( ! current_user_can( 'read_visitors' ) ) : ?>
				<th scope="col">Actions</th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ( $todos as $todo ) :
			?>
			<tr>
				<th scope="row"><?php esc_html_e( $todo->id ); ?></th>
				<td><?php esc_html_e( $todo->students_name ); ?></td>
				<td><?php esc_html_e( $todo->roll ); ?></td>
				<td><?php esc_html_e( $todo->reg ); ?></td>
				<td><?php esc_html_e( $todo->address ); ?></td>
				<td><?php esc_html_e( $todo->from ); ?></td>
				<td><?php esc_html_e( $todo->to ); ?></td>
				<?php if ( ! current_user_can( 'read_visitors' ) ) : ?>
					<td>
						<a href="<?php echo admin_url( 'admin.php?page=students_management&action=edit&id=' . esc_html( $todo->id ) ); ?>" class="btn btn-primary">Edit</a>
						<a href="<?php echo admin_url( 'admin.php?page=students_management&action=delete&id=' . esc_html( $todo->id ) ); ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</a>
					</td>
				<?php endif; ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
