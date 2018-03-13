<div class="mx-auto text-center">
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="mondayCheckbox" name="days[]" value="1" {{ old('days') ? in_array('1', old('days')) ? 'checked' : '' : '' }}>
	  <label class="form-check-label" for="mondayCheckbox">Lun</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="tuesdayCheckbox" name="days[]" value="2" {{ old('days') ? in_array('2', old('days')) ? 'checked' : '' : '' }}>
	  <label class="form-check-label" for="tuesdayCheckbox">Mar</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="wednesdayCheckbox" name="days[]" value="3" {{ old('days') ? in_array('3', old('days')) ? 'checked' : '' : '' }}>
	  <label class="form-check-label" for="wednesdayCheckbox">Mie</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="thursdayCheckbox" name="days[]" value="4" {{ old('days') ? in_array('4', old('days')) ? 'checked' : '' : '' }}>
	  <label class="form-check-label" for="thursdayCheckbox">Jue</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="fridayCheckbox" name="days[]" value="5" {{ old('days') ? in_array('5', old('days')) ? 'checked' : '' : '' }}>
	  <label class="form-check-label" for="fridayCheckbox">Vie</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="saturdayCheckbox" name="days[]" value="6" {{ old('days') ? in_array('6', old('days')) ? 'checked' : '' : '' }}>
	  <label class="form-check-label" for="saturdayCheckbox">Sab</label>
	</div>
</div>