
{!! Form::open(['action' => ['Realtor\ProfileController@test'], 'method'=>'PATCH', 'enctype'=>'multipart/form-data', 'autocomplete'=>'off']) !!}
    <input type="file" name="photo" />
    <input type="submit" name="submit" value="upload" />
</form>