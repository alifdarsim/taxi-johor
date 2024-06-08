<div class="flex items-center px-3 py-4">
    <img
        src="/{{ $getRecord()->advertisement->image ?? 'no-image-found-sm.png'}}"
        alt="User Image" class="!w-20 h-10 rounded-lg me-2 object-cover">
    <span class="text-sm me-14">{{ $getRecord()->advertisement->name }}</span>
</div>
