@php
    $labels = \App\Models\Label::pluck('nama', 'id');
@endphp

<x-error-validation/>

<x-select :value="$donatur->label_id??old('label_id')" :col="6" :label="'Label'" :name="'label_id'" :options="$labels"></x-select>
<x-input :value="$donatur->terakhir_chat??old('terakhir_chat')" :col="6" :label="'Terakhir Chat'" :type="'datetime-local'" :name="'terakhir_chat'" :required="true"></x-input>
<x-input :value="$donatur->nama??old('nama')" :col="6" :label="'Nama'" :type="'text'" :name="'nama'" :required="true"></x-input>
<x-input :value="$donatur->email??old('email')" :col="6" :label="'Email'" :type="'text'" :name="'email'" :required="false"></x-input>
<x-input :value="$donatur->alamat??old('alamat')" :col="6" :label="'Alamat'" :type="'text'" :name="'alamat'" :required="true"></x-input>
<x-input :value="$donatur->no_telp??old('no_telp')" :col="6" :label="'No. telp'" :type="'text'" :name="'no_telp'" :required="true"></x-input>
<x-input :value="$donatur->respon??old('respon')" :col="6" :label="'Respon'" :type="'textarea'" :name="'respon'" :required="false"></x-input>
<x-input :value="$donatur->catatan??old('catatan')" :col="6" :label="'Catatan'" :type="'textarea'" :name="'catatan'" :required="false"></x-input>
<x-input :value="$donatur->info_telp??old('info_telp')" :col="12" :label="'Dapat Nomor Dari'" :type="'textarea'" :name="'info_telp'" :required="false"></x-input>
{{-- <x-input :value="$donatur->status??old('status')" :col="6" :label="'Status'" :type="'number'" :name="'status'" :required="true"></x-input> --}}
