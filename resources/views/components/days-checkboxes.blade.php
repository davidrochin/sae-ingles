<div class="mx-auto text-center">
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="mondayCheckbox" name="days[]" value="1" {{ strpos($group->days, '1') !== false ? 'checked' : '' }} {{ isset($disabled) ? 'disabled' : '' }}>
	  <label class="form-check-label" for="mondayCheckbox">Lun</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="tuesdayCheckbox" name="days[]" value="2" {{ strpos($group->days, '2') !== false ? 'checked' : '' }} {{ isset($disabled) ? 'disabled' : '' }}>
	  <label class="form-check-label" for="tuesdayCheckbox">Mar</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="wednesdayCheckbox" name="days[]" value="3" {{ strpos($group->days, '3') !== false ? 'checked' : '' }} {{ isset($disabled) ? 'disabled' : '' }}>
	  <label class="form-check-label" for="wednesdayCheckbox">Mie</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="thursdayCheckbox" name="days[]" value="4" {{ strpos($group->days, '4') !== false ? 'checked' : '' }} {{ isset($disabled) ? 'disabled' : '' }}>
	  <label class="form-check-label" for="thursdayCheckbox">Jue</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="fridayCheckbox" name="days[]" value="5" {{ strpos($group->days, '5') !== false ? 'checked' : '' }} {{ isset($disabled) ? 'disabled' : '' }}>
	  <label class="form-check-label" for="fridayCheckbox">Vie</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="checkbox" id="saturdayCheckbox" name="days[]" value="6" {{ strpos($group->days, '6') !== false ? 'checked' : '' }} {{ isset($disabled) ? 'disabled' : '' }}>
	  <label class="form-check-label" for="saturdayCheckbox">Sab</label>
	</div>
</div>