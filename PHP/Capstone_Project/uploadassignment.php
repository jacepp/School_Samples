<form enctype="multipart/form-data" name="chooseassignment" method="post" action="saveassignment.php">
	<table>
		<tr>
			<td>
				<label>Course Name</label>
			</td>
			<td>
				<input type="text" name="cname" size="10" />
			</td>
		</tr>
		<tr>
			<td>
				<label>Assignment Name</label>
			</td>
			<td>
				<input type="text" name="name" size="30" />
			</td>
		</tr>
		<tr>
			<td>
				<label>Due By</label>
			</td>
			<td>
				 <input type="text" name="duedate" size="20" />
			</td>
		<tr>
			<td>
				<label>Upload Assignment</label>
			</td>
			<td>
				<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
				<input name="assignment" id="assignment" type="file" />
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="submit" value="Submit">
			</td>
		</tr>
	</table>
</form>

