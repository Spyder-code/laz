@php
    $roles = \App\Models\Role::pluck('name', 'id');
@endphp
<x-error-validation/>

<x-input :value="$user->name??old('name')" :col="6" :label="'Name'" :type="'text'" :name="'name'" :required="true"></x-input>
<x-input :value="$user->email??old('email')" :col="6" :label="'Email'" :type="'email'" :name="'email'" :required="true"></x-input>
<x-input :col="6" :label="'Password'" :type="'password'" :name="'password'" :required="true"></x-input>
<x-input :col="6" :label="'Confirm Password'" :type="'password'" :name="'password_confirmation'" :required="true"></x-input>
<x-select :value="$user->role_id??old('role_id')" :col="12" :label="'Role'" :name="'role_id'" :options="$roles" :value="$user->role_id??''"></x-select>
