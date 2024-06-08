<!-- resources/views/filament/components/user-name-with-image.blade.php -->
@php
    // if driver key is not present in the user object, then return the user object itself
    use Illuminate\Support\Str;if (isset($getRecord()->driver)) $user = $getRecord()->driver;
    else $user = $getRecord();
    if ($user->image === null) $user->image = 'https://ui-avatars.com/api/?name=' . Str::replace(' ', '+', $user->name) . '&background=random';
    else $user->image = asset('storage/' . $user->image);
@endphp
<div class="flex items-center px-3 py-4">
    <img
        src="{{ $user->image }}"
        alt="User Image" class="w-10 h-10 rounded-full me-3">
    <span class="pe-8">{{ $user->name }}</span>
</div>
