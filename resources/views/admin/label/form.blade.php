<x-error-validation/>

<x-input :value="$label->nama??old('nama')" :col="6" :label="'Nama'" :type="'text'" :name="'nama'" :required="true"></x-input>
<x-input :value="$label->warna??old('warna')" :col="6" :label="'Warna'" :type="'color'" :name="'warna'" :required="true"></x-input>
<x-input :value="$label->deskripsi??old('deskripsi')" :col="6" :label="'Deskripsi'" :type="'textarea'" :name="'deskripsi'" :required="true"></x-input>
