<form action="" method="post">
	<?php wp_nonce_field( 'students-management-nonce-action', 'students-management-nonce' ); ?>
	<input type="hidden" name="id" value="<?php echo isset( $todo->id ) ? esc_attr( $todo->id ) : ''; ?>">
	
	<div class="form-group">
		<label for="studentName">Student Name</label>
		<input type="text" class="form-control" name="students_name" value="<?php echo isset( $todo->students_name ) ? esc_attr( $todo->students_name ) : ''; ?>" placeholder="Student Name">
	</div>
	
	<div class="form-group">
		<label for="roll">Roll</label>
		<input type="text" class="form-control" name="roll" value="<?php echo isset( $todo->roll ) ? esc_attr( $todo->roll ) : ''; ?>" placeholder="Roll">
	</div>
	
	<div class="form-group">
		<label for="reg">Registration</label>
		<input type="text" class="form-control" name="reg" value="<?php echo isset( $todo->reg ) ? esc_attr( $todo->reg ) : ''; ?>" placeholder="Registration">
	</div>
	
	<div class="form-group">
		<label for="address">Address</label>
		<input type="text" class="form-control" name="address" value="<?php echo isset( $todo->address ) ? esc_attr( $todo->address ) : ''; ?>" placeholder="Address">
	</div>
	
	<div class="form-group">
		<label for="from">From</label>
		<input type="text" class="form-control" name="from" value="<?php echo isset( $todo->from ) ? esc_attr( $todo->from ) : ''; ?>" placeholder="From">
	</div>
	
	<div class="form-group">
		<label for="to">To</label>
		<input type="text" class="form-control" name="to" value="<?php echo isset( $todo->to ) ? esc_attr( $todo->to ) : ''; ?>" placeholder="To">
	</div>
	
	<button type="submit" class="btn btn-primary">Submit</button>
	<hr>
</form>
