@csrf
<input type="hidden" id="input-start">
<input type="hidden" id="input-finish">
<input type="hidden" name="start">
<input type="hidden" name="finish">
<input type="hidden" name="all_day">
{{-- <input type="hidden" name="ajax" value="1"> --}}
<div class="form-group">
    <label for="name">Título</label>
    <input type="text" name="topic" class="form-control" placeholder="Conferencia de prensa" required />
</div>
<div class="form-group">
    <label for="name">Descripción</label>
    <textarea name="description" class="form-control" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="name">Lugar del evento</label>
    <input type="text" name="place" class="form-control" placeholder="" required />
</div>
<div class="form-group">
    <label for="name">Solicitante</label>
    <input type="text" name="applicant" class="form-control" placeholder="" required />
</div>
<div class="form-group">
    <label for="name">Asistente(s)</label>
    <select name="assistant_id[]" multiple class="form-control" id="select-assistant_id" required>
        @foreach (\App\Models\Assistant::where('deleted_at', NULL)->get() as $item)
            <option value="{{ $item->id }}">{{ $item->full_name }}</option>
        @endforeach
    </select>
</div>