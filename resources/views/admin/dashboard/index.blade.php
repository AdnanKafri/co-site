<x-layouts.admin title="Overview">
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $label => $value)
            <article class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm capitalize text-slate-500">{{ str($label)->headline() }}</p>
                <p class="mt-3 text-4xl font-semibold text-slate-950">{{ $value }}</p>
            </article>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <article class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Build Direction</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                The foundation now separates public pages, admin workflows, shared settings, and the centralized media system. From here, each content module can be added intentionally without introducing generic CMS complexity.
            </p>
        </article>

        <article class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Next Modules</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                General settings and media are live first because they unlock the rest of the dashboard cleanly. Services, projects, homepage content, and inquiries can now be layered in on top.
            </p>
        </article>
    </div>
</x-layouts.admin>
