<div class="mb-8">

    <label class="form-label">Subject Required for this programme: </label>
    <table class="table table-bordered" id="dynamicTable">
        <tr>
            <th>Subject Required</th>
            <th>Level Required</th>
            <th>Action</th>
        </tr>

        @foreach($programmeSubject as $key => $value)
        <tr>
            <td>
                <select class="form-select" name="addMore[{{ $value['id'] }}][subject_id]">
                    <option value="">Select</option>
                    @foreach ($subjects as $subject)
                    <option value="{{ $subject['id'] }}" @selected($value['id']==$subject['id'])>
                        {{ $subject['name'] }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <select class="form-select" name="addMore[{{ $value['id'] }}][level]">
                    <option value="">Select Level</option>
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                    <option value="<?php echo $i; ?>" @selected($value['level']==$i)>
                        <?php echo $i; ?>
                    </option>
                    <?php endfor; ?>
                </select>
            </td>


            <td><button type="button" name="add" id="add" class="btn btn-success">Add
                    More Subject</button></td>
        </tr>
        @endforeach
    </table>

</div>
