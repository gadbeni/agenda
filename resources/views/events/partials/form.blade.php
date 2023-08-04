@csrf
<input type="hidden" id="input-start">
<input type="hidden" id="input-finish">
<input type="hidden" name="start">
<input type="hidden" name="finish">
<input type="hidden" name="all_day">
<div class="form-group">
    <label for="name">Nombre del evento</label>
    <input type="text" name="name" class="form-control" placeholder="Conferencia de prensa" required />
</div>
<div class="form-group">
    <label for="description">Descripción</label>
    <textarea name="description" class="form-control" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="events_room_id">Lugar del evento</label>
    <select name="events_room_id" id="select-events_room_id" class="form-control" required>
        @foreach (\App\Models\EventsRoom::where('deleted_at', NULL)->get() as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="applicant">Solicitante</label>
    <input type="text" name="applicant" class="form-control" placeholder="" required />
</div>